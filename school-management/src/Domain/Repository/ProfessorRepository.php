<?php

namespace SchoolManagement\Domain\Repository;

use SchoolManagement\Domain\Entity\Professor;
use SchoolManagement\Domain\ValueObject\Id;

// comentali per la interfície professor repository
interface ProfessorRepository
{
    public function save(Professor $professor): void;
    public function findById(Id $id): ?Professor;
    public function findAll(): array;
}