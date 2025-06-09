<?php
date_default_timezone_set('Europe/Tyumen');

$title = 'Лабараторная 16';
$h1 = 'Информация о времени';
$current_year = date('Y');

function get_declension($number, $words) {
    if ($number % 100 >= 11 && $number % 100 <= 19) {
        return $words[2];
    }

    $last_digit = $number % 10;

    switch ($last_digit) {
        case 1:
            return $words[0]; // час
        case 2:
        case 3:
        case 4:
            return $words[1]; // часа
        default:
            return $words[2]; // часов
    }
}

function get_current_time_string() {
    $hours = date('H');
    $minutes = date('i');

    $hours_num = (int)$hours;
    $minutes_num = (int)$minutes;

    $hours_word = get_declension($hours_num, ['час', 'часа', 'часов']);
    $minutes_word = get_declension($minutes_num, ['минута', 'минуты', 'минут']);

    return "{$hours_num} {$hours_word} {$minutes_num} {$minutes_word}";
}

?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <div class="content">
            <h1><?php echo $h1; ?></h1>

            <div>
                <h2>Текущий год:</h2>
                <span><?php echo $current_year; ?></span>
            </div>

            <div>
                <h2>Текущее время:</h2>
                <span><?php echo get_current_time_string(); ?></span>
            </div>
        </div>
    </body>
</html>