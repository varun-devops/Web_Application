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
        
        .back_to_home{
            margin: auto;
            width: 150px;
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
        <h1 style="margin-top:5px;">Student Details:</h1>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "smart_park_campus";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $std_id = $_GET['std_id'];
        $slot_no = null;
        $floor = 0;

        $sql = "SELECT * FROM student_table WHERE Std_id = '$std_id' AND Vehicle_Type = 'Two-wheeler'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            echo "Student ID: " . $row['Std_id'] . "<br><br>";
            echo "Name: " . $row['Name'] . "<br><br>";
            echo "Vehicle Type: " . $row['Vehicle_Type'] . "<br><br>";
            echo "Vehicle No: " .$row['Vehicle_No'] . "<br>";

            $slotSql = "SELECT Slot_No FROM slot_information WHERE Floor = $floor AND Status = 'Vacant' AND Vehicle_Type = 'Two-wheeler' LIMIT 1";
            $slotResult = mysqli_query($conn, $slotSql);

            if (mysqli_num_rows($slotResult) > 0) {
                $slotRow = mysqli_fetch_assoc($slotResult);
                $slot_no = $slotRow['Slot_No'];
            }
        } else {
            echo "User not found or not a Two-Wheeler Student.";
        }

        echo "<br>";

        if ($slot_no === null) {
            echo "No available slots for two-wheelers on floor 0.";
        } else {
            
            echo "<button class='book_now' onclick='bookSlot($slot_no, $floor, $std_id)'>Book Now</button>";
            }
        ?>
    </div>
</div>

<script>
    function redirectToPage(page) {
        window.location.href = page;
    }

    function bookSlot(slotNo, floor, stdId) {
        window.location.href = `booking_page2.php?slot_no=${slotNo}&floor=${floor}&std_id=${stdId}`;
    }
</script>
</body>
</html>