<?php

declare(strict_types=1);

namespace SchoolManagement\Application\AssignTeacherToSubject;

use SchoolManagement\Domain\Ports\TeacherRepository;
use SchoolManagement\Domain\Ports\SubjectRepository;
use SchoolManagement\Domain\Ports\TransactionalSession;
use SchoolManagement\Domain\Teacher\TeacherId;
use SchoolManagement\Domain\Subject\SubjectId;

final class AssignTeacherToSubjectHandler
{
    private TeacherRepository $teacherRepository;
    private SubjectRepository $subjectRepository;
    private TransactionalSession $transactionalSession;

    public function __construct(
        TeacherRepository $teacherRepository,
        SubjectRepository $subjectRepository,
        TransactionalSession $transactionalSession
    ) {
        $this->teacherRepository = $teacherRepository;
        $this->subjectRepository = $subjectRepository;
        $this->transactionalSession = $transactionalSession;
    }

    public function handle(AssignTeacherToSubjectCommand $command): void
    {
        $this->transactionalSession->execute(function () use ($command) {
            $teacher = $this->teacherRepository->findById(new TeacherId($command->teacherId()));
            $subject = $this->subjectRepository->findById(new SubjectId($command->subjectId()));
            if ($teacher === null || $subject === null) {
                throw new \InvalidArgumentException('Teacher or Subject not found');
            }
            $subject->assignTeacher($teacher);
            $this->subjectRepository->save($subject);
        });
    }
}