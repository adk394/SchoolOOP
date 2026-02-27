<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\InMemory;

use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\Student;
use SchoolManagement\Domain\Student\StudentId;

final class InMemoryStudentRepository implements StudentRepository
{
    private array $students = [];

    public function findById(StudentId $id): ?Student
    {
        return $this->students[$id->value()] ?? null;
    }

    public function save(Student $student): void
    {
        $this->students[$student->id()->value()] = $student;
    }

    public function delete(StudentId $id): void
    {
        unset($this->students[$id->value()]);
    }

    public function listAll(): array
    {
        return array_values($this->students);
    }
}