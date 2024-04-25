<?php
session_start(); // Start the session

if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
    // If admin is logged in, get the username
    $admin_username = $_SESSION['admin_username'];
} else {
    // If admin is not logged in, redirect to the login page
    header("Location: login.php");
    exit; // Ensure script execution stops here
}
require '../db.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create New Course
if (isset($_POST['create_course'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Insert new course into database
    $sql = "INSERT INTO courses (title, description, price) VALUES ('$title', '$description', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "New course created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Display All Courses
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Courses</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add custom styles here */
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Online Courses</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Dashboard</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#createArticleModal">Create
                                New Article</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#createCourseModal">Create New
                                Course</a>
                        </li>

                        <li class="nav-item">
                            <span class="navbar-text text-light mr-3">
                                Welcome, <?php echo $admin_username; ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-12">
                <div id="mainContent">
                    <!-- Course Listings -->
                    <section id="coursesSection">
                        <h2>Courses</h2>
                        <div class="row">
                            <?php
                            // Display all courses
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row["title"]; ?></h5>
                                                <p class="card-text"><?php echo $row["description"]; ?></p>
                                                <p class="card-text">Price: $<?php echo $row["price"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "<p>No results found.</p>";
                            }
                            ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>


    <!-- Create Article Modal
    <div class="modal fade" id="createArticleModal" tabindex="-1" role="dialog"
        aria-labelledby="createArticleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createArticleModalLabel">Create Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="database.php" method="post">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="form-control" rows="4"
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" id="price" name="price" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="create_course">Create Course</button>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Create Article Modal -->
    <div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="createCourseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createArticleModalLabel">Create Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="database.php" method="post">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="form-control" rows="4"
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" id="price" name="price" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="create_course">Create Course</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>