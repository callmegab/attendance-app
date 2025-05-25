<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <style>
        /* Simple table styling for PDF */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Attendance Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Date</th>
                <th>Status</th>
                <th>Logged In At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
            <tr>
                <td>{{ $loop->iteration }}</td>  <!-- This will output 1, 2, 3, ... -->
                <td>{{ $attendance->employee_name }}</td>
                <td>{{ $attendance->date->format('Y-m-d') }}</td>
                <td>{{ $attendance->status }}</td>
                <td>{{ $attendance->logged_in_at ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>
</body>
</html>
