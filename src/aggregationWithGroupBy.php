<!--Test Oracle file for UBC CPSC304 2018 Winter Term 1
  Created by Jiemin Zhang
  Modified by Simona Radu
  Modified by Jessica Wong (2018-06-22)
  This file shows the very basics of how to execute PHP commands
  on Oracle.
  Specifically, it will drop a table, create a table, insert values
  update values, and then query for values

  IF YOU HAVE A TABLE CALLED "demoTable" IT WILL BE DESTROYED

  The script assumes you already have a server set up
  All OCI commands are commands to the Oracle libraries
  To get the file to work, you must place it somewhere where your
  Apache server can run it, and you must rename it to have a ".php"
  extension.  You must also change the username and password on the
  OCILogon below to be your ORACLE username and password -->

  <html>

<head>
    <title>Main Project Page</title>
</head>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<body>
<?php include "navbar.php";?>
    <h2>Display members enrolled by class ID</h2>
    <p>Press the button to see details</p>

    <form method="GET" action="aggregationWithGroupBy.php">
        <!--refresh page when submitted-->
        <input type="hidden" id="displayMembersCountRequest" name="displayMembersCountRequest">
        <input type="submit" name="displayMembersCount"></p>
    </form>

    <?php
    require "util.php";
    //this tells the system that it's no longer just parsing html; it's now parsing PHP

    $success = True; //keep track of errors so it redirects the page only if there are no errors
    $db_conn = NULL; // edit the login credentials in connectToDB()
    $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

    // HANDLE ALL GET ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handleGETRequest()
    {
        if (connectToDB()) {
            if (array_key_exists('displayMembersCount', $_GET)) {
                handleDisplayBranchesReq();
            }

            disconnectFromDB();
        }
    }

    function handleDisplayBranchesReq()
    {

        $result = executePlainSQL("SELECT ClassID, Count(*)
        FROM Enrolled e
        GROUP BY ClassID");
        echo "<table>";
        echo "<tr>
                <th>Class ID</th>
                <th>Number of Members Enrolled</th>
            </tr>";
        
        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            foreach ($row as $val) {
                echo "<td> $val </td>";
            }
            echo "</tr>";
        }
    }

    if (isset($_GET['displayMembersCount'])) {
        handleGETRequest();
    }


    ?>
</body>

</html>