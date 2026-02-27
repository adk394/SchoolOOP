<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\EnrollStudent\EnrollStudentCommand;
use SchoolManagement\Application\EnrollStudent\EnrollStudentHandler;
use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Ports\CourseRepository;
use SchoolManagement\Domain\Ports\EnrollmentRepository;
use SchoolManagement\Domain\Ports\TransactionalSession;
use SchoolManagement\Domain\Student\Student;
use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Student\Name;
use SchoolManagement\Domain\Student\Email;
use SchoolManagement\Domain\Course\Course;
use SchoolManagement\Domain\Course\CourseId;
use SchoolManagement\Domain\Course\Name as CourseName;
use SchoolManagement\Domain\Enrollment\Enrollment;

final class EnrollStudentHandlerTest extends TestCase
{
    public function test_handle_enrolls_student_and_saves(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);
        $courseRepository = $this->createMock(CourseRepository::class);
        $enrollmentRepository = $this->createMock(EnrollmentRepository::class);
        $transactionalSession = $this->createMock(TransactionalSession::class);

        $student = new Student(
            new StudentId('student1'),
            new Name('John Doe'),
            new Email('john@example.com')
        );
        $course = new Course(
            new CourseId('course1'),
            new CourseName('Math')
        );

        $studentRepository->expects($this->once())
            ->method('findById')
            ->with(new StudentId('student1'))
            ->willReturn($student);

        $courseRepository->expects($this->once())
            ->method('findById')
            ->with(new CourseId('course1'))
            ->willReturn($course);

        $enrollmentRepository->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Enrollment::class));

        $studentRepository->expects($this->once())
            ->method('save')
            ->with($student);

        $transactionalSession->expects($this->once())
            ->method('execute')
            ->willReturnCallback(function ($callable) {
                $callable();
            });

        $handler = new EnrollStudentHandler(
            $studentRepository,
            $courseRepository,
            $enrollmentRepository,
            $transactionalSession
        );

        $command = new EnrollStudentCommand('student1', 'course1');
        $handler->handle($command);
    }
}