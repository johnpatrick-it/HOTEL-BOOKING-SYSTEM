<?php

require_once 'db.php';

// Check kung yung inputs ay na set na
if (isset($_POST['name'], $_POST['email'], $_POST['check-in'], $_POST['check-out'], $_POST['guests'], $_POST['room-type'])) {
    // Retrieve form inputs
    $name = $_POST['name'];
    $email = $_POST['email'];
    $checkInDate = $_POST['check-in'];
    $checkOutDate = $_POST['check-out'];
    $guests = $_POST['guests'];
    $roomType = $_POST['room-type'];

    // SQL statement para ilagay sa guests table
    $sql = "INSERT INTO guests (guest_id, name, email, check_in_date, check_out_date, room_type) VALUES (NULL, '$name', '$email', '$checkInDate', '$checkOutDate', '$roomType')";


    //SQL statement
    if ($conn->query($sql) === TRUE) {
      $last_id = mysqli_insert_id($conn);
      header("Location: payment.php?guest_id=$last_id");
      exit();
  } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
}

$conn->close();

?>



<!DOCTYPE html>
<html>
<head>
  <title>Hotel Booking Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      background-image: url("room.jpg");
      background-size: cover;
      background-repeat: no-repeat;
    }

    h1 {
      text-align: center;
      margin-top: 20px;
      color: white;
    }

    form {
      max-width: 500px;
      margin: 0 auto;
      padding: 50px;
      background-color: rgba(0, 0, 0, 0.3); 
      border-radius: 5px;
      color: white;
      position: relative;
    }
      .back-button {
      background-color: #777;
      float: right;
    }
    

    label {
      display: block;
      font-weight: bold;
      margin-top: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="number"],
    select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
    .back-button {
      background-color: #777;
      float: right;
    }
    input[type="button"],
    .back-button  {
      background-color: red;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      float: right;
    }
  </style>
</head>
<body>
  <h1>Hotel Booking Form</h1>

<form method="post">

    <input type="number" id="guests" name="guests" required readonly style="display: none;">

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="check-in">Check-in Date:</label>
    <input type="date" id="check-in" name="check-in" required>
    
    <label for="check-out">Check-out Date:</label>
    <input type="date" id="check-out" name="check-out" required>

    <label for="room-type">Room Type:</label>
    <select id="room-type" name="room-type" required>
      <option value="">Select Room Type</option>
      <option value="single">Single</option>
      <option value="double">Double</option>
      <option value="suite">Suite</option>
    </select>
    
    <input type="submit" name="submit" value="Submit">
    <input type="button" class="back-button" value="Back" onclick="history.back()">
</form>

  </form>
</body>
<script>
//date validation para hindi ma click yung check out date na mas maaga sa check in date
document.addEventListener("DOMContentLoaded", function() {
  const checkIn = document.getElementById("check-in");
  const checkOut = document.getElementById("check-out");

  const today = new Date().toISOString().split("T")[0];
  checkIn.setAttribute("min", today);
  checkOut.setAttribute("min", today);

  checkIn.addEventListener("change", function() {
    const checkInDate = new Date(checkIn.value);
    const minCheckOutDate = new Date(checkInDate.setDate(checkInDate.getDate() + 1)).toISOString().split("T")[0];
    checkOut.setAttribute("min", minCheckOutDate);
  });
});
</script>
</html>
