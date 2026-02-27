<?php

declare(strict_types=1);

namespace SchoolManagement\Application\CreateTeacher;

use SchoolManagement\Domain\Ports\TeacherRepository;
use SchoolManagement\Domain\Teacher\Teacher;
use SchoolManagement\Domain\Teacher\TeacherId;
use SchoolManagement\Domain\Teacher\Name;
use SchoolManagement\Domain\Teacher\Email;

final class CreateTeacherHandler
{
    private TeacherRepository $teacherRepository;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function handle(CreateTeacherCommand $command): void
    {
        $teacher = new Teacher(
            new TeacherId($command->id()),
            new Name($command->name()),
            new Email($command->email())
        );
        $this->teacherRepository->save($teacher);
    }
}