<?php

declare(strict_types=1);

namespace SchoolManagement\UI;

use SchoolManagement\Config\Env;
use SchoolManagement\Infrastructure\Persistence\PDO\Connection;
use SchoolManagement\Infrastructure\Persistence\PDO\PDOStudentRepository;
use SchoolManagement\Infrastructure\Persistence\PDO\PDOCourseRepository;
use SchoolManagement\Infrastructure\Persistence\PDO\PDOSubjectRepository;
use SchoolManagement\Infrastructure\Persistence\PDO\PDOTeacherRepository;
use SchoolManagement\Infrastructure\Persistence\InMemory\InMemoryEnrollmentRepository;
use SchoolManagement\Infrastructure\Persistence\InMemory\InMemoryTransactionalSession;
use SchoolManagement\Application\CreateStudent\CreateStudentHandler;
use SchoolManagement\Application\CreateCourse\CreateCourseHandler;
use SchoolManagement\Application\CreateSubject\CreateSubjectHandler;
use SchoolManagement\Application\CreateTeacher\CreateTeacherHandler;
use SchoolManagement\Application\EnrollStudent\EnrollStudentHandler;
use SchoolManagement\Application\AssignTeacherToSubject\AssignTeacherToSubjectHandler;
use SchoolManagement\Application\UpdateStudent\UpdateStudentHandler;
use SchoolManagement\Application\DeleteStudent\DeleteStudentHandler;
use SchoolManagement\Application\GetStudentById\GetStudentByIdHandler;
use SchoolManagement\Application\ListAllStudents\ListAllStudentsHandler;
use SchoolManagement\UI\Controller\StudentController;
use SchoolManagement\UI\Controller\AcademicController;

final class Container
{
    private static array $services = [];

    public static function init(): void
    {
        Env::load('.env');
        $pdo = Connection::getInstance();

        self::$services['studentRepository'] = new PDOStudentRepository($pdo);
        self::$services['courseRepository'] = new PDOCourseRepository($pdo);
        // create teacher before subject to satisfy foreign key
        self::$services['teacherRepository'] = new PDOTeacherRepository($pdo);
        self::$services['subjectRepository'] = new PDOSubjectRepository($pdo);
        self::$services['enrollmentRepository'] = new InMemoryEnrollmentRepository();
        self::$services['transactionalSession'] = new InMemoryTransactionalSession();

        self::$services['createStudentHandler'] = new CreateStudentHandler(
            self::$services['studentRepository']
        );
        self::$services['createCourseHandler'] = new CreateCourseHandler(
            self::$services['courseRepository']
        );
        self::$services['createSubjectHandler'] = new CreateSubjectHandler(
            self::$services['subjectRepository']
        );
        self::$services['createTeacherHandler'] = new CreateTeacherHandler(
            self::$services['teacherRepository']
        );
        self::$services['enrollStudentHandler'] = new EnrollStudentHandler(
            self::$services['studentRepository'],
            self::$services['courseRepository'],
            self::$services['enrollmentRepository'],
            self::$services['transactionalSession']
        );
        self::$services['assignTeacherHandler'] = new AssignTeacherToSubjectHandler(
            self::$services['teacherRepository'],
            self::$services['subjectRepository'],
            self::$services['transactionalSession']
        );
        self::$services['updateStudentHandler'] = new UpdateStudentHandler(
            self::$services['studentRepository']
        );
        self::$services['deleteStudentHandler'] = new DeleteStudentHandler(
            self::$services['studentRepository']
        );
        self::$services['getStudentByIdHandler'] = new GetStudentByIdHandler(
            self::$services['studentRepository']
        );
        self::$services['listAllStudentsHandler'] = new ListAllStudentsHandler(
            self::$services['studentRepository']
        );

        self::$services['studentController'] = new StudentController(
            self::$services['createStudentHandler'],
            self::$services['updateStudentHandler'],
            self::$services['deleteStudentHandler'],
            self::$services['getStudentByIdHandler'],
            self::$services['listAllStudentsHandler']
        );

        self::$services['academicController'] = new AcademicController(
            self::$services['createCourseHandler'],
            self::$services['createSubjectHandler'],
            self::$services['createTeacherHandler'],
            self::$services['enrollStudentHandler'],
            self::$services['assignTeacherHandler']
        );
    }

    public static function get(string $service): mixed
    {
        return self::$services[$service] ?? null;
    }
}
