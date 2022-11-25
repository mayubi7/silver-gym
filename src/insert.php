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
    <?php include "navbar.php";?>
    <h2>Add new member</h2>
    <form method="POST" action="insert.php">
        <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
        Name: <input type="text" name="name"> <br /><br />
        Phone Number: <input type="text" name="phonenumber"> <br /><br />
        Emergency Contact: <input type="text" name="EMERGENCYCONTACT"> <br /><br />
        Membership Tier: <input type="text" name="MEMBERSHIPTIER"> <br /><br />
        Personal Trainer ID: <input type="number" name="PERSONALTRAINERID"> <br /><br />
        End Date: <input type="date" name="ENDDATE"> <br /><br />

        <input type="submit" value="insert" name="insertSubmit"></p>
    </form>

    <hr />
    <?php
    require "util.php";
    //this tells the system that it's no longer just parsing html; it's now parsing PHP

    $success = True; //keep track of errors so it redirects the page only if there are no errors
    $db_conn = NULL; // edit the login credentials in connectToDB()
    $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())


    function handleInsertRequest()
    {
        global $db_conn;

        //Getting the values from user and insert data into the table
        $tuple = array(
            ":bind1" => $_POST['name'],
            ":bind2" => $_POST['phonenumber'],
            ":bind3" => $_POST['EMERGENCYCONTACT'],
            ":bind4" => $_POST['MEMBERSHIPTIER'],
            ":bind5" => (int) $_POST['PERSONALTRAINERID'],
            ":bind6" => date("d-M-y", strtotime($_POST['ENDDATE'])),
        );

        $alltuples = array(
            $tuple
        );

        executeBoundSQL("insert into member values (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
        OCICommit($db_conn);
    }

    // HANDLE ALL POST ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handlePOSTRequest()
    {
        if (connectToDB()) {
            if (array_key_exists('insertQueryRequest', $_POST)) {
                handleInsertRequest();
            }

            disconnectFromDB();
        }
    }
    // HANDLE ALL GET ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handleGETRequest()
    {
        if (connectToDB()) {
            if (array_key_exists('countTuples', $_GET)) {
                handleCountRequest();
            }

            disconnectFromDB();
        }
    }

    if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit'])) {
        handlePOSTRequest();
    } else if (isset($_GET['countTupleRequest'])) {
        handleGETRequest();
    }


    ?>
</body>

</html>
