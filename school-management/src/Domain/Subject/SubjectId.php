<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Subject;

final class SubjectId
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('SubjectId cannot be empty');
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(SubjectId $other): bool
    {
        return $this->value === $other->value;
    }
}