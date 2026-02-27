<?php

declare(strict_types=1);

namespace SchoolManagement\Application\ListAllStudents;

use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\Student;

final class ListAllStudentsHandler
{
    private StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * @return Student[]
     */
    public function handle(ListAllStudentsQuery $query): array
    {
        return $this->studentRepository->listAll();
    }
}