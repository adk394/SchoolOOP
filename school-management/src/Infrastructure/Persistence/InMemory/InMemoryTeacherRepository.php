<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\InMemory;

use SchoolManagement\Domain\Ports\TeacherRepository;
use SchoolManagement\Domain\Teacher\Teacher;
use SchoolManagement\Domain\Teacher\TeacherId;

final class InMemoryTeacherRepository implements TeacherRepository
{
    private array $teachers = [];

    public function findById(TeacherId $id): ?Teacher
    {
        return $this->teachers[$id->value()] ?? null;
    }

    public function save(Teacher $teacher): void
    {
        $this->teachers[$teacher->id()->value()] = $teacher;
    }
}