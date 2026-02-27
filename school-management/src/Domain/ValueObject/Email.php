<?php

namespace SchoolManagement\Domain\ValueObject;

// comentali per la validacio de email
class Email
{
    private string $value;

    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email invalid");
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}