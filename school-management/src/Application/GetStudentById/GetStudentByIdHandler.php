<?php

declare(strict_types=1);

namespace SchoolManagement\Application\GetStudentById;

use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\Student;
use SchoolManagement\Domain\Student\StudentId;

final class GetStudentByIdHandler
{
    private StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function handle(GetStudentByIdQuery $query): ?Student
    {
        return $this->studentRepository->findById(new StudentId($query->id()));
    }
}