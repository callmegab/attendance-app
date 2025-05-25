<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance App</title>

    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        #datetime {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Header with App Title and Clock -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Nemsu Attendance</h2>
            <div id="datetime"></div>
        </div>

        <!-- Main Page Content -->
        @yield('content')
    </div>

    <!-- ✅ Bootstrap JS (optional but good for dropdowns, modals) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript Clock -->
    <script>
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'short', year: 'numeric', month: 'short', day: 'numeric',
                hour: '2-digit', minute: '2-digit', second: '2-digit'
            };
            document.getElementById('datetime').textContent = now.toLocaleString('en-US', options);
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
</body>
</html>
