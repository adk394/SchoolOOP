<?php

declare(strict_types=1);

namespace SchoolManagement\Infrastructure\Persistence\PDO;

use PDO;
use SchoolManagement\Domain\Ports\CourseRepository;
use SchoolManagement\Domain\Course\Course;
use SchoolManagement\Domain\Course\CourseId;
use SchoolManagement\Domain\Course\Name;

final class PDOCourseRepository implements CourseRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
        $this->createTableIfNotExists();
    }

    public function findById(CourseId $id): ?Course
    {
        $stmt = $this->connection->prepare('SELECT * FROM courses WHERE id = ?');
        $stmt->execute([$id->value()]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Course(
            new CourseId($row['id']),
            new Name($row['name'])
        );
    }

    public function save(Course $course): void
    {
        $stmt = $this->connection->prepare(
            'INSERT INTO courses (id, name) VALUES (?, ?) ON DUPLICATE KEY UPDATE name = ?'
        );
        $stmt->execute([
            $course->id()->value(),
            $course->name()->value(),
            $course->name()->value(),
        ]);
    }

    public function delete(CourseId $id): void
    {
        $stmt = $this->connection->prepare('DELETE FROM courses WHERE id = ?');
        $stmt->execute([$id->value()]);
    }

    public function listAll(): array
    {
        $stmt = $this->connection->prepare('SELECT * FROM courses');
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return array_map(fn ($row) => new Course(
            new CourseId($row['id']),
            new Name($row['name'])
        ), $rows);
    }

    private function createTableIfNotExists(): void
    {
        $this->connection->exec(
            'CREATE TABLE IF NOT EXISTS courses (
                id VARCHAR(255) PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )'
        );
    }
}
