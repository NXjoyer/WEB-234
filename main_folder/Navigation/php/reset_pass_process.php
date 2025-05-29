<?php include("../database.php")?>  <!-- Include database connection file -->

<?php 
// Check if form was submitted
if(isset($_POST["submit"])){
    // Get email from form
    $email = $_POST["email"];
    // Sanitize and filter password input
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // Create password hash for secure storage
    $password_hash = password_hash($password,PASSWORD_DEFAULT);

    // SQL query to update password in database
    $sql = "UPDATE users SET pass_hash='$password_hash' WHERE email='$email'";
    // Execute the query
    mysqli_query($conn,$sql);
}
else
    // Display error if form wasn't submitted properly
    echo "Your password failed to change";
?>

<?php include("../reset_pass_process.html")?>