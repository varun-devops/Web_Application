<!DOCTYPE html>
<html>
<head>
    <title>Two-Wheeler Student</title>

    <style>
        body {
            background-color: rgb(255, 201, 151);
        }
        .top {
            border: 2px solid black;
            background-color: rgb(255, 149, 49);
            text-align: center;
            padding: 2px;
        }
        .header {
            margin: 0;
            font-size: 50px;
        }
        .app {
            font-size: 15px;
            padding: 0px;
            border-top: 2px solid red;
            border-bottom: 2px solid red;
            margin: 0px;
        }
        
        .back_to_home button {
            background-color: #007BFF;
            color: #fff;
            width: 150px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: auto;
        }


        .back_to_home{
            margin: auto;
            width: 150px;
        }

        .purpose {
            border: 2px solid black;
            width: 400px;
            margin: auto;
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            padding: 10px;
        }

        .purpose img {
            width: 200px;
            height: 200px;
            margin: auto;
        }
        
        .purpose h2 {
            margin: auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .back_to_home button {
            margin-top: 10px;
            margin-left: 10px;
        }

        .back_to_home button:hover {
            background-color: #0056b3;
        }

        .details{
            border: 2px solid black;
            border-radius: 10px;
            margin: auto;
            width: 300px;
            padding: 10px;
        }

        .book_now {
            background-color: #007BFF;
            color: #fff;
            width: 150px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: auto;
            text-align: center;
        }

        .book_now:hover {
            background-color: #0056b3;
        }
    </style>

</head>
<body>
<div class="top">
    <h1 class="header">Smart Park Campus</h1>
    <p class="app">Automated IoT-based Multi-level Parking System</p>
</div>
    
<div class="back_to_home">
    <button onclick="redirectToPage('home.php')">Go to Home Page</button>
</div>
    
<div class="purpose">
    <img src="https://st3.depositphotos.com/4320021/36710/v/450/depositphotos_367103164-stock-illustration-template-blue-parking-logo-icon.jpg" alt="Parking">
    
    <div class="details">

<?php
session_start();

if (isset($_GET['slot_no']) && isset($_GET['floor']) && isset($_GET['std_id'])) {
    $slot_no = $_GET['slot_no'];
    $floor = $_GET['floor'];
    $std_id = $_GET['std_id'];
    
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smart_park_campus";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    
    $selectUserSql = "SELECT * FROM student_table WHERE Std_id = '$std_id' AND Vehicle_Type = 'Two-wheeler'";
    $result = mysqli_query($conn, $selectUserSql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        $user_type = 'Student';
        $user_id = $row['Std_id'];
        $vehicle_no = $row['Vehicle_No'];
        $vehicle_type = 'Two-wheeler';
        $name = $row['Name'];
        
        $insertBookingSql = "INSERT INTO booking_table (User_Type, Vehicle_No, Vehicle_Type, Name, User_Id, Slot_No, Floor, Status) VALUES ('$user_type', '$vehicle_no', '$vehicle_type', '$name', '$user_id', $slot_no, $floor, 'Pending')";
        
        if (mysqli_query($conn, $insertBookingSql)) {
            $updateSlotSql = "UPDATE slot_information SET Status = 'Occupied' WHERE Slot_No = $slot_no AND Floor = $floor";
            
            if (mysqli_query($conn, $updateSlotSql)) {
                echo "Booking successful! Your slot is $slot_no on floor $floor.";
            } else {
                echo "Error updating slot information: " . mysqli_error($conn);
            }
        } else {
            echo "Error inserting booking details: " . mysqli_error($conn);
        }
    } else {
        echo "User not found or not a Two-Wheeler Student.";
    }
    
    mysqli_close($conn);
} else {
    echo "Invalid parameters.";
}
?>
</div>
</div>

<script>
    function redirectToPage(page) {
        window.location.href = page;
    }
</script>
</body>
</html>
