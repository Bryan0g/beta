<?php

require('../../config/db_conection.php');

// Obtener datos del formulario de registro
$email = $_POST['email'];
$pass = $_POST['passwd'];
$enc_pass = md5($pass);

// Verificar si la conexión está abierta y conectarse si no lo está
$query = "SELECT * FROM users WHERE email = '$email'";
$result = pg_query($conn, $query);
$row=pg_fetch_assoc($result);

if ($result) {
    echo "<script>alert('Email already exists!')</script>";
    header('refresh:0; url=http://127.0.0.1/beta/api/src/register_form.html');
    exit();
} 

$query = "INSERT INTO users (email, password) VALUES ('$email', '$enc_pass')";

$result = pg_query($conn, $query);

if ($result) {
    echo "<script>alert('Registration successful')</script>";
    header('refresh:0; url=http://127.0.0.1/beta/api/src/login_form.html');
    exit();
} else {
    echo "Failed to register user: ";
} pg_close($conn);

// Cerrar la conexión si está abierta
/*
echo "Email: " . $email;
echo "<br>Password: " . $pass;
echo "<br>Encrypted Password: " . $enc_pass;
*/

?>
