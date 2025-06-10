<?php
$product_details = null;
$reviews_list = [];

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $db_connection_string = "host=localhost port=5432 dbname=catalog user=postgres password=qwerty";
    $db_connection = pg_connect($db_connection_string);

    if ($db_connection) {
        $product_query = "SELECT * FROM products WHERE id = $product_id";
        $product_result = pg_query($db_connection, $product_query);

        if (pg_num_rows($product_result) == 1) {
            $product_details = pg_fetch_assoc($product_result);

            $reviews_query = "SELECT * FROM reviews WHERE product_id = $product_id ORDER BY id DESC";
            $reviews_result = pg_query($db_connection, $reviews_query);

            if (pg_num_rows($reviews_result) > 0) {
                while ($review_data = pg_fetch_assoc($reviews_result)) {
                    $reviews_list[] = $review_data;
                }
            }
        }
        pg_close($db_connection);
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Карточка товара</title>
	</head>
<body>
    <main>
		<h1>Карточка товара</h1>
        <?php if ($product_details):?>
            
            <div>
                <img src='images/<?php echo $product_details['image']; ?>' alt='пластинка'>
                <h2><?php echo $product_details['name']; ?></h2>
                <p><?php echo $product_details['description']; ?></p>
                <h2>Цена: <?php echo $product_details['price']; ?> руб.</h2>
            </div>

            <div>
                <div>
                    <h2>Отзывы:</h2>
                    <?php if (!empty($reviews_list)): ?>
                        <?php foreach ($reviews_list as $review): ?>
                            <div class='review'>
                                <h4>Пользователь: <span><?php echo $review['username']; ?></span></h4>
                                <p><strong>Комментарий:</strong><br><span><?php echo $review['review']; ?></span></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Отзывов пока нет. Будьте первым!</p>
                    <?php endif; ?>
                </div>

                <form action='review.php' method='post' class='review_form'>
                    <h2>Оставить отзыв</h2>
                    <input type='hidden' name='product_id' value='<?php echo $product_details['id']; ?>'>
                    <input type='text' name='username' placeholder='Ваше имя' required>
                    <textarea name='review' placeholder='Ваш комментарий' required></textarea>
                    <input type='submit' value='Отправить'>
                </form>

            </div>

        <?php else:?>
            <h2>Ошибка</h2>
        <?php endif; ?>
    </main>
</body>
</html>