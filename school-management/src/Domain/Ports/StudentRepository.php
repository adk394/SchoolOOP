<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Ports;

use SchoolManagement\Domain\Student\Student;
use SchoolManagement\Domain\Student\StudentId;

interface StudentRepository
{
    public function findById(StudentId $id): ?Student;
    public function save(Student $student): void;
    public function delete(StudentId $id): void;
    public function listAll(): array;
}