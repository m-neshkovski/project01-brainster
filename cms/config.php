<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'project01');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$db_name=DB_NAME;
$servername=DB_SERVER;
$username=DB_USERNAME;
$password=DB_PASSWORD;

$db_type = 'mysql';
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // po default e PDO::FETCH_BOTH
];

try { // dsn Data Source name
    $pdo = new PDO("$db_type:host=$servername;dbname=$db_name", $username, $password, $options); // proba dali bazata e konektirana
} catch (PDOException $e) {
    echo $e->getMessage();
    die;
}
?>