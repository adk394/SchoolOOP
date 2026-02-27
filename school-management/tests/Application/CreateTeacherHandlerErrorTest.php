<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\CreateTeacher\CreateTeacherCommand;
use SchoolManagement\Application\CreateTeacher\CreateTeacherHandler;
use SchoolManagement\Domain\Ports\TeacherRepository;

final class CreateTeacherHandlerErrorTest extends TestCase
{
    public function test_handle_fails_with_empty_teacher_id(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $teacherRepository = $this->createMock(TeacherRepository::class);
        $handler = new CreateTeacherHandler($teacherRepository);
        
        $command = new CreateTeacherCommand('', 'Jane Doe', 'jane@example.com');
        $handler->handle($command);
    }

    public function test_handle_fails_with_empty_teacher_name(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $teacherRepository = $this->createMock(TeacherRepository::class);
        $handler = new CreateTeacherHandler($teacherRepository);
        
        $command = new CreateTeacherCommand('teacher1', '   ', 'jane@example.com');
        $handler->handle($command);
    }

    public function test_handle_fails_with_invalid_teacher_email(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $teacherRepository = $this->createMock(TeacherRepository::class);
        $handler = new CreateTeacherHandler($teacherRepository);
        
        $command = new CreateTeacherCommand('teacher1', 'Jane Doe', 'invalid-email');
        $handler->handle($command);
    }
}
