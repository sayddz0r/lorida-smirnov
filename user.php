<?php
$connection = mysqli_connect('localhost', 'root', '', 'bulletinboard');
if (!$connection) {
    die ("No connection established. Try again." . mysqli_connect_error());
}
//Запрос с бд пользователя по id
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id_user"])) {
        $id_user = $_GET["id_user"];
        $userRequest = mysqli_query($connection, "SELECT `id_user`, `email`, `phonenumber`, `full_name` FROM user WHERE `id_user`='$id_user'");
        $user = mysqli_fetch_all($userRequest, MYSQLI_ASSOC);
        print_r($user);
    }
    if ($user == 0) {
        echo "No users added";
    }
    json_encode($user);
//Запись в бд нового пользователя
    $error = null;
} else if ($_SERVER ["REQUEST_METHOD"] == "POST") {
//    $name = ""; можно и так но сделал короче
//    $email = "";
//    $phoneNumber = "";
//    $password = "";
//    if (isset($_POST['name'])) {
//        $name = $_POST['name'];
//    };
//    if (isset($_POST['email'])) {
//        $email = $_POST['email'];
//    }
//    if (isset($_POST['phonenumber'])) {
//        $phoneNumber = $_POST['phonenumber'];
//    }
//    if (isset($_POST['password'])) {
//        $password = $_POST['password'];
//    }
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phonenumber']) && isset($_POST['password'])) {
        mysqli_query($connection, "INSERT INTO user (`email`, `phonenumber`, `full_name`, `password`) VALUES ('{$_POST['email']}','{$_POST['phonenumber']}', '{$_POST['name']}','{$_POST['password']}')");
        echo "New user: {$_POST['name']} {$_POST['email']} {$_POST['phonenumber']} {$_POST['password']} added.";
    } else {
        $error = "Not all fields are filled in";
        echo json_encode($error);
    }
// Обновляем данные пользователя в бд
} else if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $updateParam = json_decode(file_get_contents("php://input"), true);
    if (isset($updateParam['id_user'])) {
        $id_user = $updateParam['id_user'];
    }
    $updateName = "";
    if (isset($updateParam['name'])) {
        $updateName = ",`full_name`='{$updateParam['name']}'";
    }
    $updateEmail = "";
    if (isset($updateParam['email'])) {
        $updateEmail = "`email`= '{$updateParam['email']}'";
    }
    $updatePhone = "";
    if (isset($updateParam['phonenumber'])) {
        $updatePhone = ",`phonenumber`='{$updateParam['phonenumber']}'";
    }
    $updatePass = "";
    if (isset($updateParam['password'])) {
        $updatePass = ",`password`='{$updateParam['password']}'";
    }
    if (isset($updateParam['name']) || isset($updateParam['email']) || isset($updateParam['phonenumber']) || isset($updateParam['password'])) {
        $updateParamUser = mysqli_query($connection, "UPDATE user SET $updateEmail $updatePhone $updateName $updatePass WHERE `id_user`= $id_user ");
        if (isset($updateParamUser)) {
            echo "User data with id" . "&nbsp" . $id_user . "&nbsp" . "has been update.";
        } else {
            echo "User data is not updated. Try again.";
            exit();
        }
    }
//    Удаляем пользователя из бд
} else if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $deleteUser = json_decode(file_get_contents("php://input"), true);

    if (isset($deleteUser['id_user'])) {
        $id_user = $deleteUser['id_user'];
        $deleteUserQuery = mysqli_query($connection, "DELETE FROM user WHERE `id_user`=$id_user");
        echo "User with id" . "&nbsp" . $id_user . "&nbsp" . "deleted.";
    } else {
        echo "User has not been deleted.Try again.";
    }
}






