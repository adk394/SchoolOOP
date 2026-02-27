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
