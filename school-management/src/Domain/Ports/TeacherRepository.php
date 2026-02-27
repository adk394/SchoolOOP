<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Ports;

use SchoolManagement\Domain\Teacher\Teacher;
use SchoolManagement\Domain\Teacher\TeacherId;

interface TeacherRepository
{
    public function findById(TeacherId $id): ?Teacher;
    public function save(Teacher $teacher): void;
}