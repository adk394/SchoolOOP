<?php

declare(strict_types=1);

namespace SchoolManagement\Application\EnrollStudent;

final class EnrollStudentCommand
{
    private string $studentId;
    private string $courseId;

    public function __construct(string $studentId, string $courseId)
    {
        $this->studentId = $studentId;
        $this->courseId = $courseId;
    }

    public function studentId(): string
    {
        return $this->studentId;
    }

    public function courseId(): string
    {
        return $this->courseId;
    }
}