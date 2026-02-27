<?php

declare(strict_types=1);

namespace SchoolManagement\UI\Controller;

use SchoolManagement\Application\CreateStudent\CreateStudentHandler;
use SchoolManagement\Application\CreateStudent\CreateStudentCommand;
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
use SchoolManagement\Application\UpdateStudent\UpdateStudentHandler;
use SchoolManagement\Application\UpdateStudent\UpdateStudentCommand;
use SchoolManagement\Application\DeleteStudent\DeleteStudentHandler;
use SchoolManagement\Application\DeleteStudent\DeleteStudentCommand;
use SchoolManagement\Application\GetStudentById\GetStudentByIdHandler;
use SchoolManagement\Application\GetStudentById\GetStudentByIdQuery;
use SchoolManagement\Application\ListAllStudents\ListAllStudentsHandler;
use SchoolManagement\Application\ListAllStudents\ListAllStudentsQuery;

final class StudentController
{
    private CreateStudentHandler $createStudentHandler;
    private UpdateStudentHandler $updateStudentHandler;
    private DeleteStudentHandler $deleteStudentHandler;
    private GetStudentByIdHandler $getStudentByIdHandler;
    private ListAllStudentsHandler $listAllStudentsHandler;

    public function __construct(
        CreateStudentHandler $createStudentHandler,
        UpdateStudentHandler $updateStudentHandler,
        DeleteStudentHandler $deleteStudentHandler,
        GetStudentByIdHandler $getStudentByIdHandler,
        ListAllStudentsHandler $listAllStudentsHandler
    ) {
        $this->createStudentHandler = $createStudentHandler;
        $this->updateStudentHandler = $updateStudentHandler;
        $this->deleteStudentHandler = $deleteStudentHandler;
        $this->getStudentByIdHandler = $getStudentByIdHandler;
        $this->listAllStudentsHandler = $listAllStudentsHandler;
    }

    public function create(string $id, string $name, string $email): array
    {
        try {
            $command = new CreateStudentCommand($id, $name, $email);
            $this->createStudentHandler->handle($command);
            return ['success' => true, 'message' => 'Student created successfully'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function update(string $id, string $name, string $email): array
    {
        try {
            $command = new UpdateStudentCommand($id, $name, $email);
            $this->updateStudentHandler->handle($command);
            return ['success' => true, 'message' => 'Student updated successfully'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function delete(string $id): array
    {
        try {
            $command = new DeleteStudentCommand($id);
            $this->deleteStudentHandler->handle($command);
            return ['success' => true, 'message' => 'Student deleted successfully'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getById(string $id): ?array
    {
        try {
            $query = new GetStudentByIdQuery($id);
            $student = $this->getStudentByIdHandler->handle($query);
            return $student ? ['success' => true, 'data' => $student] : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function listAll(): array
    {
        try {
            $query = new ListAllStudentsQuery();
            return $this->listAllStudentsHandler->handle($query);
        } catch (\Exception $e) {
            return [];
        }
    }
}
