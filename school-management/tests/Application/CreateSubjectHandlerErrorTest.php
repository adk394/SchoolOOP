<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\CreateSubject\CreateSubjectCommand;
use SchoolManagement\Application\CreateSubject\CreateSubjectHandler;
use SchoolManagement\Domain\Ports\SubjectRepository;

final class CreateSubjectHandlerErrorTest extends TestCase
{
    public function test_handle_fails_with_empty_subject_id(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $subjectRepository = $this->createMock(SubjectRepository::class);
        $handler = new CreateSubjectHandler($subjectRepository);
        
        $command = new CreateSubjectCommand('', 'Physics');
        $handler->handle($command);
    }

    public function test_handle_fails_with_empty_subject_name(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        
        $subjectRepository = $this->createMock(SubjectRepository::class);
        $handler = new CreateSubjectHandler($subjectRepository);
        
        $command = new CreateSubjectCommand('subject1', '   ');
        $handler->handle($command);
    }
}
