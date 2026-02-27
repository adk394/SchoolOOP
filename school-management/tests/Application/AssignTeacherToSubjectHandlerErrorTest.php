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
use SchoolManagement\Domain\Teacher\Name as TeacherName;
use SchoolManagement\Domain\Teacher\Email as TeacherEmail;
use SchoolManagement\Domain\Subject\Subject;
use SchoolManagement\Domain\Subject\SubjectId;
use SchoolManagement\Domain\Subject\Name as SubjectName;

final class AssignTeacherToSubjectHandlerErrorTest extends TestCase
{
    public function test_handle_fails_with_non_existent_teacher(): void
    {
        $teacherRepository = $this->createMock(TeacherRepository::class);
        $teacherRepository->method('findById')->willReturn(null);
        
        $subjectRepository = $this->createMock(SubjectRepository::class);
        $transactionalSession = $this->createMock(TransactionalSession::class);
        
        $transactionalSession->method('execute')->will(
            $this->returnCallback(function($callback) {
                return $callback();
            })
        );
        
        $handler = new AssignTeacherToSubjectHandler(
            $teacherRepository,
            $subjectRepository,
            $transactionalSession
        );
        
        $this->expectException(\InvalidArgumentException::class);
        
        $command = new AssignTeacherToSubjectCommand('non_existent_teacher', 'subject1');
        $handler->handle($command);
    }

    public function test_handle_fails_with_non_existent_subject(): void
    {
        $teacher = new Teacher(
            new TeacherId('teacher1'),
            new TeacherName('Jane'),
            new TeacherEmail('jane@example.com')
        );
        
        $teacherRepository = $this->createMock(TeacherRepository::class);
        $teacherRepository->method('findById')->willReturn($teacher);
        
        $subjectRepository = $this->createMock(SubjectRepository::class);
        $subjectRepository->method('findById')->willReturn(null);
        
        $transactionalSession = $this->createMock(TransactionalSession::class);
        $transactionalSession->method('execute')->will(
            $this->returnCallback(function($callback) {
                return $callback();
            })
        );
        
        $handler = new AssignTeacherToSubjectHandler(
            $teacherRepository,
            $subjectRepository,
            $transactionalSession
        );
        
        $this->expectException(\InvalidArgumentException::class);
        
        $command = new AssignTeacherToSubjectCommand('teacher1', 'non_existent_subject');
        $handler->handle($command);
    }

    public function test_handle_fails_when_assigning_twice(): void
    {
        $this->expectException(\DomainException::class);
        
        $teacher = new Teacher(
            new TeacherId('teacher1'),
            new TeacherName('Jane'),
            new TeacherEmail('jane@example.com')
        );
        
        $subject = new Subject(
            new SubjectId('subject1'),
            new SubjectName('Math')
        );
        
        $subject->assignTeacher($teacher);
        $subject->assignTeacher($teacher);
    }
}
