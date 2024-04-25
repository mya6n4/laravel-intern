
<?php
require 'db.php';

// Start session and include database connection
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

// Fetch user's courses from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT courses.*,user_courses.price as p FROM user_courses
        INNER JOIN courses ON user_courses.course_id = courses.id
        WHERE user_courses.user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>My Account - My Courses</h2>
        <div class="row">
            <?php
            // Check if there are any courses
            if ($result->num_rows > 0) {
                // Loop through each course and display it
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $row['title']; ?></h3>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="card-text">Price: <?php echo $row['p']; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // If no courses are found for the user
                echo "<p>No courses found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
