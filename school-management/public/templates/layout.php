<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>School Management System</h1>
            <p>Manage students, courses, teachers, and subjects</p>
        </header>

        <?php if (!empty($message)): ?>
            <div class="alert <?= strpos($message, 'successfully') !== false ? 'alert-success' : 'alert-error' ?>">
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
                    <?php include 'students.php'; ?>
                </section>

                <section id="courses" class="section">
                    <?php include 'courses.php'; ?>
                </section>

                <section id="subjects" class="section">
                    <?php include 'subjects.php'; ?>
                </section>

                <section id="teachers" class="section">
                    <?php include 'teachers.php'; ?>
                </section>


            </main>
        </div>
    </div>

    <script src="/js/app.js"></script>
</body>
</html>
