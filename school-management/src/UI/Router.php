<?php

declare(strict_types=1);

namespace SchoolManagement\UI;

use SchoolManagement\UI\Controller\StudentController;
use SchoolManagement\UI\Controller\AcademicController;

final class Router
{
    private StudentController $studentController;
    private AcademicController $academicController;

    public function __construct(
        StudentController $studentController,
        AcademicController $academicController
    ) {
        $this->studentController = $studentController;
        $this->academicController = $academicController;
    }

    public function dispatch(array $post): array
    {
        if (isset($post['create_student'])) {
            return $this->studentController->create(
                $post['student_id'],
                $post['student_name'],
                $post['student_email']
            );
        }

        if (isset($post['create_course'])) {
            return $this->academicController->createCourse(
                $post['course_id'],
                $post['course_name']
            );
        }

        if (isset($post['create_subject'])) {
            return $this->academicController->createSubject(
                $post['subject_id'],
                $post['subject_name']
            );
        }

        if (isset($post['create_teacher'])) {
            return $this->academicController->createTeacher(
                $post['teacher_id'],
                $post['teacher_name'],
                $post['teacher_email']
            );
        }

        if (isset($post['enroll_student'])) {
            return $this->academicController->enrollStudent(
                $post['enroll_student_id'],
                $post['enroll_course_id']
            );
        }

        if (isset($post['assign_teacher'])) {
            return $this->academicController->assignTeacher(
                $post['assign_teacher_id'],
                $post['assign_subject_id']
            );
        }

        if (isset($post['update_student'])) {
            return $this->studentController->update(
                $post['update_student_id'],
                $post['update_student_name'],
                $post['update_student_email']
            );
        }

        if (isset($post['delete_student'])) {
            return $this->studentController->delete(
                $post['delete_student_id']
            );
        }

        if (isset($post['get_student'])) {
            $student = $this->studentController->getById($post['get_student_id']);
            return $student ?? ['success' => false, 'message' => 'Student not found'];
        }

        if (isset($post['list_students'])) {
            return ['success' => true, 'data' => $this->studentController->listAll()];
        }

        return ['success' => false, 'message' => 'No action specified'];
    }
}
