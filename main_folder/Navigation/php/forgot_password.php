<?php include("../forgot_password.html")?>  <!-- Include the HTML form for password recovery -->
<?php include("../database.php")?>          <!-- Include database connection file -->

<?php 
    // Check if the form was submitted
    if(isset($_POST["submit"])){

        // Get email from form submission
        $email = $_POST["email"];
        
        // SQL query to check if email exists in database
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        // If email exists in database
        if(mysqli_num_rows($result) > 0){
            // Generate a random token for password reset
            $token = bin2hex(random_bytes(16));

            // Create a hashed version of the token for secure storage
            $token_hash = hash("sha256",$token);

            // Set expiration time for token (30 minutes from now)
            $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

            // Update user record with token hash and expiration time
            $sql = "UPDATE users SET reset_token_hash='$token_hash',reset_token_expires_at='$expiry' WHERE email='$email'";
            mysqli_query($conn,$sql);

           // Include and configure email sending script
           $mail = require __DIR__ . "/send_email.php";
           // Set email sender details
           $mail->setFrom('autodrivesystem@gmail.com', 'AutoDrive System');
           // Set reply-to address
           $mail->addReplyTo('autodrivesupport@gmail.com', 'AutoDrive Support');
           // Set recipient email
           $mail->addAddress($email);
           // Set email subject
           $mail->Subject = 'Your AutoDrive Account: Password Reset Link';
           // Create email body with reset link
           $mail->Body = <<<END

           Click <a href="http://localhost/software_design/LoginForm/php/reset_password.php?token=$token&email=$email">here</a>
           to reset your password.
           END;
          
           // Try to send the email
           try{
            $mail->send();
            echo '<script>alert("Message sent, please check your inbox.");</script>';
           }

           // Catch and display any email sending errors
           catch(Exception $e){
            echo '<script>alert("Message could not be sent. Mailer error.");</script>';
           }

         }
     
        else
        // Display error if email doesn't exist in database
        echo '<script>alert("Your email does not exist.");</script>';
       
        // Display success message (note: this will show even if email doesn't exist)
       
    }
?>