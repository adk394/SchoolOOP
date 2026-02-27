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

final class EnrollStudentHandlerErrorTest extends TestCase
{
    public function test_handle_fails_when_enrolling_twice_in_same_course(): void
    {
        $this->expectException(\DomainException::class);
        
        $student = new Student(
            new StudentId('student1'),
            new Name('John'),
            new Email('john@example.com')
        );
        
        $course = new Course(
            new CourseId('course1'),
            new CourseName('Math')
        );
        
        $student->enrollInCourse($course);
        $student->enrollInCourse($course);
    }

    public function test_handle_fails_with_non_existent_student(): void
    {
        $studentRepository = $this->createMock(StudentRepository::class);
        $studentRepository->method('findById')->willReturn(null);
        
        $courseRepository = $this->createMock(CourseRepository::class);
        $enrollmentRepository = $this->createMock(EnrollmentRepository::class);
        $transactionalSession = $this->createMock(TransactionalSession::class);
        
        $transactionalSession->method('execute')->will(
            $this->returnCallback(function($callback) {
                return $callback();
            })
        );
        
        $handler = new EnrollStudentHandler(
            $studentRepository,
            $courseRepository,
            $enrollmentRepository,
            $transactionalSession
        );
        
        $this->expectException(\InvalidArgumentException::class);
        
        $command = new EnrollStudentCommand('non_existent', 'course1');
        $handler->handle($command);
    }

    public function test_handle_fails_with_non_existent_course(): void
    {
        $student = new Student(
            new StudentId('student1'),
            new Name('John'),
            new Email('john@example.com')
        );
        
        $studentRepository = $this->createMock(StudentRepository::class);
        $studentRepository->method('findById')->willReturn($student);
        
        $courseRepository = $this->createMock(CourseRepository::class);
        $courseRepository->method('findById')->willReturn(null);
        
        $enrollmentRepository = $this->createMock(EnrollmentRepository::class);
        $transactionalSession = $this->createMock(TransactionalSession::class);
        
        $transactionalSession->method('execute')->will(
            $this->returnCallback(function($callback) {
                return $callback();
            })
        );
        
        $handler = new EnrollStudentHandler(
            $studentRepository,
            $courseRepository,
            $enrollmentRepository,
            $transactionalSession
        );
        
        $this->expectException(\InvalidArgumentException::class);
        
        $command = new EnrollStudentCommand('student1', 'non_existent');
        $handler->handle($command);
    }
}
