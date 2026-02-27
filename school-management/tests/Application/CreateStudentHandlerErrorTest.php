<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\CreateStudent\CreateStudentCommand;
use SchoolManagement\Application\CreateStudent\CreateStudentHandler;
use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Student\Name;
use SchoolManagement\Domain\Student\Email;

final class CreateStudentHandlerErrorTest extends TestCase
{
    public function test_handle_fails_with_empty_student_id(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $studentRepository = $this->createMock(StudentRepository::class);
        $handler = new CreateStudentHandler($studentRepository);
        
        $command = new CreateStudentCommand('', 'John Doe', 'john@example.com');
        $handler->handle($command);
    }

    public function test_handle_fails_with_empty_student_name(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $studentRepository = $this->createMock(StudentRepository::class);
        $handler = new CreateStudentHandler($studentRepository);
        
        $command = new CreateStudentCommand('student1', '   ', 'john@example.com');
        $handler->handle($command);
    }

    public function test_handle_fails_with_invalid_email(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $studentRepository = $this->createMock(StudentRepository::class);
        $handler = new CreateStudentHandler($studentRepository);
        
        $command = new CreateStudentCommand('student1', 'John Doe', 'invalid-email');
        $handler->handle($command);
    }

    public function test_handle_fails_with_malformed_email(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $studentRepository = $this->createMock(StudentRepository::class);
        $handler = new CreateStudentHandler($studentRepository);
        
        $command = new CreateStudentCommand('student1', 'John Doe', 'john@');
        $handler->handle($command);
    }
}
