<?php

declare(strict_types=1);

namespace SchoolManagement\Application\CreateCourse;

use SchoolManagement\Domain\Ports\CourseRepository;
use SchoolManagement\Domain\Course\Course;
use SchoolManagement\Domain\Course\CourseId;
use SchoolManagement\Domain\Course\Name;

final class CreateCourseHandler
{
    private CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle(CreateCourseCommand $command): void
    {
        $course = new Course(
            new CourseId($command->id()),
            new Name($command->name())
        );
        $this->courseRepository->save($course);
    }
}