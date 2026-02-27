<?php

namespace SchoolManagement\Domain\Repository;

use SchoolManagement\Domain\Entity\Estudiant;
use SchoolManagement\Domain\ValueObject\Id;

// comentali per la interfície estudiant repository
interface EstudiantRepository
{
    public function save(Estudiant $estudiant): void;
    public function findById(Id $id): ?Estudiant;
    public function findAll(): array;
}