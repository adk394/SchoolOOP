<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\ListAllStudents\ListAllStudentsQuery;
use SchoolManagement\Application\ListAllStudents\ListAllStudentsHandler;
use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\Student;
use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Student\Name;
use SchoolManagement\Domain\Student\Email;

final class ListAllStudentsHandlerTest extends TestCase
{
    public function test_handle_returns_all_students(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);
        $students = [
            new Student(new StudentId('1'), new Name('John'), new Email('john@example.com')),
            new Student(new StudentId('2'), new Name('Jane'), new Email('jane@example.com')),
        ];

        $studentRepository->expects($this->once())
            ->method('listAll')
            ->willReturn($students);

        $handler = new ListAllStudentsHandler($studentRepository);

        $query = new ListAllStudentsQuery();
        $result = $handler->handle($query);

        $this->assertEquals($students, $result);
    }
}