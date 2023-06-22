<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>test</title>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/form.js"></script>
    <script type="text/javascript" src="js/maskPhone.js"></script>
</head>

<body style="text-align: center;">

    <h1>Заполните данные о себе</h1>
    <div id="container"></div>
    <form action="form.php" method="post" id="testForm">
        <p>Имя</p>
        <p><input type="text" name="username" required></p>

        <p>Электронная почта</p>
        <p><input type="email" name="email" placeholder="Введите почту" required></p>

        <p>Номер телефона (формат +7)</p>
        <p><input type="tel" data-tel-input id="tel" name="tel" maxlength="18" minlength="18" placeholder="+7(___)___-__-__" required /></p>

        <p><input type="submit" value="Отправить" name="formSubmit"></p>
    </form>

</body>

</html>