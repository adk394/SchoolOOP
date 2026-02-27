<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\UpdateStudent\UpdateStudentCommand;
use SchoolManagement\Application\UpdateStudent\UpdateStudentHandler;
use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\Student;
use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Student\Name;
use SchoolManagement\Domain\Student\Email;

final class UpdateStudentHandlerTest extends TestCase
{
    public function test_handle_updates_student(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);
        $existingStudent = new Student(
            new StudentId('student1'),
            new Name('Old Name'),
            new Email('old@example.com')
        );

        $studentRepository->expects($this->once())
            ->method('findById')
            ->with(new StudentId('student1'))
            ->willReturn($existingStudent);

        $studentRepository->expects($this->once())
            ->method('save')
            ->with($this->callback(function ($student) {
                return $student->name()->value() === 'New Name' &&
                       $student->email()->value() === 'new@example.com';
            }));

        $handler = new UpdateStudentHandler($studentRepository);

        $command = new UpdateStudentCommand('student1', 'New Name', 'new@example.com');
        $handler->handle($command);
    }

    public function test_handle_throws_if_student_not_found(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);
        $studentRepository->expects($this->once())
            ->method('findById')
            ->willReturn(null);

        $handler = new UpdateStudentHandler($studentRepository);

        $this->expectException(\InvalidArgumentException::class);
        $command = new UpdateStudentCommand('nonexistent', 'Name', 'email@example.com');
        $handler->handle($command);
    }
}