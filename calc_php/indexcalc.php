<?php
if (isset($_POST['button']))
{
    $a=(int) $_POST['number1'];
    $b=(int) $_POST['number2'];
    $p= $_POST['operation'];
    $c=0;
        if($p=='+')
        $c=$a + $b;
    else if($p=='-')
        $c=$a - $b;
    else if($p=='*')
        $c=$a * $b;
    else if($p=='/')
    {
        if ($b==0)
            echo "На ноль делить нельзя!";
        else $c=$a / $b;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Калькулятор на php</title>
</head>
<body>
<form action="" method="post">
    <input type="number" name="number1" placeholder="Введите число">
        <select name="operation">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    <input type="number" name="number2" placeholder="Введите число">
    <input type="submit" name="button" value="Рассчитать">
    <div>
        <span>Результат</span>
        <span>
         <?php
            echo $c;
         ?>
     </span>
    </div>

</form>

</body>
</html>