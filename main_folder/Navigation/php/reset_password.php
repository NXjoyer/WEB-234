<?php include("../database.php")?>  <!-- Include database connection file -->

<?php
    // Get token from URL and hash it for security
    $token = $_GET["token"];
    $token_hash = hash("sha256",$token);

    // Search for user with matching token hash
    $sql = "SELECT * FROM users WHERE reset_token_hash = '$token_hash'";
    $result = mysqli_query($conn, $sql);

    // Check if token exists in database
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        // Check if token has expired (current time > expiration time)
        if(strtotime($row["reset_token_expires_at"]) <= time())
            die("Token has expired");  // Stop execution if expired
        else
            NULL;  // Do nothing if token is valid
    }
    else
        die("token does not exist");  // Stop execution if token not found

    // Get email from URL for form processing
    $email = $_GET["email"];
?>

<?php include("../reset_password.html");?>
