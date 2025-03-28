<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';
$allowed_pages = ['homepage', 'blog', 'contact', 'post1', 'post2', 'post3', 'post4', 'post5'];
if(!in_array($page, $allowed_pages)) {
    $page= 'homepage';
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marite reisiblogi - Reisiblogi</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
        <?php include 'menu.html'; ?>
    </div>

    <div class="container">
        <?php include("$page.html"); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
