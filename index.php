<?php
$products_list = [];

$db_connection_string = "host=localhost port=5432 dbname=catalog user=postgres password=qwerty";
$db_connection = pg_connect($db_connection_string);

if ($db_connection) {
    $products_query = "SELECT * FROM products ORDER BY id ASC";
    $products_result = pg_query($db_connection, $products_query);

    if (pg_num_rows($products_result) > 0) {
        while ($product_data = pg_fetch_assoc($products_result)) {
            $products_list[] = $product_data;
        }
    }
    
    pg_close($db_connection);
}
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Каталог товаров</title>
	</head>
<body>
    <h1>Каталог товаров</h1>
    <div>
        <?php if (!empty($products_list)): ?>
            <?php foreach ($products_list as $product): ?>
                <a href="product.php?id=<?php echo $product['id']; ?>">
                    <div> 
                        <img src='images/<?php echo $product['image']; ?>' alt='пластинка'>
                        <h2><?php echo $product['name']; ?></h2>
                        <h2>Цена: <?php echo $product['price']; ?> руб.</h2>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <h2>Товаров в каталоге нет.</h2>
        <?php endif; ?>
    </div>
</body>
</html>