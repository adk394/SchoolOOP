<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\InMemory;

use SchoolManagement\Domain\Ports\CourseRepository;
use SchoolManagement\Domain\Course\Course;
use SchoolManagement\Domain\Course\CourseId;

final class InMemoryCourseRepository implements CourseRepository
{
    private array $courses = [];

    public function findById(CourseId $id): ?Course
    {
        return $this->courses[$id->value()] ?? null;
    }

    public function save(Course $course): void
    {
        $this->courses[$course->id()->value()] = $course;
    }
}