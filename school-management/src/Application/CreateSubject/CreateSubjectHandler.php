<?php

declare(strict_types=1);

namespace SchoolManagement\Application\CreateSubject;

use SchoolManagement\Domain\Ports\SubjectRepository;
use SchoolManagement\Domain\Subject\Subject;
use SchoolManagement\Domain\Subject\SubjectId;
use SchoolManagement\Domain\Subject\Name;

final class CreateSubjectHandler
{
    private SubjectRepository $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    public function handle(CreateSubjectCommand $command): void
    {
        $subject = new Subject(
            new SubjectId($command->id()),
            new Name($command->name())
        );
        $this->subjectRepository->save($subject);
    }
}