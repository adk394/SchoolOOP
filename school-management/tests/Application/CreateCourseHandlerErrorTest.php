<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\CreateCourse\CreateCourseCommand;
use SchoolManagement\Application\CreateCourse\CreateCourseHandler;
use SchoolManagement\Domain\Ports\CourseRepository;

final class CreateCourseHandlerErrorTest extends TestCase
{
    public function test_handle_fails_with_empty_course_id(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $courseRepository = $this->createMock(CourseRepository::class);
        $handler = new CreateCourseHandler($courseRepository);
        
        $command = new CreateCourseCommand('', 'Mathematics');
        $handler->handle($command);
    }

    public function test_handle_fails_with_empty_course_name(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $courseRepository = $this->createMock(CourseRepository::class);
        $handler = new CreateCourseHandler($courseRepository);
        
        $command = new CreateCourseCommand('course1', '   ');
        $handler->handle($command);
    }
}
