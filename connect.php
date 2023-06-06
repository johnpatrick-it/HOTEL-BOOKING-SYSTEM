<?php
/*
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $number_of_guests = $_POST['number_of_guests'];
    $room_type = $_POST['room_type'];
}

// Create a connection
$conn = mysqli_connect($hostname, $username, $password, $database);

if ($conn) {
    // Code to execute if the condition is true
    echo "The condition is true. Executing some code...";
    $sql = "INSERT INTO Reservations (name, email, check_in_date, check_out_date, number_of_guests, room_type) VALUES ('$name', '$email', '$check_in_date', '$check_out_date', '$number_of_guests', '$room_type')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Data inserted successfully";
    } else {
        die(mysqli_error($conn));
    }
} else {
    die(mysqli_connect_error());
}

mysqli_close($conn);
*/
?>
