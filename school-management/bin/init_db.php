<?php

require_once __DIR__ . '/../vendor/autoload.php';

use SchoolManagement\Config\Env;
use SchoolManagement\Infrastructure\Persistence\PDO\Connection;
use SchoolManagement\Infrastructure\Persistence\PDO\PDOStudentRepository;
use SchoolManagement\Infrastructure\Persistence\PDO\PDOCourseRepository;
use SchoolManagement\Infrastructure\Persistence\PDO\PDOTeacherRepository;
use SchoolManagement\Infrastructure\Persistence\PDO\PDOSubjectRepository;

Env::load(__DIR__ . '/../.env');

$pdo = Connection::getInstance();

echo "Initializing database tables...\n";

new PDOStudentRepository($pdo);
new PDOCourseRepository($pdo);
new PDOTeacherRepository($pdo);
new PDOSubjectRepository($pdo);

echo "Done. Tables created if not existing.\n";
