<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>

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
    <h2>Registration Form</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    
        <?php
        if (isset($_GET['user'])) {
            if ($_GET['user'] === 'Faculty') {
                echo 'Employee ID: <input type="number" name="Emp_Id" required>';
                $user_type = 'Faculty';
            } elseif ($_GET['user'] === 'Student') {
                echo 'Student ID: <input type="number" name="Std_id" required>';
                $user_type = 'Student';
            }
        }
        ?>
        <br><br>
        Name: <input type="text" name="Name" required>
        <br>
        <br>
        Vehicle No.: <input type="text" name="Vehicle_No" required>
        <br>
        <br>
        Vehicle Type: 
        <input type="radio" name="Vehicle_Type" value="Two-wheeler" required> Two-wheeler
        <input type="radio" name="Vehicle_Type" value="Four-wheeler" required> Four-wheeler
        <br>
        <br>
        Vehicle Model: <input type="text" name="Vehicle_Model" required>
        <br>
        <br>
        Phone No.: <input type="text" name="Phone_No" required>
        <br>
        <br>
        Gmail: <input type="text" name="Gmail" required>
        <br>
        <br>
        <input class="book_now" type="submit" name="submit" value="Register">
        
    </form>
</div>

<script>
    function redirectToPage(page) {
        window.location.href = page;
    }
</script>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smart_park_campus";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $vehicle_no = mysqli_real_escape_string($conn, $_POST['Vehicle_No']);
    $vehicle_model = mysqli_real_escape_string($conn, $_POST['Vehicle_Model']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['Phone_No']);
    $gmail = mysqli_real_escape_string($conn, $_POST['Gmail']);
    $vehicle_type = mysqli_real_escape_string($conn, $_POST['Vehicle_Type']);
    $emp_id = '';
    $std_id = '';
    $user_type = '';
    if (isset($_POST['Emp_Id'])) {
        $emp_id = mysqli_real_escape_string($conn, $_POST['Emp_Id']);
        $user_type = 'Faculty';
    }

    if (isset($_POST['Std_id'])) {
        $std_id = mysqli_real_escape_string($conn, $_POST['Std_id']);
        $user_type = 'Student';
    }

    if ($user_type === 'Faculty') {
        $sql = "INSERT INTO faculty_table (Emp_Id, Name, Vehicle_No, Vehicle_Type, Vehicle_Model, Phone_No, Gmail) 
                VALUES ('$emp_id', '$name', '$vehicle_no', '$vehicle_type', '$vehicle_model', '$phone_no', '$gmail')";
    } elseif ($user_type === 'Student') {
        $sql = "INSERT INTO student_table (Std_id, Name, Vehicle_No, Vehicle_Type, Vehicle_Model, Phone_No, Gmail) 
                VALUES ('$std_id', '$name', '$vehicle_no', '$vehicle_type', '$vehicle_model', '$phone_no', '$gmail')";
    }

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("You have been registered");</script>';
        echo '<script>window.location.href = "home.php";</script>'; // Redirect to home.php
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    

    mysqli_close($conn);
}
?>
