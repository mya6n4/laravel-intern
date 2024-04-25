<?php
require 'db.php';


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-dark text-white py-2">
        <div class="container d-flex justify-content-end">
            <?php
            session_start();
            if (isset($_SESSION['loggedin'])) {
                echo '<div class="me-auto">Welcome, <a href="myaccount.php">' . $_SESSION['username'] . '!</a></div> <a href="logout.php" class="text-white">Logout</a>';
            } else {
                echo '<button class="btn btn-outline-light me-2" onclick="openModal(\'loginModal\')">Login</button> <button class="btn btn-light" onclick="openModal(\'signupModal\')">Sign Up</button>';
            }
            ?>
        </div>
    </header>


    <div class="container mt-4">
        <h2 class="mb-4">Available Courses</h2>
        <div class="row">
            <?php
            // Check if there are any courses
            if ($result->num_rows > 0) {
                // Loop through each course and generate HTML
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $row['title']; ?></h3>
                                <p class="card-text"><?php echo $row['description']; ?></p>
                                <p class="card-text">Price: <?php echo $row['price']; ?></p>
                                <form action="buy_course.php" method="post">
                                    <input type="hidden" name="course_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                                    <?php if (isset($_SESSION['loggedin'])) { ?>
                                        <button type="submit" class="btn btn-primary">Buy Course</button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-primary" disabled onclick="alert('Please login');">Buy
                                            Course</button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                // If no courses are found
                echo "<p>No courses available.</p>";
            }
            ?>
        </div>
    </div>



    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="database.php" method="post">
                        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                        <input type="password" name="password" class="form-control mb-3" placeholder="Password"
                            required>
                        <input type="submit" class="btn btn-primary" value="Login" name="login" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Signup Modal -->
    <div id="signupModal" class="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sign Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="database.php" method="post">
                        <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
                        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                        <input type="password" name="password" class="form-control mb-3" placeholder="Password"
                            required>
                        <input type="submit" class="btn btn-primary" value="Sign Up" name="signup" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to open modal
        function openModal(modalId) {
            var modal = document.getElementById(modalId);
            var modalBootstrap = new bootstrap.Modal(modal, {
                backdrop: 'static',
                keyboard: false
            });
            modalBootstrap.show();
        }
    </script>
</body>

</html>