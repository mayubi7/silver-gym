<!--Based on Test Oracle file for UBC CPSC304 2018 Winter Term 1 which was
  Created by Jiemin Zhang
  Modified by Simona Radu
  Modified by Jessica Wong (2018-06-22) -->

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
    <h2>Gym Records</h2>
    <p>Press the button to see the max weights of each lift type recorded at our gym</p>

    <form method="GET" action="max_records_per_lifttype.php">
        <!--refresh page when submitted-->
        <input type="hidden" id="displayTopRecords" name="displayTopRecordsReq">
        <input type="submit" name="displayTopRecords"></p>
    </form>

    <?php
    require "util.php";

    $success = True; //keep track of errors so it redirects the page only if there are no errors
    $db_conn = NULL; // edit the login credentials in connectToDB()
    $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

    // HANDLE ALL GET ROUTES
    function handleGETRequest()
    {
        if (connectToDB()) {
            if (array_key_exists('displayTopRecords', $_GET)) {
                handleDisplayTopRecordsReq();
            }

            disconnectFromDB();
        }
    }

    function handleDisplayTopRecordsReq()
    {

        $result = executePlainSQL("SELECT pb.LiftType, Max(pb.Weight) FROM PersonalBest pb GROUP BY pb.LiftType");
        echo "<table>";
        echo "<tr>
                <th>Lift Type</th>
                <th>Max Weight Recorded</th>
            </tr>";
        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            foreach ($row as $val) {
                echo "<td> $val </td>";
            }
            echo "</tr>";
        }
    }

    if (isset($_GET['displayTopRecords'])) {
        handleGETRequest();
    }


    ?>
</body>

</html>
