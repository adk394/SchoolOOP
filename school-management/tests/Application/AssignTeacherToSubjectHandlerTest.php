<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\AssignTeacherToSubject\AssignTeacherToSubjectCommand;
use SchoolManagement\Application\AssignTeacherToSubject\AssignTeacherToSubjectHandler;
use SchoolManagement\Domain\Ports\TeacherRepository;
use SchoolManagement\Domain\Ports\SubjectRepository;
use SchoolManagement\Domain\Ports\TransactionalSession;
use SchoolManagement\Domain\Teacher\Teacher;
use SchoolManagement\Domain\Teacher\TeacherId;
use SchoolManagement\Domain\Teacher\Name;
use SchoolManagement\Domain\Teacher\Email;
use SchoolManagement\Domain\Subject\Subject;
use SchoolManagement\Domain\Subject\SubjectId;
use SchoolManagement\Domain\Subject\Name as SubjectName;

final class AssignTeacherToSubjectHandlerTest extends TestCase
{
    public function test_handle_assigns_teacher_and_saves(): void
    {
        $teacherRepository = $this->createMock(TeacherRepository::class);
        $subjectRepository = $this->createMock(SubjectRepository::class);
        $transactionalSession = $this->createMock(TransactionalSession::class);

        $teacher = new Teacher(
            new TeacherId('teacher1'),
            new Name('Jane Doe'),
            new Email('jane@example.com')
        );
        $subject = new Subject(
            new SubjectId('subject1'),
            new SubjectName('Physics')
        );

        $teacherRepository->expects($this->once())
            ->method('findById')
            ->with(new TeacherId('teacher1'))
            ->willReturn($teacher);

        $subjectRepository->expects($this->once())
            ->method('findById')
            ->with(new SubjectId('subject1'))
            ->willReturn($subject);

        $subjectRepository->expects($this->once())
            ->method('save')
            ->with($subject);

        $transactionalSession->expects($this->once())
            ->method('execute')
            ->willReturnCallback(function ($callable) {
                $callable();
            });

        $handler = new AssignTeacherToSubjectHandler(
            $teacherRepository,
            $subjectRepository,
            $transactionalSession
        );

        $command = new AssignTeacherToSubjectCommand('teacher1', 'subject1');
        $handler->handle($command);
    }
}