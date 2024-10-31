<?php


function save_data_supabase($email, $password){
    //supabase 
    $SUPABASE_URL = 'https://eprfivfbtjombptxqxbt.supabase.co';
    $SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVwcmZpdmZidGpvbWJwdHhxeGJ0Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzAzODg3MDgsImV4cCI6MjA0NTk2NDcwOH0.MBwSEKlpkhze15rfMXH80iwCJehOU3VwP2hJDOOI5L4';
      
    $url = "$SUPABASE_URL/rest/v1/users";

    $data =[
        'email' => $email,
        'passwd' => $password,
    ];

    $options = [
        'http' => [
            'header'  => [
                "Content-Type: application/json",
                "Authorization: Bearer $SUPABASE_KEY",
                "apikey: $SUPABASE_KEY"
            ],
            'method'  => 'POST',
            'content' => json_encode($data),
        ],
    ];
    
      
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    //$response_data = json_decode($response, true);

    if($response === false) {   
        echo "Error: unable to save to Supabase";
        exit;
    } echo "user has been created." . json_encode($response_data);


}

require('../../config/db_conection.php');

// Obtener datos del formulario de registro
$email = $_POST['email'];
$password = $_POST['passwd'];
$enc_pass = md5($password);

// Verificar si la conexión está abierta y conectarse si no lo está
$query = "SELECT * FROM users WHERE email = '$email'";
$result = pg_query($conn, $query);
$row=pg_fetch_assoc($result);

if ($row) {
    echo "<script>alert('Email already exists!')</script>";
    header('refresh:0; url=http://127.0.0.1/beta/api/src/register_form.html');
    exit();
} 

$query = "INSERT INTO users (email, password) VALUES ('$email', '$enc_pass')";

$result = pg_query($conn, $query);

if ($result) {

    save_data_supabase($email, $enc_pass);  // Save to Supabase
    echo "<script>alert('Registration successful')</script>";
    header('refresh:0; url=http://127.0.0.1/beta/api/src/login_form.html');
    exit();
} else {
    echo "Failed to register user: ";
} 

pg_close($conn);

// Cerrar la conexión si está abierta
/*
echo "Email: " . $email;
echo "<br>Password: " . $pass;
echo "<br>Encrypted Password: " . $enc_pass;
*/

?>

