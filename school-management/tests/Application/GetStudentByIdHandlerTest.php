<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\GetStudentById\GetStudentByIdQuery;
use SchoolManagement\Application\GetStudentById\GetStudentByIdHandler;
use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\Student;
use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Student\Name;
use SchoolManagement\Domain\Student\Email;

final class GetStudentByIdHandlerTest extends TestCase
{
    public function test_handle_returns_student(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);
        $student = new Student(
            new StudentId('student1'),
            new Name('John Doe'),
            new Email('john@example.com')
        );

        $studentRepository->expects($this->once())
            ->method('findById')
            ->with(new StudentId('student1'))
            ->willReturn($student);

        $handler = new GetStudentByIdHandler($studentRepository);

        $query = new GetStudentByIdQuery('student1');
        $result = $handler->handle($query);

        $this->assertEquals($student, $result);
    }

    public function test_handle_returns_null_if_not_found(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);
        $studentRepository->expects($this->once())
            ->method('findById')
            ->willReturn(null);

        $handler = new GetStudentByIdHandler($studentRepository);

        $query = new GetStudentByIdQuery('nonexistent');
        $result = $handler->handle($query);

        $this->assertNull($result);
    }
}