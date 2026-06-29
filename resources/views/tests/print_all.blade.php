<!DOCTYPE html>
<html>
<head>
    <title>All Test Reports</title>

    <style>
        body{
            font-family:Arial;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table,th,td{
            border:1px solid black;
        }

        th,td{
            padding:8px;
        }
    </style>
</head>

<body onload="window.print()">

<h2 align="center">ALL TEST REPORTS</h2>

<table>
<thead>
<tr>
    <th>ID</th>
    <th>Product</th>
    <th>Batch</th>
    <th>Status</th>
</tr>
</thead>

<tbody>

@foreach($reports as $report)

<tr>
    <td>{{ $report->id }}</td>
    <td>{{ $report->product_name }}</td>
    <td>{{ $report->batch_no }}</td>
    <td>{{ $report->status }}</td>
</tr>

@endforeach

</tbody>
</table>

</body>
</html>