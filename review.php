<?php
if (isset($_POST['product_id']) && isset($_POST['username']) && isset($_POST['review'])) {
    
    $submitted_product_id = $_POST['product_id'];
    $submitted_username = $_POST['username'];
    $submitted_review = $_POST['review'];

    $db_connection_string = "host=localhost port=5432 dbname=catalog user=postgres password=qwerty";
    $db_connection = pg_connect($db_connection_string);

    $insert_query = "INSERT INTO reviews (product_id, username, review) 
					 VALUES ($submitted_product_id, '$submitted_username', '$submitted_review')";

	$insert_result = pg_query($db_connection, $insert_query);
    
    pg_close($db_connection);
    
    if ($insert_result) {
        header("Location: product.php?id=" . $submitted_product_id);
        exit();
    } else {
        echo "Произошла ошибка при добавлении комментария.";
    }
}
?>