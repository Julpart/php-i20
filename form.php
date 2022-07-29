<?php
include 'config.php';
include 'db.php';
$male = "";
$female = "";
$nameStyle = "";
$emailStyle = "";
$dateStyle = "";
$errorString = "";
function valid($data)
{
    $data = strip_tags($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}
if (isset(($_POST['form']))) {
    $name = valid($_POST['name']);
    $email = valid($_POST['email']);
    $date = valid($_POST['date']);
    $sex = valid($_POST['sex']);
    $theme = valid($_POST['theme']);
    $info = valid($_POST['info']);
    $contract = valid($_POST['contract']);
    setcookie("name", $name);
    setcookie("email", $email);
    setcookie("date", $date);
    setcookie("sex", $sex);
    if (!preg_match("/^[а-яёa-z]+$/iu", $name)) {
        $error['name'] = "В имени могут находиться только буквы! ";
    }
    if (!preg_match("/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/", $email)) {
        $error['email'] = "Укажите существующую почту! ";
    }
    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/", $date)) {
        $error['date'] = "С датой что-то не так ";
    }
    if (isset($error)) {
        $strErr = serialize($error);
        setcookie("error", $strErr);
        header("Location: /form.php");
        die();
    }
    if (submitForm($name, $email, $date, $sex, $theme, $info, $contract)) {
        $result = true;
        setcookie("error", $strErr, time() - 3600);
        setcookie("set", true);
        header("Location: /form.php");
        die();
    } else {
        setcookie("error", $strErr, time() - 3600);
        setcookie("set", false);
        header("Location: /form.php");
        die();
    }
}
if (isset($_COOKIE['sex'])) {
    $sex = valid($_COOKIE['sex']);
    if ($sex == 'female') $female = 'checked';
    elseif ($sex == 'male') $male = 'checked';
    else die('Что-то пошло не так');
}
if (isset($_COOKIE['error'])) {
    $error = unserialize(valid($_COOKIE['error']));
    foreach ($error as $item) {
        $errorString = $errorString . $item;
    }
    if (isset($error['name'])) $nameStyle = "style='background-color:#FC4E23'";
    if (isset($error['email'])) $emailStyle = "style='background-color:#FC4E23'";
    if (isset($error['date'])) $dateStyle = "style='background-color:#FC4E23'";
}
if (isset($_COOKIE['set'])) {
    $result = $_COOKIE['set'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./scripts/notify.js"></script>

    <title>Form</title>
</head>

<body>
    <main>
        <div class="main-form">
            <a class="form-link" href="products.php">Назад</a>
            <div class="container-form">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" class="form-main">
                    <label for="name" class="form-label">Имя:</label>
                    <input id="name" name="name" type="text" value="<?= $_COOKIE["name"] ?>" required class="form-input" <?= $nameStyle ?>>
                    <label for="email" class="form-label">Почта:</label>
                    <input id="email" name="email" type="text" value="<?= $_COOKIE["email"] ?>" required class="form-input" <?= $emailStyle ?>>
                    <label for="date" class="form-label">Год рождения:</label>
                    <input id="date" name="date" type="date" value="<?= $_COOKIE["date"] ?>" required class="form-input" <?= $dateStyle ?>>
                    <label for="sex" class="form-label">Пол:</label>
                    <div class="form-block">
                        <input type="radio" id="male" name="sex" value="male" <?= $male ?>><span class="form-label">Муж.</span>
                    </div>
                    <div class="form-block">
                        <input type="radio" id="female" name="sex" value="female" <?= $female ?>><span class="form-label">Жен.</span>
                    </div>
                    <label for="theme" class="form-label">Тема обращения:</label>
                    <input id="theme" name="theme" type="text" required class="form-input">
                    <label for="info" class="form-label">Суть вопроса:</label>
                    <textarea required id="info" name="info" rows="5" cols="23" class="form-area"></textarea>
                    <div class="form-block">
                        <span class="form-label">С контрактом ознакомлен:</span>
                        <input type="checkbox" id="contract" name="contract" required class="form-chekbox">
                    </div>
                    <input type="submit" value="Отправить" class="form-button" name="form" required>
                </form>
            </div>
        </div>
    </main>
    <?php if (isset($error)) echo "<script>$.notify('$errorString', 'error');</script>";
    elseif ($result) echo "<script>$.notify('Данные сохранены', 'success');</script>";
    elseif (isset($result)) echo "<script>$.notify(' Данные не сохранены, что-то пошло не так', 'error');</script>" ?>
</body>

</html>