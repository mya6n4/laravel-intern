<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2 class="mt-5">Admin Login</h2>
        <form method="post" action="database.php" class="mt-3">
            <div class="form-group">
                <input type="text" name="admin_username" class="form-control" placeholder="Admin Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="admin_password" class="form-control" placeholder="Admin Password" required>
            </div>
            <input type="submit" name="admin_login" class="btn btn-primary" value="Login" />
        </form>
    </div>

    <!-- Bootstrap JS (optional, only needed if you use Bootstrap JS features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>