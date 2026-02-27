<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Enrollment;

final class EnrollmentId
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('EnrollmentId cannot be empty');
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(EnrollmentId $other): bool
    {
        return $this->value === $other->value;
    }
}