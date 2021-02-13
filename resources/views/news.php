<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo $title ?></h1>
    <ul>
        <?php foreach ($newslist as $id => $news) : ?>
        <li><a href="/news/read/<?php echo $id ?>"> <?php echo $news['title'] ?> </a></li>
        <?php endforeach ?>
    </ul>

    <?php echo "$x + $y = " . $x + $y ?>

    3 + 8 = 11
</body>
</html>