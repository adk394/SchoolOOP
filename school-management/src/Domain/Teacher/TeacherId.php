<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Teacher;

final class TeacherId
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('TeacherId cannot be empty');
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(TeacherId $other): bool
    {
        return $this->value === $other->value;
    }
}