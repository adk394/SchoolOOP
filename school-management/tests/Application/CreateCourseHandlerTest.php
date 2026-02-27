<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\CreateCourse\CreateCourseCommand;
use SchoolManagement\Application\CreateCourse\CreateCourseHandler;
use SchoolManagement\Domain\Ports\CourseRepository;

final class CreateCourseHandlerTest extends TestCase
{
    public function test_handle_creates_and_saves_course(): void
    {
        $courseRepository = $this->createMock(CourseRepository::class);

        $courseRepository->expects($this->once())
            ->method('save');

        $handler = new CreateCourseHandler($courseRepository);

        $command = new CreateCourseCommand('course1', 'Math');
        $handler->handle($command);
    }
}