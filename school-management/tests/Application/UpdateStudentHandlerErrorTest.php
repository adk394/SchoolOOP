<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\UpdateStudent\UpdateStudentCommand;
use SchoolManagement\Application\UpdateStudent\UpdateStudentHandler;
use SchoolManagement\Domain\Ports\StudentRepository;

final class UpdateStudentHandlerErrorTest extends TestCase
{
    public function test_handle_fails_with_empty_name(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $studentRepository = $this->createMock(StudentRepository::class);
        $handler = new UpdateStudentHandler($studentRepository);
        
        $command = new UpdateStudentCommand('student1', '   ', 'john@example.com');
        $handler->handle($command);
    }

    public function test_handle_fails_with_invalid_email(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $studentRepository = $this->createMock(StudentRepository::class);
        $handler = new UpdateStudentHandler($studentRepository);
        
        $command = new UpdateStudentCommand('student1', 'John', 'invalid-email');
        $handler->handle($command);
    }

    public function test_handle_fails_with_non_existent_student(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);
        $studentRepository->method('findById')->willReturn(null);
        
        $handler = new UpdateStudentHandler($studentRepository);
        
        $this->expectException(\InvalidArgumentException::class);
        
        $command = new UpdateStudentCommand('non_existent', 'John', 'john@example.com');
        $handler->handle($command);
    }
}
