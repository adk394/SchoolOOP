<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Subject;

use SchoolManagement\Domain\Teacher\Teacher;
use SchoolManagement\Domain\Teacher\TeacherId;

final class Subject
{
    private SubjectId $id;
    private Name $name;
    private ?TeacherId $teacherId = null;

    public function __construct(SubjectId $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): SubjectId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function teacherId(): ?TeacherId
    {
        return $this->teacherId;
    }

    public function assignTeacher(Teacher $teacher): void
    {
        if ($this->teacherId !== null) {
            throw new \DomainException('Subject already has a teacher assigned');
        }
        $this->teacherId = $teacher->id();
    }
}