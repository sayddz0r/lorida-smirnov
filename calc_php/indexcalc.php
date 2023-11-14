<?php
$connection = mysqli_connect("localhost","root", "","calc_data");
if (!$connection) {
    die ("Связь не установлена. Попробуйте еще раз." . mysqli_connect_error());
}
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
mysqli_query($connection, "INSERT INTO calc_result(`number_1`, `operation`, `number_2`, `result`) VALUES ('".$_POST['number1']."','".$_POST['operation']."','".$_POST['number2']."','".$c."')");
$query = mysqli_query($connection, "SELECT * FROM calc_result ORDER BY id DESC LIMIT 7");
$res=[];
$row=mysqli_fetch_assoc($query);
while   (!empty($row)){
    $res[]=$row;
    $row=mysqli_fetch_assoc($query);
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
    <div>
        <span>История операций:</span>
        <span>
            <?php
            foreach ($res as $resul){ ?>
                <?php echo $resul["number_1"]; ?>
                <?php echo $resul["operation"]; ?>
                <?php echo $resul["number_2"]; ?>
                <span>=</span>
                <?php echo $resul["result"]; ?>
            <?php }?>
        </span>
    </div>

</form>

</body>
</html>