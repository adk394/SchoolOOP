<?php

declare(strict_types=1);

namespace SchoolManagement\Application\DeleteStudent;

final class DeleteStudentCommand
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