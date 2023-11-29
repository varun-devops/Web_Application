<!DOCTYPE html>
<html>
<head>
    <title>Smart Parking Campus</title>
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
            margin-top: 40px;
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
        .role {
            width: 300px;
            margin: auto;
        }
        .role button {
            background-color: #007BFF;
            color: #fff;
            width: 100px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 10px 0;
        }
        .role button:hover {
            background-color: #0056b3;
        }
        .disabled{
            background-color: #007BFF;
            color: #fff;
            width: 260px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin: 10px 0;
            text-align: justify;    
        }
    </style>
</head>
<body>
<div class="top">
    <h1 class="header">Smart Park Campus</h1>
    <p class="app">Automated IoT-based Multi-level Parking System</p>
</div>

<div class="purpose">
    <img src="https://st3.depositphotos.com/4320021/36710/v/450/depositphotos_367103164-stock-illustration-template-blue-parking-logo-icon.jpg" alt="Parking">
    <div class="role">
        <h3>Please select your role:</h3>
        <button onclick="redirectToPage('faculty.php')">Faculty</button>
        <br>
        <button onclick="redirectToPage('student.php')">Student</button>
        <br>
        <button onclick="redirectToPage('visitor.php')">Visitor</button>
        <br>
        <div class="disabled">
        Slots 88, 89, and 90 on the Ground Floor for the use of individuals with disabilities.
        </div>
    </div>
</div>

<script>
    function redirectToPage(page) {
        window.location.href = page;
    }
</script>
</body>
</html>