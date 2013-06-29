<?php

$add_path = '../../../add' ;
include_once $add_path.'/_default.php' ;

error_reporting( E_ALL ) ;

$link = mysqli_connect( _DB_HOST_ , _DB_USER_ , _DB_PASSWD_ , _DB_NAME_ ) ;

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

mysqli_autocommit($link, FALSE);

mysqli_query($link, "CREATE TABLE add_transaction_test2 LIKE add_transaction_test ") or die( mysqli_error($link) );
mysqli_query($link, "ALTER TABLE add_transaction_test2 Type=InnoDB") or die( mysqli_error($link) );
mysqli_query($link, "INSERT INTO add_transaction_test2 SELECT * FROM add_transaction_test  ") or die( mysqli_error($link) );

if ($result = mysqli_query($link, "SELECT COUNT(*) FROM add_transaction_test2")) {
    $row = mysqli_fetch_row($result);
    printf(" create ÈÄ select %d rows in table add_transaction_test2.\n", $row[0]);
    /* Free result */
    mysqli_free_result($result);
}

/* commit insert */
mysqli_commit($link);

/* delete all rows */
mysqli_query($link, "DELETE FROM add_transaction_test2") or die( mysqli_error($link) ) ;

if ($result = mysqli_query($link, "SELECT COUNT(*) FROM add_transaction_test2") or die( mysqli_error($link) ) ) {
    $row = mysqli_fetch_row($result);
    printf("delete ÈÄ select %d rows in table add_transaction_test2.\n", $row[0]);
    /* Free result */
    mysqli_free_result($result);
}

/* Rollback */
mysqli_rollback($link);

if ($result = mysqli_query($link, "SELECT COUNT(*) FROM add_transaction_test2") or die( mysqli_error($link) ) ) {
    $row = mysqli_fetch_row($result);
    printf(" rollback ÈÄ select %d rows in table add_transaction_test2 (after rollback).\n", $row[0]);
    /* Free result */
    mysqli_free_result($result);
}

/* Drop table add_transaction_test2 */
mysqli_query($link, "DROP TABLE add_transaction_test2");

mysqli_close($link);


echo highlight_file( __FILE__ ) ;
?>