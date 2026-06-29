<!DOCTYPE html>
<html>
<head>
    <title>Test Report</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            margin:40px;
        }

        h1{
            text-align:center;
            margin-bottom:5px;
        }

        h3{
            text-align:center;
            margin-top:0;
            margin-bottom:30px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table, th, td{
            border:1px solid #000;
        }

        th{
            width:35%;
            background:#eeeeee;
        }

        th,td{
            padding:10px;
            text-align:left;
        }

        .footer{
            margin-top:50px;
        }

        .signature{
            width:250px;
            border-top:1px solid #000;
            text-align:center;
            padding-top:5px;
            float:right;
        }

        @media print{
            body{
                margin:20px;
            }
        }
    </style>

</head>

<body onload="window.print()">

<h1>SRS Lab Automation System</h1>
<h3>Test Report</h3>

<table>

<tr>
    <th>Database ID</th>
    <td>{{ $test->id }}</td>
</tr>

<tr>
    <th>Test ID</th>
    <td>{{ $test->test_id }}</td>
</tr>

<tr>
    <th>Product ID</th>
    <td>{{ $test->product_id }}</td>
</tr>

<tr>
    <th>Test Type</th>
    <td>{{ ucfirst($test->test_type) }}</td>
</tr>

<tr>
    <th>Result</th>
    <td>{{ ucfirst($test->result) }}</td>
</tr>

<tr>
    <th>Tester Name</th>
    <td>{{ $test->tester_name }}</td>
</tr>

<tr>
    <th>Test Date</th>
    <td>{{ $test->test_date }}</td>
</tr>

<tr>
    <th>Remarks</th>
    <td>{{ $test->remarks }}</td>
</tr>

<tr>
    <th>Created At</th>
    <td>{{ $test->created_at }}</td>
</tr>

</table>

<div class="footer">
    <div class="signature">
        Authorized Signature
    </div>
</div>

</body>
</html>