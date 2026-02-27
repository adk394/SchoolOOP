<?php

declare(strict_types=1);

namespace SchoolManagement\Application\EnrollStudent;

use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Ports\CourseRepository;
use SchoolManagement\Domain\Ports\EnrollmentRepository;
use SchoolManagement\Domain\Ports\TransactionalSession;
use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Course\CourseId;

final class EnrollStudentHandler
{
    private StudentRepository $studentRepository;
    private CourseRepository $courseRepository;
    private EnrollmentRepository $enrollmentRepository;
    private TransactionalSession $transactionalSession;

    public function __construct(
        StudentRepository $studentRepository,
        CourseRepository $courseRepository,
        EnrollmentRepository $enrollmentRepository,
        TransactionalSession $transactionalSession
    ) {
        $this->studentRepository = $studentRepository;
        $this->courseRepository = $courseRepository;
        $this->enrollmentRepository = $enrollmentRepository;
        $this->transactionalSession = $transactionalSession;
    }

    public function handle(EnrollStudentCommand $command): void
    {
        $this->transactionalSession->execute(function () use ($command) {
            $student = $this->studentRepository->findById(new StudentId($command->studentId()));
            $course = $this->courseRepository->findById(new CourseId($command->courseId()));
            if ($student === null || $course === null) {
                throw new \InvalidArgumentException('Student or Course not found');
            }
            $enrollment = $student->enrollInCourse($course);
            $this->enrollmentRepository->save($enrollment);
            $this->studentRepository->save($student);
        });
    }
}