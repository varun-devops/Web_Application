<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smart_park_campus";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['emp_id'])) {
        $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
        
        $sql = "SELECT * FROM faculty_table WHERE Emp_Id = '$emp_id'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $vehicle_type = $row['Vehicle_Type'];
            
            if ($vehicle_type === "Two-wheeler") {
                header('Location: twofac.php?emp_id=' . $emp_id);
            } elseif ($vehicle_type === "Four-wheeler") {
                header('Location: fourfac.php?emp_id=' . $emp_id);
            } else {
                echo "Invalid vehicle type.";
            }
        } else {
            header('Location: faculty.php');
        }
    } else {
        header('Location: faculty.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Faculty Login</title>
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
        .back_to_home{
            margin: auto;
            width: 150px;
        }

        .back_to_home button,.purpose button, .submit {
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

        .back_to_home button {
            margin-top: 10px;
            margin-left: 10px;
        }

        .back_to_home button:hover , .purpose button:hover, .submit:hover {
            background-color: #0056b3;
        }

        .login{
            border: 2px solid black;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 10px;
            border-radius: 10px;
            width: 300px;
            margin: auto;
        }

        .submit{
            margin-top: 5px;
        }
        .login p{
            margin-bottom: 5px;
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
    <h2>Faculty Login</h2>    
    
    <div class="login">
    <p><b>Enter Employee ID:</b></p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="text" name="emp_id" required>
        <br>
        <input class="submit" type="submit" value="Login">
    </form>
    </div>    
    <br>
    <br>    

    <button onclick="redirectToRegistration('Faculty')">Register</button>

</div>

<script>
    function redirectToPage(page) {
        window.location.href = page;
    }

    function redirectToRegistration(userType) {
        window.location.href = 'register.php?user=' + userType;
    }
</script>

</body>
</html>
