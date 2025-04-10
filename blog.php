<div class="container mt-5">
<?php
$sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') as estonia FROM blog ORDER BY added DESC";
$data = $db->dbGetArray($sql);

if($data !== false) {
    $counter = 0; // veeru lugeja 1, 2 või 3
    foreach($data as $post) {
        if($counter % 3 === 0) {
            ?>
            <div class="row">
            <?php
        } // $counter % 3 == 0
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= $post['photo']; ?>" class="card-img-top">
                    <div class="card-body">
                        <h3><?= $post['heading']; ?></h3>
                        <p><?= $post['preamble']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="?page=post&sid=<?= $post['id']; ?>" class="btn btn-primary">Loe edasi</a>
                    </div>
                </div>
            </div>
            
        <?php


        $counter++; // liida üks juurde
        if($counter % 3 === 0) {
            echo "</div>"; // rea lõpp
        }

    } //foreach
    if($counter % 3 === 0) {
        echo "</div>"; // rea lõpp, kui viimasel real on postitusi
    }
} // $data !== false

?>

    <!-- Blogi postituste nimekiri -->
    <div class="container mt-5">
        <h1>Marite reisiblogi</h1>
        <p>Tere tulemast minu reisiblogisse! Siit leiad lugusid ja seiklusi Austraaliast, Hispaaniast, Kreekast ja mujalt!</p>

        <div class="row">
            <!-- Postitus 1: Austraalia -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/austraalia.jpg" alt="Austraalia" class="card-img-top">
                    <div class="card-body">
                        <h3><a href="index.php?page=post1">Austraalia – seiklus lõunapoolkeral</a></h3>
                        <p>Austraalia on ainus riik, mis on samal ajal ka terviklik kontinent. Siit leiad suurepärased loodusmälestised ja unikaalsed loomad.</p>
                    </div>
                    <div class="card-footer">
                        <a href="index.php?page=post1" class="btn btn-primary">Loe edasi</a>
                    </div>
                </div>
            </div>
            
            <!-- Postitus 2: Hispaania -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/spain.jpg" alt="Hispaania" class="card-img-top">
                    <div class="card-body">
                        <h3><a href="index.php?page=post2">Hispaania – kuumad rannaliivad ja kultuur</a></h3>
                        <p>Hispaania on koht, kus kohtuvad kunst, ajalugu ja maitsvad toidud.</p>
                    </div>
                    <div class="card-footer">
                        <a href="index.php?page=post2" class="btn btn-primary">Loe edasi</a>
                    </div>
                </div>
            </div>

            <!-- Postitus 3: Kreeka -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/kreeka.jpg" alt="Kreeka" class="card-img-top">
                        <p>Kreeka on oma ainulaadsete saarte ja ajaloolise pärandiga unistuste sihtkoht.</p>
                    </div>
                    <div class="card-footer">
                                    <div class="card-body">
                        <h3><a href="index.php?page=post3">Kreeka – ajalugu ja saared</a></h3>
        <a href="index.php?page=post3" class="btn btn-primary">Loe edasi</a>
                    </div>
                </div>
            </div>

            <!-- Postitus 5: Ameerika Ühendriigid -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/usa.jpg" alt="Ameerika Ühendriigid" class="card-img-top">
                    <div class="card-body">
                        <h3><a href="index.php?page=post4">Ameerika Ühendriigid – suurlinnad ja looduse imed</a></h3>
                        <p>Ameerika Ühendriigid pakuvad mitmekesiseid kogemusi, alates suurtest linnadest kuni rahvusparkideni.</p>
                    </div>
                    <div class="card-footer">
                        <a href="index.php?page=post4" class="btn btn-primary">Loe edasi</a>
                    </div>
                </div>
            </div>


            <!-- Postitus 4: Šveits -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="img/sveits.jpg" alt="Šveits" class="card-img-top">
                    <div class="card-body">
                        <h3><a href="index.php?page=post5">Šveits – mäed ja looduse ilu</a></h3>
                        <p>Šveits on tuntud oma kaunite mägede ja unustamatute maastike poolest.</p>
                    </div>
                    <div class="card-footer">
                        <a href="index.php?page=post5" class="btn btn-primary">Loe edasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>