<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Ports;

use SchoolManagement\Domain\Enrollment\Enrollment;
use SchoolManagement\Domain\Enrollment\EnrollmentId;

interface EnrollmentRepository
{
    public function findById(EnrollmentId $id): ?Enrollment;
    public function save(Enrollment $enrollment): void;
}