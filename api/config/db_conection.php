<?php
/*database conection
developer: bryan
*/

$hots = "localhost"; 
$username = "postgres";
$password = "unicesmag";
$dbname = "beta";
$port = "5432";

$data_conection ="

host=$hots   
port=$port 
dbname=$dbname
user=$username
password=$password
";

$conn = pg_connect($data_conection);


if (!$conn) {
    die("Connection failed: ". pg_last_error());
}else{
    echo "Connected successfully";
}




pg_close($conn);
?>