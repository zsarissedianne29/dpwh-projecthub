<?php
include 'db.php';

if(isset($_POST['save'])) {

    $title = $_POST['title'];
    $contractor = $_POST['contractor'];
    $location = $_POST['location'];
    $target = $_POST['target_completion'];

    mysqli_query($conn, "
        INSERT INTO projects
        (project_title, contractor, location, target_completion)
        VALUES
        ('$title', '$contractor', '$location', '$target')
    ");

    header('Location: projects.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <div class="card bg-secondary text-white p-4">

        <h2 class="mb-4">Add Project</h2>

        <form method="POST">

            <div class="mb-3">
                <label>Project Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Contractor</label>
                <input type="text" name="contractor" class="form-control">
            </div>

            <div class="mb-3">
                <label>Location</label>
                <input type="text" name="location" class="form-control">
            </div>

            <div class="mb-3">
                <label>Target Completion</label>
                <input type="date" name="target_completion" class="form-control">
            </div>

            <button type="submit" name="save" class="btn btn-primary">
                Save Project
            </button>

        </form>

    </div>
</div>

</body>
</html>