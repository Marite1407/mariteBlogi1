<?php
$sql = "SELECT *, DATE_FORMAT(added, '%d.%m.%Y %H:%i:%s') AS estonia FROM blog ORDER BY added DESC LIMIT 3";
$data = $db->dbGETArray($sql);
//$db->show($data); //TEST. Näita tulemust inimlikult

?>

    <!-- Pealehe tutvustus ja reisipilt -->
    <div class="container">
        <h1>Tere tulemast Marite reisiblogisse!</h1>
        <p>Reisiblogi, kus jagan oma reisiseiklusi ja avastusi üle kogu maailma.</p>

        <!-- Reisipilt -->
        <img src="img/reis.jpg" alt="Reis" class="img-fluid" style="margin-bottom: 20px;">

        <h2>Viimased postitused:</h2>
        <div class="row">
            <!-- Austraalia postitus -->
             <?php
             if($data !== false) { // leiti andmeid
                foreach($data as $key=>$val) {
                    ?>
                    <!-- SIIA HTML OSA -->
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $val['photo']; ?>" alt="Austraalia" class="card-img-top">
                            <div class="card-body">
                                <h3><a href="index.php?page=post&sid=<?php echo $val['id']; ?>"><?php echo $val['heading']; ?></a></h3>
                                <p><?php echo $val['preamble']; ?></p>
                            </div>
                            <div class="float-start">
                            <?php
                            $tags = array_map('trim',explode(",", $val['tags'])); //tükelda sildid komast
                            //$db->show($tags); //TEST
                            $links = []; // tühi linkide list
                            foreach($tags as $tag) {
                                $safeTag = htmlspecialchars($tag); // turvaline HTML
                                $links[] = "<a href=''>{$safeTag}</a>"; // lisa listi
                            }
                            $result = implode(", ", $links); //ühenda listi elemendid komaga
                            echo $result; // väljasta tulemus
                            //$db->show($links); //TEST!
                            ?>   
                            </div>
                            <div class="card-footer">
                                <a href="?page=post&sid=<?= $val['id'];?>" class="btn btn-primary">Loe edasi</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                } else {
                    echo "Andmeid pole!";
                }
                ?>

        </div> 
    </div> 
