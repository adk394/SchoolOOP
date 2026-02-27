<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Domain;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Domain\Student\Student;
use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Student\Name;
use SchoolManagement\Domain\Student\Email;
use SchoolManagement\Domain\Course\Course;
use SchoolManagement\Domain\Course\CourseId;
use SchoolManagement\Domain\Course\Name as CourseName;

final class EnrollmentTest extends TestCase
{
    public function test_student_can_enroll_in_course(): void
    {
        $student = new Student(
            new StudentId('student1'),
            new Name('John Doe'),
            new Email('john@example.com')
        );
        $course = new Course(
            new CourseId('course1'),
            new CourseName('Math')
        );

        $enrollment = $student->enrollInCourse($course);

        $this->assertEquals('student1', $enrollment->studentId()->value());
        $this->assertEquals('course1', $enrollment->courseId()->value());
        $this->assertContains('course1', $student->enrolledCourseIds());
    }

    public function test_student_cannot_enroll_twice_in_same_course(): void
    {
        $student = new Student(
            new StudentId('student1'),
            new Name('John Doe'),
            new Email('john@example.com')
        );
        $course = new Course(
            new CourseId('course1'),
            new CourseName('Math')
        );

        $student->enrollInCourse($course);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Student is already enrolled in this course');

        $student->enrollInCourse($course);
    }
}