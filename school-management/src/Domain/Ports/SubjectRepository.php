<?php

declare(strict_types=1);

namespace SchoolManagement\Domain\Ports;

use SchoolManagement\Domain\Subject\Subject;
use SchoolManagement\Domain\Subject\SubjectId;

interface SubjectRepository
{
    public function findById(SubjectId $id): ?Subject;
    public function save(Subject $subject): void;
}