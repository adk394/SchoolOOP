<?php

require_once __DIR__ . '/../vendor/autoload.php';

use SchoolManagement\Config\Env;
use SchoolManagement\UI\Container;
use SchoolManagement\UI\Router;

Env::load('.env');
Container::init();

$studentController = Container::get('studentController');
$academicController = Container::get('academicController');
$router = new Router($studentController, $academicController);

$message = '';
$studentDetails = null;
$allStudents = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = $router->dispatch($_POST);
    
    // make sure message key exists to avoid warnings
    $message = $response['message'] ?? '';

    if (!empty($response['success'])) {
        if (isset($response['data'])) {
            if (is_array($response['data']) && !isset($response['data'][0])) {
                $studentDetails = $response['data']['data'] ?? null;
            } else {
                $allStudents = $response['data'];
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>School Management, de Izan</h1>
            <p>app que maneja estudiantes, cursos, materias y profesores</p>
        </header>

        <?php if (!empty($message)): ?>
            <div class="alert <?= strpos($message, 'successfully') !== false || strpos($message, 'found') !== false ? 'alert-success' : 'alert-error' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <div class="content">
            <nav class="sidebar">
                <ul class="nav-menu">
                    <li><a href="#students" class="nav-link active" data-section="students">Students</a></li>
                    <li><a href="#courses" class="nav-link" data-section="courses">Courses</a></li>
                    <li><a href="#subjects" class="nav-link" data-section="subjects">Subjects</a></li>
                    <li><a href="#teachers" class="nav-link" data-section="teachers">Teachers</a></li>

                </ul>
            </nav>

            <main class="main-content">
                <section id="students" class="section active">
                    <div class="card">
                        <div class="card-header">
                            <h2>Create Student</h2>
                        </div>
                        <form method="POST" class="form">
                            <div class="form-group">
                                <label for="student_id">Student ID</label>
                                <input type="text" id="student_id" name="student_id" required>
                            </div>
                            <div class="form-group">
                                <label for="student_name">Name</label>
                                <input type="text" id="student_name" name="student_name" required>
                            </div>
                            <div class="form-group">
                                <label for="student_email">Email</label>
                                <input type="email" id="student_email" name="student_email" required>
                            </div>
                            <button type="submit" name="create_student" class="btn btn-primary">Create Student</button>
                        </form>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2>Get Student</h2>
                        </div>
                        <form method="POST" class="form">
                            <div class="form-group">
                                <label for="get_student_id">Student ID</label>
                                <input type="text" id="get_student_id" name="get_student_id" required>
                            </div>
                            <button type="submit" name="get_student" class="btn btn-secondary">Get Student</button>
                        </form>
                        <?php if ($studentDetails): ?>
                            <div class="student-details">
                                <h3>Student Details</h3>
                                <p><strong>ID:</strong> <?= htmlspecialchars($studentDetails->id()->value()) ?></p>
                                <p><strong>Name:</strong> <?= htmlspecialchars($studentDetails->name()->value()) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($studentDetails->email()->value()) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2>Update Student</h2>
                        </div>
                        <form method="POST" class="form">
                            <div class="form-group">
                                <label for="update_student_id">Student ID</label>
                                <input type="text" id="update_student_id" name="update_student_id" required>
                            </div>
                            <div class="form-group">
                                <label for="update_student_name">Name</label>
                                <input type="text" id="update_student_name" name="update_student_name" required>
                            </div>
                            <div class="form-group">
                                <label for="update_student_email">Email</label>
                                <input type="email" id="update_student_email" name="update_student_email" required>
                            </div>
                            <button type="submit" name="update_student" class="btn btn-warning">Update Student</button>
                        </form>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2>Delete Student</h2>
                        </div>
                        <form method="POST" class="form">
                            <div class="form-group">
                                <label for="delete_student_id">Student ID</label>
                                <input type="text" id="delete_student_id" name="delete_student_id" required>
                            </div>
                            <button type="submit" name="delete_student" class="btn btn-danger">Delete Student</button>
                        </form>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h2>All Students</h2>
                        </div>
                        <form method="POST" class="form">
                            <button type="submit" name="list_students" class="btn btn-info">List All Students</button>
                        </form>
                        <?php if (!empty($allStudents)): ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($allStudents as $student): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($student->id()->value()) ?></td>
                                            <td><?= htmlspecialchars($student->name()->value()) ?></td>
                                            <td><?= htmlspecialchars($student->email()->value()) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </section>

                <section id="courses" class="section">
                    <div class="card">
                        <div class="card-header">
                            <h2>Create Course</h2>
                        </div>
                        <form method="POST" class="form">
                            <div class="form-group">
                                <label for="course_id">Course ID</label>
                                <input type="text" id="course_id" name="course_id" required>
                            </div>
                            <div class="form-group">
                                <label for="course_name">Course Name</label>
                                <input type="text" id="course_name" name="course_name" required>
                            </div>
                            <button type="submit" name="create_course" class="btn btn-primary">Create Course</button>
                        </form>
                    </div>
                </section>

                <section id="subjects" class="section">
                    <div class="card">
                        <div class="card-header">
                            <h2>Create Subject</h2>
                        </div>
                        <form method="POST" class="form">
                            <div class="form-group">
                                <label for="subject_id">Subject ID</label>
                                <input type="text" id="subject_id" name="subject_id" required>
                            </div>
                            <div class="form-group">
                                <label for="subject_name">Subject Name</label>
                                <input type="text" id="subject_name" name="subject_name" required>
                            </div>
                            <button type="submit" name="create_subject" class="btn btn-primary">Create Subject</button>
                        </form>
                    </div>
                </section>

                <section id="teachers" class="section">
                    <div class="card">
                        <div class="card-header">
                            <h2>Create Teacher</h2>
                        </div>
                        <form method="POST" class="form">
                            <div class="form-group">
                                <label for="teacher_id">Teacher ID</label>
                                <input type="text" id="teacher_id" name="teacher_id" required>
                            </div>
                            <div class="form-group">
                                <label for="teacher_name">Name</label>
                                <input type="text" id="teacher_name" name="teacher_name" required>
                            </div>
                            <div class="form-group">
                                <label for="teacher_email">Email</label>
                                <input type="email" id="teacher_email" name="teacher_email" required>
                            </div>
                            <button type="submit" name="create_teacher" class="btn btn-primary">Create Teacher</button>
                        </form>
                    </div>
                </section>




            </main>
        </div>
    </div>

    <script src="/js/app.js"></script>
</body>
</html>
