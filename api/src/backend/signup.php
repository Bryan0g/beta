<?php

        //DB database connection

        require('../../config/db_conection.php');
        //Get data from register form 
        $email=$_POST['email'];
        $pass=$_POST['passwd'];
        $enc_pass=md5($pass);

$enc_pass=md5($pass);

$query = "INSERT INTO users (email, password) VALUES ($1, $2)";
$result = pg_query_params($conn, $query, array($email, $enc_pass));

if ($result) {
        echo "User registered successfully";
    } else {
        echo "Failed to register user";
    }
    
    // Cerrar la conexión
    pg_close($conn);

     /*
       echo "Email: " . $email;
       echo "<br>Password: " . $pass;
       echo "<br>Encrypted Password: " . $enc_pass;
      */


?>