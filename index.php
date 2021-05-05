<!DOCTYPE html>
<html lang="fi">
    <head>
        <title>Palautuskansio</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">
                <img src="./kuvat/picardia.png" width="45" height="30" alt="picardia">
                Etusivu
            </span>
            <span class="navbar-text">
                Etusivu demoille
            </span>
        </nav>
        <ul class="list-group">
            <?php
                $files = scandir('./demot/');
                sort($files,SORT_NATURAL | SORT_FLAG_CASE);
                foreach($files as $file) {
                    if (substr($file, 0, 4) == "demo") {
                        echo '<a class="list-group-item list-group-item-action" href="./demot/' . substr($file, 0, -4) . '">Demo ' . substr(substr($file, 4, strlen($file)), 0, -4) . ' </a>';
                    }
                }
                ?>
        </ul>
        <ul class="list-group">
            <?php
                $files = scandir('./harj/');
                sort($files,SORT_NATURAL | SORT_FLAG_CASE);
                foreach($files as $file) {
                    if (substr($file, 0, 4) == "harj") {
                        echo '<a class="list-group-item list-group-item-action" href="./harj/' . substr($file, 0, -4) . '">Harjoitus ' . substr(substr($file, 4, strlen($file)), 0, -4) . ' </a>';
                    }
                }
            ?>
        </ul>
        <ul class="list-group">
            <a class="list-group-item list-group-item-action" href="./css4.html">CSS4 -demo</a>
            <a class="list-group-item list-group-item-action" href="./samarium/index.php">Samarium</a>
        </ul>
    </body>
</html>