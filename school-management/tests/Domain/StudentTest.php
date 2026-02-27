<?php

declare(strict_types=1);

namespace SchoolManagement\Tests\Domain;

use PHPUnit\Framework\TestCase;
use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Student\Name;
use SchoolManagement\Domain\Student\Email;

final class StudentTest extends TestCase
{
    public function test_student_id_cannot_be_empty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new StudentId('');
    }

    public function test_student_name_cannot_be_empty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name('   ');
    }

    public function test_student_email_must_be_valid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email('invalid-email');
    }

    public function test_student_email_valid(): void
    {
        $email = new Email('test@example.com');
        $this->assertEquals('test@example.com', $email->value());
    }
}