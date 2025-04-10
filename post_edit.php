<?php
if(isset($_GET['sid']) && !empty($_GET['sid']) && is_numeric($_GET['sid']) && isset($_GET['delete'])) {
    $id = (int)$_GET['sid'];
    $update = $_GET['delete'];
    $sql = "SELECT photo FROM blog WHERE id = $id";
    $photo = $db->dbGetArray($sql);
    //$db->show($photo);    test
    if(($photo[0]['photo']) && file_exists($photo[0]['photo'])) {
        unlink($photo[0]['photo']);
    }
    $sql = "DELETE FROM blog where id = $id";   //kirje kustutamise sql lause
    if($db->dbQuery($sql)) {
        echo "Postitus edukalt kustutatud";
    } else {
        echo "Posituse kustutamisel tekkis tõrge!";
    }
 
}
 
$sql = "SELECT id, heading, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') as added FROM blog ORDER BY added DESC";
$data = $db->dbGetArray($sql);
//$db->show($data); //TEST!
?>
<div class="container mt-5">
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
    <?php
    if($data !== false) {
        ?>
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th>Jrk</th>
                    <th>Pealkiri</th>
                    <th>Lisatud</th>
                    <th>Tegevus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($x = 0; $x < count($data); $x++) { // $x+=1 vs $x=$x+1
                    ?>
                    <tr>
                        <td class="text-end"><?= ($x+1); ?>.</td>
                        <td><?= $data[$x]['heading']; ?></td>
                        <td><?= $data[$x]['added']; ?></td>
                        <td class="text-center">
                            <a href="?page=edit&sid=<?= $data[$x]['id']; ?>" title="Muuda"><i class="fa-solid fa-pen-to-square text-primary"></i></a>    
                            <a href="?page=post_edit&sid=<?= $data[$x]['id']?>&delete=true" onclick="return confirm('Kas oled kindel, et soovid kustutada?');"><i class="fa-solid fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                    <?php
                } // for-loop lõpp
                ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "<h4>Viga<h4>";
        echo "<p>Postitusi ei leitud.</p>";
    }
    ?>    
    </div>
</div>    