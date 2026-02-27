<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Domain;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Domain\Subject\Subject;
use SchoolManagement\Domain\Subject\SubjectId;
use SchoolManagement\Domain\Subject\Name as SubjectName;
use SchoolManagement\Domain\Teacher\Teacher;
use SchoolManagement\Domain\Teacher\TeacherId;
use SchoolManagement\Domain\Teacher\Name as TeacherName;
use SchoolManagement\Domain\Teacher\Email as TeacherEmail;

final class SubjectTest extends TestCase
{
    public function test_subject_can_assign_teacher(): void
    {
        $subject = new Subject(
            new SubjectId('subject1'),
            new SubjectName('Math')
        );
        $teacher = new Teacher(
            new TeacherId('teacher1'),
            new TeacherName('Jane Doe'),
            new TeacherEmail('jane@example.com')
        );

        $subject->assignTeacher($teacher);

        $this->assertEquals('teacher1', $subject->teacherId()->value());
    }

    public function test_subject_cannot_assign_teacher_twice(): void
    {
        $subject = new Subject(
            new SubjectId('subject1'),
            new SubjectName('Math')
        );
        $teacher1 = new Teacher(
            new TeacherId('teacher1'),
            new TeacherName('Jane Doe'),
            new TeacherEmail('jane@example.com')
        );
        $teacher2 = new Teacher(
            new TeacherId('teacher2'),
            new TeacherName('John Smith'),
            new TeacherEmail('john@example.com')
        );

        $subject->assignTeacher($teacher1);

        $this->expectException(\DomainException::class);
        $subject->assignTeacher($teacher2);
    }
}