<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Ports;

use SchoolManagement\Domain\Course\Course;
use SchoolManagement\Domain\Course\CourseId;

interface CourseRepository
{
    public function findById(CourseId $id): ?Course;
    public function save(Course $course): void;
}