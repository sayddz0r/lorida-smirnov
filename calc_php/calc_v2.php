<?php
$connection = mysqli_connect("localhost", "root", "", "calc_data");
if (!$connection) {
    die ("No connection established. Try again." . mysqli_connect_error());
}
//Проверка заполнения
if (!empty($_REQUEST['number1'])) {
    $number1 = (float)$_REQUEST['number1'];
}
if (!empty($_REQUEST['number2'])) {
    $number2 = (float)$_REQUEST['number2'];
}
if (!empty($_REQUEST['operation'])) {
    $operation = (float)$_REQUEST['operation'];
}

$result_calc = '';
if ($operation == 'add') {
    $result_calc = $number1 + $number2;
} elseif ($operation == '-') {
    $result_calc = $number1 - $number2;
} else if ($operation == 'mult') {
    $result_calc = $number1 * $number2;
} else if ($operation == '/') {
    if ($number2 == 0)
        echo "На ноль делить нельзя!";
} else $result_calc = $number1 / $number2;
{
}

mysqli_query($connection, "INSERT INTO calc_result(`number_1`, `operation`, `number_2`, `result`) VALUES ('$number1','$operation','$number2','$result_calc')");
$query = mysqli_query($connection, "SELECT * FROM calc_result ORDER BY id DESC LIMIT 7");

$res = [
    "number1" => [],
    "number2" => [],
    "operation" => [],
    "result_calc" => []
];

$row = mysqli_fetch_assoc($query);
while (!empty($row)) {
    $res[] = $row;
    $row = mysqli_fetch_assoc($query);
}
//echo $result_calc;
echo json_encode($res);

?>