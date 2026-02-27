<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\InMemory;

use SchoolManagement\Domain\Ports\EnrollmentRepository;
use SchoolManagement\Domain\Enrollment\Enrollment;
use SchoolManagement\Domain\Enrollment\EnrollmentId;

final class InMemoryEnrollmentRepository implements EnrollmentRepository
{
    private array $enrollments = [];

    public function findById(EnrollmentId $id): ?Enrollment
    {
        return $this->enrollments[$id->value()] ?? null;
    }

    public function save(Enrollment $enrollment): void
    {
        $this->enrollments[$enrollment->id()->value()] = $enrollment;
    }
}