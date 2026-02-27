<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\DeleteStudent\DeleteStudentCommand;
use SchoolManagement\Application\DeleteStudent\DeleteStudentHandler;
use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\StudentId;

final class DeleteStudentHandlerErrorTest extends TestCase
{
    public function test_handle_attempts_to_delete_non_existent_student(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);
        
        $studentRepository->expects($this->once())
            ->method('delete')
            ->with(new StudentId('non_existent'));

        $handler = new DeleteStudentHandler($studentRepository);

        $command = new DeleteStudentCommand('non_existent');
        $handler->handle($command);
    }
}
