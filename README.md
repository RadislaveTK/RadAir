<p align="center"><img src="https://i.postimg.cc/1RHZBWPD/Frame-1-2.png" width="400" alt="RadAir logo"></p>

# Документация по RadAir - Вашему Движку для Создания Сайтов

## Введение

RadAir - это легкий и гибкий движок для создания веб-сайтов на основе PHP. Он предоставляет простые средства для организации структуры сайта и обработки запросов.

## Установка

1. Скачайте архив с движком RadAir.
2. Разархивируйте его в корневую директорию вашего веб-сервера.

### Подключение движка

Включите файл `radair.php` в ваши страницы (например, `index.php` или `home.php`).

```php
<?php
require_once('radair.php');

$main = new Main("radair");
// Дополнительные настройки...
?>
```

## Основные классы

### 1. Класс Main
Main - это ключевой класс RadAir, который предоставляет базовую структуру для управления сайтом.

#### Методы:
* ```set_echo_errors($bool)```: Устанавливает отображение ошибок.
* ```set_title_NF($title)```: Устанавливает название для страницы "не найдено".

### Переменные: 
+ ```$title``` - название сайта.
+ ```$title_nf``` - название не найденой страницы.
+ ```$page``` - название запрашеваемой страницы (Например localhost:8000/home, будет значение home)
+ ```$url``` - строка из адресной строки.

#### Использование:

```php
<?php
require_once('radair.php');

$main = new Main("Мой сайт");
$main->set_echo_errors(false); // Ошибки выключены
$main->set_title_NF("Страница не найдена"); // Задал название страницы 404

// Логика подключения страниц
if (file_exists('all/' . $main->page . '.php')) {
    include 'all/' . $main->page . '.php';
} else {
    $main->not_found();
}
?>
```

#### Пояснение:

Класс Main предоставляет базовые методы для управления заголовком, ошибками, и включением различных частей страницы. 
Метод not_found() используется для отображения страницы "не найдено", если запрошенная страница отсутствует.<br>

**Примечание**<br>
Файлы ```top.php, head.php, foot.php, bottom.php``` обязательно должны храниться в папке main.

### 2. Класс Page (наследуется от Main)
Page - это класс, который расширяет функциональность Main для работы с конкретными страницами сайта.

#### Методы:

* ```top($top, $title = null)```: Включает верхнюю часть страницы.
* ```head($head)```: Включает часть страницы, отвечающую за заголовок (head).
* ```foot($foot)```: Включает нижнюю часть страницы (footer).
* ```bottom($bottom)```: Включает завершающую часть страницы.
* ```module()```: Возвращает аргументы из параметров запроса.

### Переменные: 
+ ```$title``` - название сайта.
+ ```$url``` - строка из адресной строки.

Использование:

```php 
<?php
require_once('radair.php');

$page = new Page('Домашняя страница');

$page->top('main/top.php');
$page->head('main/head.php');
?>

<!-- Ваш контент для домашней страницы -->
<h1>Добро пожаловать на мой сайт!</h1>

<?php
$page->foot('main/foot.php');
$page->bottom('main/bottom.php');
?>
```

#### Пояснение:
Класс Page предназначен для работы с конкретными страницами сайта. 
Он унаследован от класса Main, что позволяет использовать его методы для управления страницей. 
В приведенном примере создания домашней страницы (all/home.php), мы используем методы top(), head(), foot(), bottom() для включения различных частей страницы, а также добавляем свой контент между ними.

## Заключение
RadAir - это удобный и гибкий инструмент для создания веб-сайтов на PHP. Документация предоставляет основные сведения о его использовании. Для более подробной информации обратитесь к комментариям в исходном коде и дополнительным ресурсам. Удачи в разработке вашего веб-проекта!
