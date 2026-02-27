<?php

declare(strict_types=1);

namespace SchoolManagement\Application\AssignTeacherToSubject;

final class AssignTeacherToSubjectCommand
{
    private string $teacherId;
    private string $subjectId;

    public function __construct(string $teacherId, string $subjectId)
    {
        $this->teacherId = $teacherId;
        $this->subjectId = $subjectId;
    }

    public function teacherId(): string
    {
        return $this->teacherId;
    }

    public function subjectId(): string
    {
        return $this->subjectId;
    }
}