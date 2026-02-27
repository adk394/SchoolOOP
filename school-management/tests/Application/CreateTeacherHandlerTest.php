<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\CreateTeacher\CreateTeacherCommand;
use SchoolManagement\Application\CreateTeacher\CreateTeacherHandler;
use SchoolManagement\Domain\Ports\TeacherRepository;

final class CreateTeacherHandlerTest extends TestCase
{
    public function test_handle_creates_and_saves_teacher(): void
    {
        $teacherRepository = $this->createMock(TeacherRepository::class);

        $teacherRepository->expects($this->once())
            ->method('save');

        $handler = new CreateTeacherHandler($teacherRepository);

        $command = new CreateTeacherCommand('teacher1', 'Jane Doe', 'jane@example.com');
        $handler->handle($command);
    }
}