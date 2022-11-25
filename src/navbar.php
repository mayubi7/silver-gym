<!--Code taken and modified from https://www.w3schools.com/howto/howto_js_sidenav.asp-->

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        body {
            font-family: "Lato", sans-serif;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #535353;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;

        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #ffffff;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #faee19;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .sidenav gymTitle {
            font-family: "Impact", sans-serif;
            color: black;
            padding-left: 32px;
            font-size: 32px;
            padding-right: 32px;
        }

        .sidenav img {
            background: transparent;
            padding-left: 32px;
            padding-right: 32px;
	    padding-bottom: 10px;
	    padding-top: 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
    </style>
</head>
<body>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <gymTitle>SILVER'S GYM</gymTitle>
    <img src="https://creazilla-store.fra1.digitaloceanspaces.com/cliparts/59828/dumbbell-weights-clipart-xl.png" alt="Gym logo" width="200" height="100">
    <a href="https://www.students.cs.ubc.ca/~amluna/insert.php">Add Gym Member</a>
    <a href="https://www.students.cs.ubc.ca/~amluna/delete.php">Fire Staff Member</a>
    <a href="https://www.students.cs.ubc.ca/~amluna/update.php">Update Membership</a>
    <a href="https://www.students.cs.ubc.ca/~amluna/select.php">Custom Select</a>
    <a href="https://www.students.cs.ubc.ca/~amluna/project.php">View Tables</a>
    <a href="https://www.students.cs.ubc.ca/~amluna/join.php">Class Info</a>
    <a href="https://www.students.cs.ubc.ca/~amluna/aggregationWithGroupBy.php">Class Enrollments</a>
    <a href="https://www.students.cs.ubc.ca/~amluna/aggregationWithHaving.php">Rental Equipment Types</a>
    <a href="https://www.students.cs.ubc.ca/~amluna/nestedAggregation.php">Lifting Records</a>
    <a href="https://www.students.cs.ubc.ca/~amluna/division.php">Fully-Equipped Branches</a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>

<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>

</body>
</html>
