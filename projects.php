<?php
include 'db.php';

$result = mysqli_query($conn,
    "SELECT * FROM projects ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-4">
        <h2>Projects</h2>

        <a href="add-project.php" class="btn btn-primary">
            + Add Project
        </a>
    </div>

    <table class="table table-dark table-bordered table-striped">
        <thead>
            <tr>
                <th>Project Title</th>
                <th>Contractor</th>
                <th>Location</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['project_title']; ?></td>
                <td><?= $row['contractor']; ?></td>
                <td><?= $row['location']; ?></td>
                <td><?= ucfirst($row['status']); ?></td>
            </tr>
        <?php endwhile; ?>

        </tbody>
    </table>

</div>

</body>
</html>