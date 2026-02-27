<?php

namespace SchoolManagement\Domain\Repository;

use SchoolManagement\Domain\Entity\Assignatura;
use SchoolManagement\Domain\ValueObject\Id;

// comentali per la interfície assignatura repository
interface AssignaturaRepository
{
    public function save(Assignatura $assignatura): void;
    public function findById(Id $id): ?Assignatura;
    public function findAll(): array;
}