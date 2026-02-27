<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\CreateStudent\CreateStudentCommand;
use SchoolManagement\Application\CreateStudent\CreateStudentHandler;
use SchoolManagement\Domain\Ports\StudentRepository;

final class CreateStudentHandlerTest extends TestCase
{
    public function test_handle_creates_and_saves_student(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);

        $studentRepository->expects($this->once())
            ->method('save');

        $handler = new CreateStudentHandler($studentRepository);

        $command = new CreateStudentCommand('student1', 'John Doe', 'john@example.com');
        $handler->handle($command);
    }
}