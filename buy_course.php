<?php
// Database connection
require 'db.php';

session_start();

// Check if course_id is set
if (isset($_POST['course_id'])) {
    // Get the course ID from the form
    $course_id = $_POST['course_id'];
    $price = $_POST['price'];
    // Perform necessary checks and validation before processing purchase
    // For example, check if the user is logged in, if they have sufficient balance, etc.

    // Once checks are passed, you can process the purchase and insert into user_course table
    $user_id = $_SESSION['user_id']; // Assuming you have a user ID stored in the session
    echo $user_id;
    // Insert into user_course table to associate the user with the purchased course
    $sql = "INSERT INTO user_courses (user_id, course_id,price) VALUES ('$user_id', '$course_id','$price')";
    if ($conn->query($sql) === TRUE) {
        $message = "Purchase of Course ID: $course_id successful!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If course_id is not set, redirect back to the page
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Purchase</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Course Purchase</h2>
        <p><?php echo $message; ?></p>
        <a href="index.php" class="btn btn-primary">Back to Courses</a>
    </div>
</body>

</html>