<?php
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];

//----Make changes here------
    // PHP Data Objects(PDO) Sample Code:
    // PHP Data Objects(PDO) Sample Code:
    try {
        $conn = new PDO("sqlsrv:server = tcp:june5-sql-test-1-db-server.database.windows.net,1433; Database = june5-sql-test-1-db", "farhan", "admin@123");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }
    
    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "farhan", "pwd" => "admin@123", "Database" => "june5-sql-test-1-db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:june5-sql-test-1-db-server.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
//----Make changes above------

    // SQL query
    $sql = "INSERT INTO registration (firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)";

    // Parameters for the prepared statement
    $params = array($firstName, $lastName, $gender, $email, $password, $number);

    // Preparing the statement
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    // Executing the statement
    if(sqlsrv_execute($stmt)) {
        echo "Registration successfully...";
    } else {
        echo "Error in executing statement.\n";
        die(print_r(sqlsrv_errors(), true));
    }

    // Closing the connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
?>
