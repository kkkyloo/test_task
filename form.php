<?php

$conn = new mysqli("localhost", "root", "");


$sql = 'SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME="testdb"';

$query = $conn->query($sql);

$row = $query->fetch_object();
$dbExists = (bool) $row->exists;

if (!$dbExists) {
    $sql = "CREATE DATABASE IF NOT EXISTS testdb";

    mysqli_query($conn, $sql);
}

mysqli_close($conn);

$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Ошибка: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS testTable (id INTEGER AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30), email VARCHAR(30), phone VARCHAR(20), created datetime);";
mysqli_query($conn, $sql);

$match = 0;

$nameForm = trim($_POST["username"]);
$emailForm = trim($_POST["email"]);
$telForm = trim($_POST["tel"]);

$name = $conn->real_escape_string($nameForm);
$email = $conn->real_escape_string($emailForm);
$tel = $conn->real_escape_string($telForm);

$query = "select * from testTable";
$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_array($result)) {
        if ($row["name"] == $name && $row["email"] == $email && $row["phone"] == $tel) {

            $match = 1;


            $created = $row["created"];

            $timestampCreated = strtotime($created);
            $timestampNow = time();

            $diffInSeconds = $timestampNow - $timestampCreated;
            $diffInMinutes = round($diffInSeconds / 60);

            if ($diffInMinutes < 5) {
                $return = false;
            } else {
                $return = true;
                $match = 0;
            }
        }
    }
}

if ($match == 0) {

    $return = true;
    mysqli_query($conn, "INSERT INTO testTable (name, email, phone, created) VALUES ('$name', '$email', '$tel', NOW())");

    echo $return;

}

mysqli_close($conn);

?>