<?php include("../register.html")?>  <!-- Include the registration form HTML -->

<?php include("../database.php")?>  <!-- Include database connection file -->

<?php 
    // Check if registration form was submitted
    if(isset($_POST["submit-confirm"])){
       
    // Sanitize and filter user input for security
    $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $date = $_POST["dob"];  // Date of birth (not sanitized in this example)
    $gender = $_POST["gender"];  // Gender selection (not sanitized in this example)

    // Check if email already exists in database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    // If email exists, show error message
    if(mysqli_num_rows($result) > 0)
        echo '<script>alert("That email is already taken :(");</script>';
        
    // Check if any required fields are empty
    else if(empty($name) || empty($email) || empty($password) || empty($date) || empty($gender))
        echo "<script>alert('Please fill of all the details :( ');</script>" ;

    // If validation passes, send confirmation email
    else{
        // Include and configure email sending script
        $mail = require __DIR__ . "/send_email.php";
        // Set email sender details
        $mail->setFrom('autodrivesystem@gmail.com', 'AutoDrive System');
        // Set reply-to address
        $mail->addReplyTo('autodrivesupport@gmail.com', 'AutoDrive Support');
        // Set recipient email
        $mail->addAddress($email);
        // Set email subject
        $mail->Subject = 'Your AutoDrive Account: Email Confirmation Link';
        // Create email body with confirmation link containing user data
        $mail->Body = <<<END

        Click <a href="http://localhost/software_design/LoginForm/php/email_confirmation.php?name=$name&email=$email&password=$password&date=$date&gender=$gender">here</a>
        to confirm your email.
        END;

         
        // Try to send the email
        try{
         $mail->send();
        // Notify user that email was sent
        echo '<script>alert("Message sent, please check your email.");</script>';
        }

        // Catch and display any email sending errors
        catch(Exception $e){
        echo '<script>alert("Message could not be sent. Mailer error.");</script>';
        }
    }
    }
       
?>