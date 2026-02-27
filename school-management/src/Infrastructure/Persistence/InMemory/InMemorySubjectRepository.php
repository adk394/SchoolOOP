<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\InMemory;

use SchoolManagement\Domain\Ports\SubjectRepository;
use SchoolManagement\Domain\Subject\Subject;
use SchoolManagement\Domain\Subject\SubjectId;

final class InMemorySubjectRepository implements SubjectRepository
{
    private array $subjects = [];

    public function findById(SubjectId $id): ?Subject
    {
        return $this->subjects[$id->value()] ?? null;
    }

    public function save(Subject $subject): void
    {
        $this->subjects[$subject->id()->value()] = $subject;
    }
}