<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\PDO;

use PDO;
use SchoolManagement\Domain\Ports\SubjectRepository;
use SchoolManagement\Domain\Subject\Subject;
use SchoolManagement\Domain\Subject\SubjectId;
use SchoolManagement\Domain\Subject\Name;

final class PDOSubjectRepository implements SubjectRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->createTableIfNotExists();
    }

    public function findById(SubjectId $id): ?Subject
    {
        $stmt = $this->connection->prepare('SELECT * FROM subjects WHERE id = ?');
        $stmt->execute([$id->value()]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Subject(
            new SubjectId($row['id']),
            new Name($row['name'])
        );
    }

    public function save(Subject $subject): void
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO subjects (id, name) VALUES (?, ?) ON DUPLICATE KEY UPDATE name = ?'
        );
        $stmt->execute([
            $subject->id()->value(),
            $subject->name()->value(),
            $subject->name()->value(),
        ]);
    }

    public function delete(SubjectId $id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM subjects WHERE id = ?');
        $stmt->execute([$id->value()]);
    }

    public function listAll(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM subjects');
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return array_map(fn ($row) => new Subject(
            new SubjectId($row['id']),
            new Name($row['name'])
        ), $rows);
    }

    private function createTableIfNotExists(): void
    {
        $this->connection->exec(
            'CREATE TABLE IF NOT EXISTS subjects (
                id VARCHAR(255) PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                teacher_id VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (teacher_id) REFERENCES teachers(id)
            )'
        );
    }
}
