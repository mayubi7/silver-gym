<!--Based on Test Oracle file for UBC CPSC304 2018 Winter Term 1
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
    <h2>View available classes</h2>
    <p>Press the button to see information on all classes in any facility</p>

    <form method="GET" action="view_classes_with_instructors.php">
        <!--refresh page when submitted-->
        <input type="hidden" id="displayClassesReq" name="displayClassesReq">
<label for="facility-names">Located in Facility:</label>
<select name="facility-names" id="facility-names">
    <option value=POOL>Pool</option>
  <option value='YOGSTD'>Yoga Studio</option>
  <option value='BOXRNG'>Boxing Ring</option>
  <option value='GYM'>Gym</option>
</select>
        <input type="submit" name="displayClasses"></p>
    </form>
    <?php
    require "util.php";
    //this tells the system that it's no longer just parsing html; it's now parsing PHP

    $success = True; //keep track of errors so it redirects the page only if there are no errors
    $db_conn = NULL; // edit the login credentials in connectToDB()
    $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())


    function handleDisplayClassesReq()
    {
	$facility = $_GET["facility-names"];
        $result = executePlainSQL("SELECT  s.Name, s.IDNumber, c.ID, c.Title, c.FacilityID FROM Class c, ClassInstructor i, Teach t, StaffRuns s WHERE t.ClassID = c.ID AND t.ClassInstructorID = i.IDNumber AND i.IDNumber = s.IDNumber AND c.FacilityID ='$facility'");
        echo "<table>";
        echo "<tr>
                <th>Instructor Name</th>
                <th>Instructor ID</th>
		<th>Class ID</th>
		<th>Class Title</th>
		<th>Facility</th>
            </tr>";
        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            foreach ($row as $val) {
                echo "<td> $val </td>";
            }
            echo "</tr>";
        }
    }

    // HANDLE ALL GET ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handleGETRequest()
    {
        if (connectToDB()) {
            if (array_key_exists('displayClasses', $_GET)) {
                handleDisplayClassesReq();
            }

            disconnectFromDB();
        }
    }

    if (isset($_GET['displayClasses'])) {
        handleGETRequest();
    }
    ?>
</body>

</html>
