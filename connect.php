<?php

$servername = "localhost";
$username = "root";
$password = "1squidward";
$db = "Book";

try {

    $conn = new PDO( "mysql:host=$servername;dbname=$db", $username, $password );
    // set the PDO error mode to exception
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $sql = "CREATE TABLE IF NOT EXISTS Branch (
        branch_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        branch_name VARCHAR(30) NOT NULL,
        mgr_id INT UNSIGNED
    )";
    $conn->exec( $sql );

    $sql = "CREATE TABLE IF NOT EXISTS Employee (
        emp_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        first_name VARCHAR(25) NOT NULL,
        last_name VARCHAR(25) NOT NULL,
        gender VARCHAR(1),
        branch_id INT UNSIGNED,
        FOREIGN KEY Branch (branch_id) REFERENCES Branch(branch_id)
    )";
    $conn->exec( $sql );
} catch( PDOException $e ) {

    echo "Connection failed: " . $e->getMessage();
}


/*

EMPLOYEE
    emp_id INT
    first_name VARCHAR(25)
    last_name VARCHAR(25)
    gender VARCHAR(1)
    branch_id INT

BRANCH
    branch_id INT
    branch_name VARCHAR(25)
    mgr_id INT

*/

?>