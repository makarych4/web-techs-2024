<?php
$a = random_int(-10, 10);
$b = random_int(-10, 10);
$a_for_switch = random_int(0, 15);

// Пункт 1
function calculateBasedOnSign($num1, $num2)
{
    if ($num1 >= 0 && $num2 >= 0) {
        return $num1 - $num2;
    } elseif ($num1 < 0 && $num2 < 0) {
        return $num1 * $num2;
    } else {
        return $num1 + $num2;
    }
}

// Пункт 2
function printRangeUsingSwitch($startNum)
{
    echo "Выводим числа от $startNum до 15: ";
    switch ($startNum) {
        case 0: echo "0 ";
        case 1: echo "1 ";
        case 2: echo "2 ";
        case 3: echo "3 ";
        case 4: echo "4 ";
        case 5: echo "5 ";
        case 6: echo "6 ";
        case 7: echo "7 ";
        case 8: echo "8 ";
        case 9: echo "9 ";
        case 10: echo "10 ";
        case 11: echo "11 ";
        case 12: echo "12 ";
        case 13: echo "13 ";
        case 14: echo "14 ";
        case 15: echo "15";
            break;
    }
}

// Пункт 3
function add($x, $y)
{
    return $x + $y;
}

function subtract($x, $y)
{
    return $x - $y;
}

function multiply($x, $y)
{
    return $x * $y;
}

function divide($x, $y)
{
    if ($y == 0) {
        return "Ошибка: Деление на ноль!";
    }
    return $x / $y;
}

// Пункт 4
function mathOperation($arg1, $arg2, $operation)
{
    switch ($operation) {
        case 'сложение':
            return add($arg1, $arg2);
        case 'вычитание':
            return subtract($arg1, $arg2);
        case 'умножение':
            return multiply($arg1, $arg2);
        case 'деление':
            return divide($arg1, $arg2);
        default:
            return "Неизвестная операция";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>17</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <div class="content">
		<h1>Лабораторная работа 17</h1>
            <h2>Пункт 1</h2>
            <p>Исходные числа: a = <?php echo $a; ?>, b = <?php echo $b; ?>.</p>
            <p>
                <?php
                    echo calculateBasedOnSign($a, $b);
                ?>
            </p>

            <h2>Пункт 2</h2>
            <p>
                <?php printRangeUsingSwitch($a_for_switch); ?>
            </p>

            <h2>Пункт 3</h2>
            <p>Исходные числа: a = <?php echo $a ?>, b = <?php echo $b ?></p>
            <ul>
                <li>Сложение: <?php echo add($a, $b); ?></li>
                <li>Вычитание: <?php echo subtract($a, $b); ?></li>
                <li>Умножение: <?php echo multiply($a, $b); ?></li>
                <li>Деление: <?php echo divide($a, $b); ?></li>
            </ul>

            <h2>Пункт 4</h2>
            <?php
                $operations = ['сложение', 'вычитание', 'умножение', 'деление'];
                $random_operation = $operations[array_rand($operations)];
            ?>
            <p>Выполняем случайную операцию "<?php echo $random_operation; ?>" над числами a = <?php echo $a ?> и b = <?php echo $b ?>.</p>
            <p>
                Результат: <?php echo mathOperation($a, $b, $random_operation); ?>
            </p>

        </div>
    </body>
</html>