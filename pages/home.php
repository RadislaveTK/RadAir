<?php
    use RadAir\Page;
    $home = new Page("Home");
    $home->top("templates/top.php");
    $home->header("templates/head.php");
    var_dump($_SESSION['app']);
?>
<!-- Ваш контент для домашней страницы -->
<h1>Добро пожаловать на мой сайт!</h1>

<?php
    $home->footer("templates/foot.php");
    $home->bottom("templates/bottom.php");
?>

