<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$db->show($_POST); // näita vormi andmeid
    //$db->show($_FILES); // näita faili infot
    // tekstiväljade olemasolu ja tühjuse kontroll
    $heading = trim($_POST['heading'] ?? '');
    $preamble = trim($_POST['preamble'] ?? '');
    $context = trim($_POST['context'] ?? '');
    $tags = trim($_POST['tags'] ?? '');

    $errors = []; // tühja listi loomine

    if($heading === '') {$errors[] = "Pealkiri on kohustuslik.";}
    if($preamble === '') {$errors[] = "Sissejuhatav tekst on kohustuslik.";}
    if($context === '') {$errors[] = "Põhitekst on kohustuslik.";}
    if($tags === '') {$errors[] = "Kategooria(d) on kohustuslik.";}

    // faili olemasolu ja kontroll
    if(!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Pildi üleslaadimine ebaõnnestus või on see puudu.";
    } else {
        $image = $_FILES['photo'];
        // failinime normaliseerimine
        $origName = basename($image['name']); // ainult nimi.laiend (flower.jpg)
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

        //$db->show($image).'<br>';
        //echo $origName.'<br>';
        //echo $ext.'<br>';
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp']; // lubatud pildifailid
        if(!in_array($ext, $allowed)) {
            $errors[] = "Lubatud on ainult pildifailid: " . implode(',', $allowed);
        }

        $normalizedName = preg_replace('/[^a-z0-9_\-\.]/i', '_', pathinfo($origName, PATHINFO_FILENAME));
        $filename = $normalizedName . '_' . time() . '.' . $ext;
    }
    // kui vigu pole, siis töötle ja salvesta
    if(empty($errors)) {
        $heading = htmlspecialchars($heading);
        $preamble = htmlspecialchars($preamble);
        $context = htmlspecialchars($context);
        $tags = htmlspecialchars($tags);

        $uploadPath = UPLOAD_IMAGES . $filename; // images/lilled.png
        move_uploaded_file($image['tmp_name'], $uploadPath); // tõsta tmp kaustast soovitud kohta

        // tee SQL luase andmebaasi lisamiseks
        $sql = "INSERT INTO blog (heading, preamble, context, tags, photo) VALUES (
                '".$db->dbFix($heading)."', 
                '".$db->dbFix($preamble)."', 
                '".$db->dbFix($context)."', 
                '".$db->dbFix($tags)."', 
                '".$db->dbFix($uploadPath)."')";
        //echo $sql; // väljasta sql lause (test!)
        if($db->dbQuery($sql)) {
            echo "<div class='alert alert-success'>Postitus lisatud!</div>";
        } else {
            echo "<div class='alert alert-danger'>Postitust ei lisatud!</div>";
        }
    } else {
        //leiti vigu ($errors)
        echo "<div class='alert alert-danger'><ul>";
        foreach($errors as $error) {
            echo "<li>".htmlspecialchars($error)."</li>"; 
        }   
        echo "<ul/></div>";
    }

} // if($_SERVER['REQUEST_METHOD'] === 'POST' LÕPP   
?>

<div class="container mt-5">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="card p-2 shadow">
            <h2 class="text-center">Uus postitus</h2>
            <form action="?page=post_add" method="post" enctype="multipart/form-data">
                <div class="mb-3">	
                    <label for="heading" class="form-label fw-bold">Pealkiri</label>
                    <input type="text" name="heading" id="heading" class="form-control" required>
                </div>

                <div class="mb-3">	
                    <label for="preamble" class="form-label fw-bold">Sissejuhatus</label>
                    <textarea name="preamble" class="form-control" id="preabmle" rows="3" maxlength="200" required></textarea>
                </div>

                <div class="mb-3">	
                    <label for="context" class="form-label fw-bold">Põhitekst</label>
                    <textarea name="context" class="form-control" id="context" rows="3" required></textarea>

                <div class="mb-3">	
                    <label for="tags" class="form-label fw-bold">Sildid</label>
                    <input type="text" name="tags" id="tags" class="form-control" maxlenght="50" placeholder="Eralda komadega" required>
                </div>

                <div class="mb-3">	
                    <label for="photo" class="form-label fw-bold">Foto</label>
                    <input type="file" name="photo" id="photo" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="reset" class="btn btn-danger">Tühjenda vorm</button>
                    <button type="submit" class="btn btn-success">Sisesta postitus</button>
                </div>
            </form>
        </div>
    </div>
</div>    