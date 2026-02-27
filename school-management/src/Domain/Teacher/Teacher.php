<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Teacher;

final class Teacher
{
    private TeacherId $id;
    private Name $name;
    private Email $email;

    public function __construct(TeacherId $id, Name $name, Email $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function id(): TeacherId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }
}