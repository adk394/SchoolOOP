<?php

declare(strict_types=1);

namespace SchoolManagement\UI\Controller;

use SchoolManagement\Application\CreateCourse\CreateCourseHandler;
use SchoolManagement\Application\CreateCourse\CreateCourseCommand;
use SchoolManagement\Application\CreateSubject\CreateSubjectHandler;
use SchoolManagement\Application\CreateSubject\CreateSubjectCommand;
use SchoolManagement\Application\CreateTeacher\CreateTeacherHandler;
use SchoolManagement\Application\CreateTeacher\CreateTeacherCommand;
use SchoolManagement\Application\EnrollStudent\EnrollStudentHandler;
use SchoolManagement\Application\EnrollStudent\EnrollStudentCommand;
use SchoolManagement\Application\AssignTeacherToSubject\AssignTeacherToSubjectHandler;
use SchoolManagement\Application\AssignTeacherToSubject\AssignTeacherToSubjectCommand;

final class AcademicController
{
    private CreateCourseHandler $createCourseHandler;
    private CreateSubjectHandler $createSubjectHandler;
    private CreateTeacherHandler $createTeacherHandler;
    private EnrollStudentHandler $enrollStudentHandler;
    private AssignTeacherToSubjectHandler $assignTeacherHandler;

    public function __construct(
        CreateCourseHandler $createCourseHandler,
        CreateSubjectHandler $createSubjectHandler,
        CreateTeacherHandler $createTeacherHandler,
        EnrollStudentHandler $enrollStudentHandler,
        AssignTeacherToSubjectHandler $assignTeacherHandler
    ) {
        $this->createCourseHandler = $createCourseHandler;
        $this->createSubjectHandler = $createSubjectHandler;
        $this->createTeacherHandler = $createTeacherHandler;
        $this->enrollStudentHandler = $enrollStudentHandler;
        $this->assignTeacherHandler = $assignTeacherHandler;
    }

    public function createCourse(string $id, string $name): array
    {
        try {
            $command = new CreateCourseCommand($id, $name);
            $this->createCourseHandler->handle($command);
            return ['success' => true, 'message' => 'Course created successfully'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createSubject(string $id, string $name): array
    {
        try {
            $command = new CreateSubjectCommand($id, $name);
            $this->createSubjectHandler->handle($command);
            return ['success' => true, 'message' => 'Subject created successfully'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function createTeacher(string $id, string $name, string $email): array
    {
        try {
            $command = new CreateTeacherCommand($id, $name, $email);
            $this->createTeacherHandler->handle($command);
            return ['success' => true, 'message' => 'Teacher created successfully'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function enrollStudent(string $studentId, string $courseId): array
    {
        try {
            $command = new EnrollStudentCommand($studentId, $courseId);
            $this->enrollStudentHandler->handle($command);
            return ['success' => true, 'message' => 'Student enrolled successfully'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function assignTeacher(string $teacherId, string $subjectId): array
    {
        try {
            $command = new AssignTeacherToSubjectCommand($teacherId, $subjectId);
            $this->assignTeacherHandler->handle($command);
            return ['success' => true, 'message' => 'Teacher assigned successfully'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
