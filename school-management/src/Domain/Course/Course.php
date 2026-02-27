<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Course;

final class Course
{
    private CourseId $id;
    private Name $name;

    public function __construct(CourseId $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): CourseId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }
}