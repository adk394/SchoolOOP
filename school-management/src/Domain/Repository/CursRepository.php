<?php

namespace SchoolManagement\Domain\Repository;

use SchoolManagement\Domain\Entity\Curs;
use SchoolManagement\Domain\ValueObject\Id;

// comentali per la interfície curs repository
interface CursRepository
{
    public function save(Curs $curs): void;
    public function findById(Id $id): ?Curs;
    public function findAll(): array;
}