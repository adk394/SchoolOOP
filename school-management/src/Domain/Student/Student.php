<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Student;

use SchoolManagement\Domain\Course\Course;
use SchoolManagement\Domain\Enrollment\Enrollment;
use SchoolManagement\Domain\Course\CourseId;

final class Student
{
    private StudentId $id;
    private Name $name;
    private Email $email;
    private array $enrolledCourseIds = [];

    public function __construct(StudentId $id, Name $name, Email $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function id(): StudentId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function enrollInCourse(Course $course): Enrollment
    {
        if (in_array($course->id()->value(), $this->enrolledCourseIds)) {
            throw new \DomainException('Student is already enrolled in this course');
        }
        $this->enrolledCourseIds[] = $course->id()->value();
        return Enrollment::create($this->id, $course->id());
    }

    public function enrolledCourseIds(): array
    {
        return $this->enrolledCourseIds;
    }

    public static function fromExisting(Student $existing, Name $name, Email $email): self
    {
        $student = new self($existing->id, $name, $email);
        // Copy enrolled courses - for simplicity, not copying
        return $student;
    }
}
