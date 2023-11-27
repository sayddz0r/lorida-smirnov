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
    $operation = $_REQUEST['operation'];
}

$result_calc = '';
$error = null;
if ($operation == 'add') {
    $result_calc = $number1 + $number2;
} else if ($operation == 'sub') {
    $result_calc = $number1 - $number2;
} else if ($operation == 'mult') {
    $result_calc = $number1 * $number2;
} else if ($operation == 'divi') {
    if ($number2 == 0) {
        echo "You can't divide by zero!";
    } else {
        $result_calc = $number1 / $number2;
    }
} else {
    $error = "Empty fields, fill them in and repeat the operation";
    echo json_encode(["error" => $error]);
}
if (!$error) {
    mysqli_query($connection, "INSERT INTO calc_result(`number_1`, `operation`, `number_2`, `result`) VALUES ('$number1','$operation','$number2','$result_calc')");
    $query = mysqli_query($connection, "SELECT * FROM calc_result ORDER BY id DESC LIMIT 7");
    $res = [];
    $row = mysqli_fetch_all($query, MYSQLI_ASSOC);
    foreach ($row as $value) {
        switch ($value["operation"]) {
            case "add":
                $op = "+";
                break;
            case "sub":
                $op = "-";
                break;
            case "mult":
                $op = "*";
                break;
            case "divi":
                $op = "/";
                break;
            default:
                $op = " ";
        }
        $res[] = $value["number_1"] . $op . $value["number_2"] . "=" . $value["result"] . "<br>";
    }
    echo json_encode($res);
}
?>