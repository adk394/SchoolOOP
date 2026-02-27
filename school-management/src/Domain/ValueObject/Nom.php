<?php

namespace SchoolManagement\Domain\ValueObject;

// comentali per el nom
class Nom
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
}