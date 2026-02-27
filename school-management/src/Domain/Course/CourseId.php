<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Course;

final class CourseId
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('CourseId cannot be empty');
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(CourseId $other): bool
    {
        return $this->value === $other->value;
    }
}