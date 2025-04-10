<?php
include("include/settings.php"); //lae seaded
include("include/mysqli.php"); // laen andmebaasi klass
$db = new Db(); // loo andmebaasi objekt
$page = isset($_GET['page']) ? $_GET['page'] : 'homepage';
$allowed_pages = ['post_add','homepage', 'blog', 'contact', 'post', 'post_edit', 'edit'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body>
<div class="container">
        <?php include 'menu.html'; ?>
    </div>

    <div class="container">
        <?php include("$page.php"); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
