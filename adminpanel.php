<?php

require_once 'dbconn.php';

// search initiallize 
$searchValue = '';
$searchBy = '';

// Check kung submitted yung form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchValue = $_POST['searchValue'];
    $searchBy = $_POST['searchBy'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .update-payment-btn {
            background-color: green;
            color: white;
            text-decoration: none;
            padding: 8px;
            border-radius: 4px;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-bar input[type="text"] {
            padding: 6px;
            width: 200px;
        }

        .search-bar select {
            padding: 6px;
        }

        .search-bar button {
            padding: 6px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .update-form {
            display: none;
            margin-top: 10px;
        }

        .update-form label {
            display: block;
            margin-bottom: 5px;
        }

        .update-form select {
            margin-bottom: 10px;
            padding: 6px;
        }

        .update-form button {
            background-color: green;
            color: white;
            padding: 6px 10px;
            border: none;
            cursor: pointer;
            margin-right: 5px;
        }

        .update-form .close-btn {
            background-color: red;
            color: white;
            padding: 6px 10px;
            border: none;
            cursor: pointer;
        }

        .logout-btn {
            float: right;
            background-color: red;
            color: white;
            padding: 6px 10px;
            border: none;
            cursor: pointer;
            float: right;
            margin-top: -40px;
            margin-right: 20px;
        }

        h1 a {
        text-decoration: none;
        color: black;
        }

        h1 a:hover {
            color: blue;
        }
            
    </style>
<script>
    window.onload = function() {
        var alertShown = localStorage.getItem("adminAlertShown");
        if (!alertShown) {
            window.alert("Welcome Admin!");
            localStorage.setItem("adminAlertShown", true);
        }

        // para sa update form 
        var updatePaymentBtns = document.getElementsByClassName("update-payment-btn");
        for (var i = 0; i < updatePaymentBtns.length; i++) {
            updatePaymentBtns[i].addEventListener("click", function(e) {
                e.preventDefault();
                var updateForm = this.parentNode.parentNode.getElementsByClassName("update-form")[0];
                updateForm.style.display = "block";
            });
        }
    };
</script>

</head>
<body>
<h1><a href="adminpanel.php">ADMIN PANEL</a></h1>


    <a href="logout.php" class="logout-btn">Logout</a>

    <!-- Search bar -->
    <div class="search-bar">
        <form method="post" action="">
            <input type="text" name="searchValue" placeholder="Search..." value="<?php echo $searchValue; ?>">
            <select name="searchBy">
                <option value="guest_id" <?php if ($searchBy === 'guest_id') echo 'selected'; ?>>Guest ID</option>
                <option value="name" <?php if ($searchBy === 'name') echo 'selected'; ?>>Name</option>
                <option value="payment_status" <?php if ($searchBy === 'payment_status') echo 'selected'; ?>>Payment Status</option>
            </select>
            <button type="submit">Search</button>
        </form>
    </div>

    <?php
    // para search query
    $searchQuery = "";
    if ($searchValue !== '' && $searchBy !== '') {
        $searchQuery = "WHERE {$searchBy} LIKE '%{$searchValue}%'";
    }

    // Fetching guest data sa database pag tapos ng search query
    $sql = "SELECT * FROM guests {$searchQuery}";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Displaying ng guest
        echo "<table>
            <tr>
                <th>Guest ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Check-in Date</th>
                <th>Check-out Date</th>
                <th>Room Type</th>
                <th>Cost</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['guest_id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['check_in_date']}</td>
                <td>{$row['check_out_date']}</td>
                <td>{$row['room_type']}</td>
                <td>₱{$row['cost']}</td>
                <td>{$row['payment_method']}</td>
                <td>{$row['payment_status']}</td>
                <td>
                    <a href='updatepayment.php?guest_id={$row['guest_id']}' class='update-payment-btn'>Update</a>
                    <div class='update-form'>
                        <form action='updatepayment.php' method='post'>
                            <label for='payment-status'>Payment Status:</label>
                            <select name='payment_status'>  
                                <option value='pending'>Pending</option>
                                <option value='paid'>Paid</option>
                                <option value='cancelled'>Cancelled</option>
                                <option value='reschedule'>Reschedule</option>
                            </select>
                            <input type='hidden' name='guest_id' value='{$row['guest_id']}'>
                            <button type='submit'>Save</button>
                            <button type='button' class='close-btn'>X</button>
                        </form>
                    </div>
                </td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "No guests found.";
    }
    ?>

    <script>
        // x button katabi nung save
        var closeBtns = document.getElementsByClassName("close-btn");
        for (var i = 0; i < closeBtns.length; i++) {
            closeBtns[i].addEventListener("click", function(e) {
                e.preventDefault();
                var updateForm = this.parentNode.parentNode;
                updateForm.style.display = "none";
            });
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
