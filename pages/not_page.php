<?php
    $np = new Page("Page 404");
    $np->top("templates/top.php");
    $np->header("templates/head.php");
?>
<!-- Ваш контент для домашней страницы -->
<h1>Not Found!</h1>

<?php
    $np->footer("templates/foot.php");
    $np->bottom("templates/bottom.php");
?>

