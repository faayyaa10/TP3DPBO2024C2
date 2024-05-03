<?php

class DB
{
    private $hostname = "localhost";
    private $username = "root";
    private $password;
    private $dbname = "db_album";
    private $conn;
    private $result;

    public function __construct($hostname, $username, $password, $dbname)
    {
        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        // Automatically open connection when the object is instantiated
        $this->open();
    }

    function open()
    {
        // Connect to the database
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);

        // Check connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        } 
    }

    function execute($query)
    {
        // Execute query and store the result
        $this->result = mysqli_query($this->conn, $query);

        // Check if the query was successful
        if (!$this->result) {
            die("Query execution failed: " . mysqli_error($this->conn));
        }

        // Return the query result
        return $this->result;
    }

    //untuk addData
    function execute2($query, $params = [])
    {
    // Prepare the query
    $stmt = $this->conn->prepare($query);

    // Check if preparing the statement was successful
    if (!$stmt) {
        die("Failed to prepare query: " . $this->conn->error);
    }

    // Bind parameters if provided
    if (!empty($params)) {
        $types = array_shift($params);
        $stmt->bind_param($types, ...$params);
    }

    // Execute the statement
    $stmt->execute();

    // Check if the execution was successful
    if ($stmt->error) {
        die("Query execution failed: " . $stmt->error);
    }

    // Get the number of affected rows
    $affected_rows = $stmt->affected_rows;

    // Close the statement
    $stmt->close();

    // Return the number of affected rows
    return $affected_rows;
    }

    function getResult()
    {
        // Fetch a single row of the query result
        return mysqli_fetch_array($this->result);
    }

    function executeAffected($query = "")
    {
        // Execute a query
        mysqli_query($this->conn, $query);

        // Return the number of rows affected by the last operation
        return mysqli_affected_rows($this->conn);
    }

    function close()
    {
        // Close the database connection
        mysqli_close($this->conn);
    }
}
