<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\PDO;

use PDO;
use SchoolManagement\Domain\Ports\TeacherRepository;
use SchoolManagement\Domain\Teacher\Teacher;
use SchoolManagement\Domain\Teacher\TeacherId;
use SchoolManagement\Domain\Teacher\Name;
use SchoolManagement\Domain\Teacher\Email;

final class PDOTeacherRepository implements TeacherRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->createTableIfNotExists();
    }

    public function findById(TeacherId $id): ?Teacher
    {
        $stmt = $this->connection->prepare('SELECT * FROM teachers WHERE id = ?');
        $stmt->execute([$id->value()]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Teacher(
            new TeacherId($row['id']),
            new Name($row['name']),
            new Email($row['email'])
        );
    }

    public function save(Teacher $teacher): void
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO teachers (id, name, email) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE name = ?, email = ?'
        );
        $stmt->execute([
            $teacher->id()->value(),
            $teacher->name()->value(),
            $teacher->email()->value(),
            $teacher->name()->value(),
            $teacher->email()->value(),
        ]);
    }

    public function delete(TeacherId $id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM teachers WHERE id = ?');
        $stmt->execute([$id->value()]);
    }

    public function listAll(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM teachers');
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return array_map(fn ($row) => new Teacher(
            new TeacherId($row['id']),
            new Name($row['name']),
            new Email($row['email'])
        ), $rows);
    }

    private function createTableIfNotExists(): void
    {
        $this->connection->exec(
            'CREATE TABLE IF NOT EXISTS teachers (
                id VARCHAR(255) PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )'
        );
    }
}
