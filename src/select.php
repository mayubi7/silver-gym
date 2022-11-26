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
    <h2>Custom select</h2>
    <p>Choose the table to view data from</p>

    <form method="GET" action="select.php">
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
            } elseif (array_key_exists('select', $_GET)) {
                handleSelect();
            } elseif (array_key_exists('addField', $_GET)) {
                handleSelectTable();
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
        if (isset($_GET['count'])) {
            $count = $_GET['count'];
        } else {
            $count = 1;
        }


        echo '<p>Select columns from that table and condition</p>';

        createSqlBuilder($count, $table);




        echo '<input type="hidden" id="select" name="select">
        <input type="submit" name="select"></p>';

        echo '</form>';

        echo '<form method="GET" action="select.php">
                <input type="hidden" name="count" value=" ' . (string) ($count + 1) . ' "> 
                <input type="hidden" id="table" name="table" value="' . $table . '">
                <input type="submit" name="addField" value="Add Field for SQL">
              </form>';
    }

    function createSqlBuilder($count, $table)
    {
        echo '<form method="GET" action="select.php">
                <input type="hidden" id="count" name="count" value="' . (string) $count . '">';
        
        $result = executePlainSQL("select column_name from user_tab_cols where table_name='$table'");
        echo '<label for="fields[]">Choose fields:</label> <br>
                <select name="fields[]" id="fields[]" multiple>';
        while (($row = oci_fetch_row($result)) != false) {
            foreach ($row as $val) {
                echo "<option value=$val>$val</option>";
            }
        }
        echo '</select>';
        echo '<br>';
        echo '<br>';
        echo '<p> Choose conditions (all will be AND)</p>';
        for ($i = 0; $i < $count; $i++) {
            $result = executePlainSQL("select column_name from user_tab_cols where table_name='$table'");
            echo 'Field ' . (string)($i + 1) . ' + Condition ' . (string)($i + 1) . '';
            echo '<br>';
            echo '<input type="hidden" id="table" name="table" value="' . $table . '">
                  <select name="col' . $i . '" id="col' . $i . '">';

            while (($row = oci_fetch_row($result)) != false) {
                foreach ($row as $val) {
                    echo "<option value=$val>$val</option>";
                }
            }
            echo '</select>';

            echo '<select name="condition' . $i . '" id="condition ' . $i . '">
                  <option value="=">=</option>
                  <option value=">">&gt</option>
                  <option value="<">&lt</option>
                  <option value=">=">&#8805</option>
                  <option value="<=">&#8804</option>
                  <option value="!=">!=</option>
                  <option value="LIKE">LIKE</option>
                  </select>';

            echo '<input type="text" name="var' . $i . '">';

            echo '<br>';
            echo '<br>';
        }
    }

    function handleSelect()
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

        for ($i = 0; $i < $count; $i++) {
            echo '<br>';
            // echo $_GET['var'. (string)$i];
            if ($i != 0) {
                $where_str  .= 'AND ';
            }
            $where_str .= $_GET['col' . (string)$i] . $_GET['condition' . (string)$i] . "'" . $_GET['var' . (string)$i] . "'" . ' ';
        }

        $result = executePlainSQL($select_str . ' ' . $from_str . ' ' . $where_str);
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



    if (isset($_GET['selectTable']) || isset($_GET['select']) || isset($_GET['addField'])) {
        handleGETRequest();
    }


    ?>


</body>

</html>