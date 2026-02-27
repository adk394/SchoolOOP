<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\PDO;

use PDO;
use SchoolManagement\Domain\Ports\StudentRepository;
use SchoolManagement\Domain\Student\Student;
use SchoolManagement\Domain\Student\StudentId;
use SchoolManagement\Domain\Student\Name;
use SchoolManagement\Domain\Student\Email;

final class PDOStudentRepository implements StudentRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->createTableIfNotExists();
    }

    public function findById(StudentId $id): ?Student
    {
        $stmt = $this->connection->prepare('SELECT * FROM students WHERE id = ?');
        $stmt->execute([$id->value()]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Student(
            new StudentId($row['id']),
            new Name($row['name']),
            new Email($row['email'])
        );
    }

    public function save(Student $student): void
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO students (id, name, email) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE name = ?, email = ?'
        );
        $stmt->execute([
            $student->id()->value(),
            $student->name()->value(),
            $student->email()->value(),
            $student->name()->value(),
            $student->email()->value(),
        ]);
    }

    public function delete(StudentId $id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM students WHERE id = ?');
        $stmt->execute([$id->value()]);
    }

    public function listAll(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM students');
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return array_map(fn ($row) => new Student(
            new StudentId($row['id']),
            new Name($row['name']),
            new Email($row['email'])
        ), $rows);
    }

    private function createTableIfNotExists(): void
    {
        $this->connection->exec(
            'CREATE TABLE IF NOT EXISTS students (
                id VARCHAR(255) PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )'
        );
    }
}
