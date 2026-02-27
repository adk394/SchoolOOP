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
