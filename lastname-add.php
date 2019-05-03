<?php include( './head.php' );

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {

    var_dump( $_POST );

    // prepare sql and bind parameters
    $stmt = $conn->prepare( "INSERT INTO EMPLOYEE ( first_name, last_name, gender, branch_id )
        VALUES ( :firstname, :lastname, :gender, :branch )" );

    $stmt->bindParam( ':firstname', $firstname );
    $stmt->bindParam( ':lastname', $lastname );
    $stmt->bindParam( ':gender', $gender );
    $stmt->bindParam( ':branch', $branch );

    // insert a row
    $firstname = $_POST[ 'first_name' ];
    $lastname = $_POST[ "last_name" ];
    $gender = $_POST[ "gender" ];
    $branch = $_POST[ "branch_id" ];
    if( $stmt->execute() ){

        header( "Location: ./lastname-view.php" );
        die();
    }
}


$stmt = $conn->prepare( "SELECT * FROM BRANCH" );
$stmt->execute();

// set the resulting array to associative
$result = $stmt->setFetchMode( PDO::FETCH_ASSOC );



echo '<h1 class="page-head">All Employees and Branch Relationships</h1>';

echo '<main>'; ?>


<form method="post">

    <div class="form-group">

        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name">
    </div>
    <div class="form-group">

        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name">
    </div>
    <div class="form-group">

        <label for="gender">Gender</label>
        <select name="gender" id="gender">

            <option value="m">male</option>
            <option value="f">female</option>
        </select>
    </div>
    <div class="form-group">

        <label for="branch_id">Branch</label>
        <select name="branch_id" id="branch_id">

            <option value="">none</option>
            <?php foreach( $stmt->fetchAll() as $branch ) { ?>
                <option value="<?= $branch[ 'branch_id' ];?>"><?= $branch[ 'branch_name' ]; ?></option>
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

2. Create a lastname-add.php file. This page should:
a. Contain a nicely constructed form (with meaningfully named elements, etc.) that allows
users to enter or select all the values necessary to create a new record in one of your database
tables.
b. When submitted, the page should enter the values from the form into one of your
database tables.

 Be sure to use parameterized queries to avoid SQL-injection
vulnerabilities

*/ ?>