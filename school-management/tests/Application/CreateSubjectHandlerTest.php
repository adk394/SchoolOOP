<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Application;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Application\CreateSubject\CreateSubjectCommand;
use SchoolManagement\Application\CreateSubject\CreateSubjectHandler;
use SchoolManagement\Domain\Ports\SubjectRepository;

final class CreateSubjectHandlerTest extends TestCase
{
    public function test_handle_creates_and_saves_subject(): void
    {
        $subjectRepository = $this->createMock(SubjectRepository::class);

        $subjectRepository->expects($this->once())
            ->method('save');

        $handler = new CreateSubjectHandler($subjectRepository);

        $command = new CreateSubjectCommand('subject1', 'Physics');
        $handler->handle($command);
    }
}