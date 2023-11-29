<!DOCTYPE html>
<html>
<head>
    <title>Four-Wheeler Faculty</title>

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
        <h1 style="margin-top:5px;" >Faculty Details:</h1>
        
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "smart_park_campus";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $emp_id = $_GET['emp_id'];
        $slot_no = null; 
        
        $sql = "SELECT * FROM faculty_table WHERE Emp_Id = '$emp_id' AND Vehicle_Type = 'Four-wheeler'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
            
        echo "Employee ID: " . $row['Emp_Id'] . "<br><br>";
        echo "Name: " . $row['Name'] . "<br><br>";
        echo "Vehicle Type: " . $row['Vehicle_Type'] . "<br><br>";
        echo "Vehicle No: " .$row['Vehicle_No'] . "<br><br>";
        echo "Select Duration: ";
        echo "<select id='durationDropdown'>";
        echo "<option value='1'>1-2 Hrs</option>";
        echo "<option value='3'>3-5 Hrs</option>";
        echo "<option value='6'>6 or more Hrs</option>";
        echo "</select>";
        echo "<br><br>";
        
        echo "<button class='book_now' onclick='bookSlot($emp_id)'>Book Now</button>";
        ?>
        
    </div>
</div>

<script>
    function redirectToPage(page) {
        window.location.href = page;
    }

    function bookSlot(empId) {
        const selectedDuration = document.getElementById('durationDropdown').value;
        
        window.location.href = `booking_page1.php?duration=${selectedDuration}&emp_id=${empId}`;
    }
</script>
</body>
</html>
