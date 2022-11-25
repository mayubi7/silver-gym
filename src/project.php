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
    <?php
    require "util.php";
    function getAllTables()
    {
        if (connectToDB()) {
            $result = executePlainSQL("select distinct table_name from user_tab_cols");
            while (($row = oci_fetch_row($result)) != false) {

                foreach ($row as $val) {
                    echo "<option value=$val>$val</option>";
                }
            }
        }
    }

    ?>
    <?php include "navbar.php";?>
    <h2>Custome select</h2>
    <p>Choose the table to view data from</p>

    <form method="GET" action="project.php">
        <!--refresh page when submitted-->
        <select name="table" id="table">
            <?php
            getAllTables();
            ?>
        </select>
        <input type="hidden" id="selectTable" name="selectTableReq">
        <input type="submit" name="selectTable"></p>
    </form>

    <?php
    //this tells the system that it's no longer just parsing html; it's now parsing PHP

    $success = True; //keep track of errors so it redirects the page only if there are no errors
    $db_conn = NULL; // edit the login credentials in connectToDB()
    $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())

    // HANDLE ALL GET ROUTES
    // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
    function handleGETRequest()
    {
        if (connectToDB()) {
            if (array_key_exists('selectTable', $_GET)) {
                handleSelectTable();
            } elseif (array_key_exists('project', $_GET)) {
                handleProject();
            }
            disconnectFromDB();
        }
    }
    // select column_name from user_tab_cols where table_name='MEMBER';

    function handleDisplayAllMembersReq()
    {

        $result = executePlainSQL("(SELECT m.name, m.phonenumber, m.emergencycontact, m.membershiptier, m.personaltrainerid, s.name, m.enddate from member m, staffruns s where m.personaltrainerid=s.idnumber) 
                                    UNION 
                                    (SELECT name, phonenumber, emergencycontact, membershiptier, personaltrainerid, null as dummy, enddate from member where personaltrainerid is null)");
        echo "<table>";
        echo "<tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Emergency Contact</th>
                <th>Membership Tier</th>
                <th>Personal Trainer ID</th>
                <th>Personal Trainer Name</th>
                <th>End Date</th>
            </tr>";
        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            foreach ($row as $val) {
                echo "<td> $val </td>";
            }
            echo "</tr>";
        }
    }

    function handleSelectTable()
    {
        $table = strtoupper($_GET['table']);
        echo '<p>Select columns from that table and condition</p>';

        createSqlBuilder($table);




        echo '<input type="hidden" id="project" name="project">
        <input type="submit" name="project"></p>';

        echo '</form>';
    }

    function createSqlBuilder($table)
    {
        echo '<form method="GET" action="project.php">';
        echo '<input type="hidden" id="table" name="table" value="' . $table . '">';
        
        $result = executePlainSQL("select column_name from user_tab_cols where table_name='$table'");
        echo '<label for="fields[]">Choose fields:</label> <br>
                <select name="fields[]" id="fields[]" multiple>';
        while (($row = oci_fetch_row($result)) != false) {
            foreach ($row as $val) {
                echo "<option value=$val>$val</option>";
            }
        }
        echo '</select>';
    }

    function handleProject()
    {
        // print_r($_GET);

        $count = $_GET['count'];
        $table = $_GET['table'];
        $where_str = "WHERE ";
        $fields = $_GET['fields'];
        $select_str = "SELECT ";
        for ($i = 0; $i < count($fields); $i++)
            {
                if ($i != 0) {
                    $select_str .= ', ';
                }
                $select_str .= $fields[$i];
            }
        $from_str = "FROM " . $table;

        $result = executePlainSQL($select_str . ' ' . $from_str);
        echo "<table>";
        echo "<tr>";
        for ($i = 0; $i < count($fields); $i++)
        {
            echo "<th>" . $fields[$i] . "</th>";
        }
        
        while (($row = oci_fetch_row($result)) != false) {
            echo "<tr>";
            foreach ($row as $val) {
                echo "<td> $val </td>";
            }
            echo "</tr>";
        }

        
    }



    if (isset($_GET['selectTable']) || isset($_GET['project'])) {
        handleGETRequest();
    }


    ?>


</body>

</html>