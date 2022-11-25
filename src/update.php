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

</style>

<body>
    <h2>Update Membership End Date and/or Tier</h2>
    <p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

    <form method="POST" action="update.php">
        <!--refresh page when submitted-->
        <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
        Name: <input type="text" name="name"> <br /><br />
        Phone Number: <input type="text" name="phoneNumber"> <br /><br />
        Membership Tier: <input type="text" name="membershipTier"> <br /><br />
        End Date: <input type="date" name="endDate"> <br /><br />
        <input type="submit" value="update" name="update"></p>
    </form>

    <?php
    require "util.php";
    //this tells the system that it's no longer just parsing html; it's now parsing PHP

    $success = True; //keep track of errors so it redirects the page only if there are no errors
    $db_conn = NULL; // edit the login credentials in connectToDB()
    $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

    function handleUpdateRequest()
    {
        global $db_conn;

        $name = $_POST['name'];
        $phoneNumber = $_POST['phoneNumber'];
        $membershipTier = $_POST['membershipTier'];
        $endDate = date("d-M-y", strtotime($_POST['endDate']));

        if (empty($membershipTier)) {
            executePlainSQL("UPDATE member SET enddate='" . $endDate . "' WHERE name='" . $name . "' and phonenumber='" . $phoneNumber . "'");
        } else {
            executePlainSQL("UPDATE member SET enddate='" . $endDate . "', membershipTier='". $membershipTier . "' WHERE name='" . $name . "' and phonenumber='" . $phoneNumber . "'");
        }

        // you need the wrap the old name and new name values with single quotations

        OCICommit($db_conn);
    }

    // HANDLE ALL POST ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handlePOSTRequest()
    {
        if (connectToDB()) {
            if (array_key_exists('updateQueryRequest', $_POST)) {
                handleUpdateRequest();
            }

            disconnectFromDB();
        }
    }

    if (isset($_POST['update'])) {
        handlePOSTRequest();
    }


    ?>
</body>

</html>