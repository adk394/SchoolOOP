<?php

declare(strict_types=1);

namespace SchoolManagement\Application\GetStudentById;

use SchoolManagement\Domain\Student\Student;

final class GetStudentByIdQuery
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}