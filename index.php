<?php
include 'functions.php';

log_page_request();

if (!empty($_FILES['image_to_upload'])) {
    $upload_status = handle_file_upload($_FILES['image_to_upload']);
    
    header('Location: index.php?upload_status=' . $upload_status);
    die();
}

$user_message = '';
if (!empty($_GET['upload_status'])) {
    if ($_GET['upload_status'] == 'ok') {
        $user_message = 'Файл успешно загружен';
    } else {
        $user_message = 'Ошибка загрузки файла';
    }
}

$gallery_images = get_gallery_images();

?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Галерея фотографий</title>
	</head>
<body>
    <h1>Галерея фотографий</h1>

    <form method="post" enctype="multipart/form-data">
        <p>Вы можете загрузить новое изображение (только JPG, до 5МБ).</p>
        <input type="file" name="image_to_upload">
        <input type="submit" value="Загрузить">
    </form>

    <?php if ($user_message): ?>
        <div class="message <?= $_GET['upload_status'] == 'ok' ? 'ok' : 'error' ?>">
            <?= $user_message ?>
        </div>
    <?php endif; ?>

    <div>
        <?php foreach ($gallery_images as $image): ?>
            <a href="<?= $image['full'] ?>" <?= $image['name'] ?>">
                <img src="<?= $image['thumbnail'] ?>" alt="<?= $image['name'] ?>">
            </a>
        <?php endforeach; ?>
    </div>

</body>
</html>