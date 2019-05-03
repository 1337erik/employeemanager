<?php include( './head.php' );


if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

    var_dump( $_POST );

    // prepare sql and bind parameters
    $stmt = $conn->prepare( "DELETE FROM EMPLOYEE WHERE emp_id = :emp_id" );

    $stmt->bindParam( ':emp_id', $emp_id );

    // insert a row
    $emp_id = $_POST[ 'emp_id' ];
    if( $stmt->execute() ){

        header( "Location: ./lastname-view.php" );
        die();
    }
}


$stmt = $conn->prepare( "SELECT * FROM EMPLOYEE" );
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode( PDO::FETCH_ASSOC );

echo '<h1 class="page-head">Delete an Employee</h1>';

echo '<main>'; ?>


<form method="post">
    <div class="form-group">

        <label for="emp_id">Employee to Delete</label>
        <select name="emp_id" id="emp_id">

            <?php foreach( $stmt->fetchAll() as $emp ) { ?>
                <option value="<?= $emp[ 'emp_id' ];?>"><?= $emp[ 'first_name' ] . ' ' . $emp[ 'last_name' ]; ?></option>
            <?php } ?>
        </select>
    </div>
    <button class="form-button" type="submit">Send It</button>
</form>


<?php

echo '</main>';



?>



<?php include( './foot.php' ); ?>


<?php /*

2. Create a lastname-delete.php file. This page should:
a. Contain some method for users to enter or select which record they wish to delete from
one of your database tables.
b. When submitted, the page should delete the indicated record from the database table.
 Be sure to use parameterized queries to avoid SQL-injection
vulnerabilities

*/ ?>