<?php include("../database.php");?>  <!-- Include database connection file -->

<?php include("../email_confirmation.html")?>

<?php
    // Get user registration data from URL parameters
    $name = $_GET["name"];
    $email = $_GET["email"];
    $password = $_GET["password"];
    $date = $_GET["date"];
    $gender = $_GET["gender"];

    try{
        // Hash the password for security before storing in database
        $pass_hash = password_hash($password,PASSWORD_DEFAULT);
        
        // SQL query to insert new user data into database
        $sql = "INSERT INTO users(name,email,pass_hash,date,gender) VALUES ('$name','$email','$pass_hash','$date','$gender')"; 
        
        // Execute the SQL query
        mysqli_query($conn,$sql);
    }
    
    catch(mysqli_sql_exception){
        // Display error message if email already exists in database
        echo '<script>alert("This email is already created");</script>';
    }

?>