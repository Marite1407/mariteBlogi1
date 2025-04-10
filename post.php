<?php
if(isset($_GET['sid']) && is_numeric($_GET['sid'])) {
    $id = (int)$_GET['sid']; // võtame url id väärtuse tehes täisarvuks
    $sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') as adding FROM blog WHERE id = ".$id;
    $data = $db->dbGetArray($sql);
    //$db->show($data);
    if($data !== false) {
        $val = $data[0];

        $sql_prev = "SELECT id FROM blog WHERE added < '". $val['added'] . "' ORDER BY added DESC LIMIT 1";
        $prev = $db->dbGetArray($sql_prev);

        $sql_next = "SELECT id FROM blog WHERE added > '". $val['added'] . "' ORDER BY added ASC LIMIT 1";
        $next = $db->dbGetArray($sql_next);

        echo $prev[0]['id']." ".$next[0]['id'];
        
    ?>
<!-- Postituse sisu -->
    <div class="container mt-5">
        <h1><?php echo $val['heading']; ?></h1>
        <p><strong>Avaldatud: </strong><?php echo $val['adding']; ?></p>
        
        <div class="row">
            <div class="col-md-12">
                
                <!-- Pilt Austraaliast -->
                <img src="<?php echo $val['photo']; ?>" alt="Austraalia" class="img-fluid" style="max-height: 500px; object-fit: cover; width: 100%;">

                <p><?php echo $val['context']; ?></p>
                <p>Austraalia on ainus riik, mis on samal ajal ka terviklik kontinent. Siin on erakordselt mitmekesised looduskeskkonnad, alates kuumast kõrbest kuni troopiliste vihmametsadeni. Kuid Austraalia on tuntud ka oma ainulaadsete loomade ja imetlusväärsete loodusmälestiste poolest,
                
                <hr>

                <p><strong>Kategooriad:</strong> <span class="badge bg-primary">Austraalia</span> <span class="badge bg-secondary">Reisimine</span></p>

                <p>
                <?php
                // eelmine nupp
                if($prev !== false) {
                    ?>
                        <a href="?page=post&sid=<?= $prev[0]['id']; ?>" class="btn btn-primary">Eelmine postitus</a>
                    <?php
                }    
                // järgmine nupp
                if($next !== false) {
                    ?>
                        <a href="?page=post&sid=<?= $next[0]['id']; ?>" class="btn btn-primary">Järgmine postitus</a>
                    <?php
                }    
                ?>    
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