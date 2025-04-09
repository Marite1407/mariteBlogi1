<?php
if(isset($_GET['sid']) && is_numeric($_GET['sid'])) {
    $id = (int)$_GET['sid']; // võtame url id väärtuse tehes täisarvuks
    $sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') as adding FROM blog WHERE id = ".$id;
    $data = $db->dbGetArray($sql);
    //$db->show($data);
    if($data !== false) {
        $val = $data[0];
        
    ?>
<!-- Postituse sisu -->
    <div class="container mt-5">
        <h1><?php echo $val['heading']; ?></h1>
        <p><strong>Avaldatud: </strong><?php echo $val['adding']; ?></p>
        
        <div class="row">
            <div class="col-md-12">
                
                <!-- Pilt Austraaliast -->
                <img src="<?php echo $val['photo']; ?>" alt="Austraalia" class="img-fluid" style="max-height: 500px; object-fit: cover; width: 100%;">

                <h2>Mis teeb Austraalia eriliseks?</h2>
                <p>Austraalia on ainus riik, mis on samal ajal ka terviklik kontinent. Siin on erakordselt mitmekesised looduskeskkonnad, alates kuumast kõrbest kuni troopiliste vihmametsadeni. Kuid Austraalia on tuntud ka oma ainulaadsete loomade ja imetlusväärsete loodusmälestiste poolest,
                
                <hr>

                <p><strong>Kategooriad:</strong> <span class="badge bg-primary">Austraalia</span> <span class="badge bg-secondary">Reisimine</span></p>

                <h3>Eelmine ja järgmine postitus</h3>
                <p>
                    <a href="index.php?page=post2">Järgmine postitus: Hispaania reis</a>
                </p>

            </div>
        </div>
    </div>
    <?php
    } else {
    ?>
    <h4>Viga</h4>
    <p>Sellist postitust ei ole!</p>
    <?php
    }
} else {
    ?>
    <h4>Viga</h4>
    <p>URL on vigane!</p>
    <?php
}      
?>