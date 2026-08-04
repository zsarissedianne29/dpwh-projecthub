<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DPWH Project Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #0d6efd;
            color: white;
        }
    </style>
</head>
<body>

    <h2>DPWH ProjectHub</h2>
    <h3>Consolidated Project Report</h3>

    <table>
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Project Title</th>
                <th>Engineer</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr>
                <td>{{ $project->project_id }}</td>
                <td>{{ $project->project_title }}</td>
                <td>{{ $project->project_engineer }}</td>
                <td>{{ ucfirst($project->status) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</body>
</html>