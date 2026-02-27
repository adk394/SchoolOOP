<?php

declare(strict_types=1);

namespace SchoolManagement\Application\DeleteStudent;

use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\StudentId;

final class DeleteStudentHandler
{
    private StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function handle(DeleteStudentCommand $command): void
    {
        $this->studentRepository->delete(new StudentId($command->id()));
    }
}