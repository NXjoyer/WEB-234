<?php session_start()?>  <!-- Start PHP session to access session variables -->

<?php include("../signup.html")?>  <!-- Include the login form HTML -->

<?php include("../database.php")?>  <!-- Include database connection file -->

<?php 
    // Check if login form was submitted
    if(isset($_POST["submit"])){
        // Validate that email and password fields are not empty
        if(empty($_POST["email"]) || empty($_POST["password"])) {
            echo "Please fill of all the details :(";
        }          
        else {
            // Get email and password from form submission
            $email = $_POST["email"];
            $password = $_POST["password"];
            $id = $_POST["id"];
            
            // SQL query to find user by email
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
        
            // Check if user exists in database
            if(mysqli_num_rows($result) > 0) {
                // Fetch user data as associative array
                $row = mysqli_fetch_assoc($result);

                // Verify submitted password against stored hash
                if(password_verify($password,$row["pass_hash"])) {
                    // Store user's name and id in session
                    $_SESSION["name"] = $row["name"];
                    $_SESSION["id"] = $row["id"];
                    // Redirect to home page on successful login
                    header("Location: ../../Navigation/php/index.php");
                } else {
                    // Password doesn't match
                    echo '<script>alert("You entered a wrong password.");</script>';
                }
            } else {
                // No user found with this email
                echo '<script>alert("That email does not exist.");</script>';
               
            }
        }
    }
?>