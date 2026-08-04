<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title>Project Report</title>

```
<style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 12px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        border: 1px solid #000;
        padding: 8px;
    }

    .label {
        width: 35%;
        font-weight: bold;
        background: #f2f2f2;
    }
</style>
```

</head>
<body>

<h2>DPWH Project Accomplishment Report</h2>

<table>
    <tr>
        <td class="label">Project ID</td>
        <td>{{ $project->project_id }}</td>
    </tr>

```
<tr>
    <td class="label">Project Title</td>
    <td>{{ $project->project_title }}</td>
</tr>

<tr>
    <td class="label">Contract Amount</td>
    <td>₱{{ number_format($project->contract_amount,2) }}</td>
</tr>

<tr>
    <td class="label">Contractor</td>
    <td>{{ $project->contractor }}</td>
</tr>

<tr>
    <td class="label">Project Engineer</td>
    <td>{{ $project->project_engineer }}</td>
</tr>

<tr>
    <td class="label">Physical Accomplishment</td>
    <td>{{ number_format($project->physical_accomplishment,2) }}%</td>
</tr>

<tr>
    <td class="label">Financial Accomplishment</td>
    <td>{{ number_format($project->financial_accomplishment,2) }}%</td>
</tr>

<tr>
    <td class="label">Slippage</td>
    <td>{{ number_format($project->slippage,2) }}%</td>
</tr>

<tr>
    <td class="label">Status</td>
    <td>{{ ucfirst($project->status) }}</td>
</tr>
```

</table>

</body>
</html>
