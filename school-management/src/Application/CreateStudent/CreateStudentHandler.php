<?php

declare(strict_types=1);

namespace SchoolManagement\Application\CreateStudent;

use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\Student;
use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Student\Name;
use SchoolManagement\Domain\Student\Email;

final class CreateStudentHandler
{
    private StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function handle(CreateStudentCommand $command): void
    {
        $student = new Student(
            new StudentId($command->id()),
            new Name($command->name()),
            new Email($command->email())
        );

        $this->studentRepository->save($student);
    }
}
