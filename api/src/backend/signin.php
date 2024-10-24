<?php

require('../../config/db_conection.php');
  
$email = $_POST['email'];
$pass = $_POST['passwd'];

$enc_pass = md5($pass);

$query = "SELECT * FROM users WHERE email = '$email' AND passwd = '$enc_pass'";

$result = pg_query($conn, $query);

$row=pg_fetch_assoc($result);

if($row){
    header('refresh:0; url=http://127.0.0.1/beta/api/src/home.php');
    }else{
    echo "<script>alert('invalid email or password!')</script>";
    header('refresh:0; url=http://127.0.0.1/beta/api/src/login_form.html');
}


$result=pg_query
?>
