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
