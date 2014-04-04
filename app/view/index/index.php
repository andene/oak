<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $view->title; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="/assets/css/main.css">
    </head>
    <body>
    <h2>    <?php echo $view->headline ;?></h2>

    <ul>
        <li><a href="/">Start</a></li>
        <li><a href="/help">Hjälp</a></li>
        <li><a href="/user/MrOak/123">User Route With param</a></li>
        <li><a href="/test/param1/param2">Closure Route</a></li>

    </ul>

    
        <script src="js/main.js"></script>
    </body>
</html>
