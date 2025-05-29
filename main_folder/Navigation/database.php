<?php
    // Database connection parameters
    $db_server = "localhost";       // Server name (usually localhost)
    $db_user = "root";              // Database username
    $db_password = "";              // Database password (empty in this case)
    $db_name = "loginform_db";       // Name of the database to connect to

   
         try{
        // Attempt to connect to the MySQL database using the provided credentials
        $conn = mysqli_connect($db_server,$db_user, $db_password, $db_name);
        // If connection is successful, this line would display a message (currently commented out)
        //echo "You are connected :)";
             }
    
        catch(mysqli_sql_exception){
        // This block executes if the connection attempt fails
        echo "You are not connected :(";
        } 

        $checkTable = "SHOW TABLES LIKE 'users'";
        $result = $conn->query($checkTable);

    if($result->num_rows == 0){
       $sql = "CREATE TABLE users (
             id INT(11) NOT NULL AUTO_INCREMENT,
             name VARCHAR(128) NOT NULL,
             email VARCHAR(255) NOT NULL,
             pass_hash VARCHAR(255) NOT NULL,
             date DATE NOT NULL,
             gender CHAR(25) NOT NULL,
             reset_token_hash VARCHAR(64) NULL , UNIQUE (`reset_token_hash`),
             reset_token_expires_at DATETIME NULL,
             PRIMARY KEY (`id`),
             UNIQUE (`email`)
        )";

        if ($conn->query($sql) === TRUE) {
            // echo "Table MyGuests created successfully";
            } else {
           // echo "Error creating table: " . $conn->error;
            }
      }

      $checkTable = "SHOW TABLES LIKE 'post_vehicle'";
      $result = $conn->query($checkTable);

       if($result->num_rows == 0){
        $sql = "CREATE TABLE post_vehicle (
        id INT(11) NOT NULL,
        post_id INT(11) NOT NULL AUTO_INCREMENT,
        year YEAR(4) NOT NULL,
        price INT(128) NOT NULL,
        specs VARCHAR(225) NOT NULL,
        filename VARCHAR(100) NOT NULL,
        name VARCHAR(128) NOT NULL,
        email VARCHAR(225) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        description VARCHAR(500) NOT NULL,
        model VARCHAR(128) NOT NULL,
        PRIMARY KEY (`post_id`)
        )";

        if ($conn->query($sql) === TRUE) {
            // echo "Table MyGuests created successfully";
            } else {
           // echo "Error creating table: " . $conn->error;
            }
      }
          
?>