<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\DeleteStudent\DeleteStudentCommand;
use SchoolManagement\Application\DeleteStudent\DeleteStudentHandler;
use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\StudentId;

final class DeleteStudentHandlerTest extends TestCase
{
    public function test_handle_deletes_student(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);

        $studentRepository->expects($this->once())
            ->method('delete')
            ->with(new StudentId('student1'));

        $handler = new DeleteStudentHandler($studentRepository);

        $command = new DeleteStudentCommand('student1');
        $handler->handle($command);
    }
}