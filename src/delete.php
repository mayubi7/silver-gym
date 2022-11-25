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
    <h2>Fire staff</h2>
    <form method="POST" action="delete.php">
        <input type="hidden" id="delQueryReq" name="delQueryReq">
        ID: <input type="number" name="id"> <br /><br />
        <input type="submit" value="delete" name="delete"></p>
    </form>

    <hr />
    <?php
    require "util.php";
    //this tells the system that it's no longer just parsing html; it's now parsing PHP

    $success = True; //keep track of errors so it redirects the page only if there are no errors
    $db_conn = NULL; // edit the login credentials in connectToDB()
    $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())


    function handleDelReq()
    {
        global $db_conn;

        //Getting the values from user and insert data into the table
        $id = $_POST['id'];

        $result = executePlainSQL("delete from staffruns where idnumber=$id");

        if (oci_num_rows($result) == 1) {
            echo "<p>Success!</p>";
        } else {
            echo "<p>Was unable to remove staff with id $id. Make sure it's correct!</p>";
        }
        OCICommit($db_conn);
    }

    // HANDLE ALL POST ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handlePOSTRequest()
    {
        if (connectToDB()) {
            if (array_key_exists('delQueryReq', $_POST)) {
                handleDelReq();
            }

            disconnectFromDB();
        }
    }

    if (isset($_POST['delete'])) {
        handlePOSTRequest();
    }


    ?>
</body>

</html>
