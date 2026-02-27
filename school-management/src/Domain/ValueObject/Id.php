<?php

namespace SchoolManagement\Domain\ValueObject;

// aquest es un comentali per la clase id
class Id
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function equals(Id $other): bool
    {
        return $this->value === $other->value;
    }
}