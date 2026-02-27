<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Enrollment;

use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Course\CourseId;

final class Enrollment
{
    private EnrollmentId $id;
    private StudentId $studentId;
    private CourseId $courseId;

    private function __construct(EnrollmentId $id, StudentId $studentId, CourseId $courseId)
    {
        $this->id = $id;
        $this->studentId = $studentId;
        $this->courseId = $courseId;
    }

    public static function create(StudentId $studentId, CourseId $courseId): self
    {
        // Generate unique id, for simplicity use a random string
        $id = new EnrollmentId(uniqid('enrollment_', true));
        return new self($id, $studentId, $courseId);
    }

    public function id(): EnrollmentId
    {
        return $this->id;
    }

    public function studentId(): StudentId
    {
        return $this->studentId;
    }

    public function courseId(): CourseId
    {
        return $this->courseId;
    }
}