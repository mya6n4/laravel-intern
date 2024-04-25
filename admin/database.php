<?php
require '../db.php';


// User login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Start session and store user data
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("Location: dashboard.php");
        exit;
    } else {
        $login_error = "Invalid email or password";
    }
}

// User signup
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        // Redirect to login page after successful signup
        header("Location: login.php");
        exit;
    } else {
        $signup_error = "Error: " . $conn->error;
    }
}

// Admin login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin_login'])) {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    // SQL query to fetch admin details
    $sql = "SELECT * FROM admin WHERE email = '$admin_username' AND password = '$admin_password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Start session and store admin data
        session_start();
        $_SESSION['admin_loggedin'] = true;
        $_SESSION['admin_username']=mysqli_fetch_assoc( $result )['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $admin_login_error = "Invalid admin username or password";
    }
}

// Admin create course
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_course'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO courses (title, description, price) VALUES ('$title', '$description', '$price')";
    if ($conn->query($sql) === TRUE) {
        $course_success = "Course created successfully";
    } else {
        $course_error = "Error: " . $conn->error;
    }
}

// Admin create article under course
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_article'])) {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO articles (course_id, title, content) VALUES ('$course_id', '$title', '$content')";
    if ($conn->query($sql) === TRUE) {
        $article_success = "Article created successfully";
    } else {
        $article_error = "Error: " . $conn->error;
    }
}

// User buy course
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buy_course'])) {
    $user_id = $_SESSION['user_id'];
    $course_id = $_POST['course_id'];

    $sql = "INSERT INTO user_courses (user_id, course_id) VALUES ('$user_id', '$course_id')";
    if ($conn->query($sql) === TRUE) {
        $buy_success = "Course purchased successfully";
    } else {
        $buy_error = "Error: " . $conn->error;
    }
}


$url = "index.php";
if (isset($_SERVER['HTTP_REFERER'])) {
    $referringPage = $_SERVER['HTTP_REFERER'];
    // Redirect back to the referring page
    header("Location: $referringPage");
    exit;
} else {
    // If no referring page is set, redirect to a default page (e.g., index.php)
    header('Location: ' . $url);
    exit;
}
?>