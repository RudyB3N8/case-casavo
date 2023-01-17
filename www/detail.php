<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $dbh = new PDO('mysql:host=mysql;port=3306;dbname=casavo', $_SERVER['MYSQL_USER'], $_SERVER['MYSQL_PASSWORD']);

    $sthBien = $dbh->prepare("SELECT * FROM `biens` WHERE id='".$_GET['id']."';");
    $sthBien->execute();
    $bien = $sthBien->fetch();

    // Requete pour afficher les client qui recevront le bien par EMAIL Et par NOTIFICATION
    $sthClient = $dbh->prepare(
        "SELECT c.id, c.nom, c.email ".
        "FROM `critere_client` cc ".
        "INNER JOIN `clients` c ON cc.client_id = c.id ".
        "WHERE ".
            "cc.ville='".$bien['ville']."' AND ".
            "cc.code_postal='".$bien['code_postal']."' AND ".
            "cc.superficie_min <= '".$bien['superficie']."' AND cc.superficie_max >= '".$bien['superficie']."' AND ".
            "cc.prix_min <= '".$bien['prix']."' AND cc.prix_max >= '".$bien['prix']."' AND ".
            "c.status_du_compte=2 AND ".
            "c.envoie_nouveau_bien=? AND c.notif_nouveau_bien=?"
    );
    $sthClient->execute(array(1, 0));
    $clientEmail = $sthClient->fetchAll();
    $sthClient->execute(array(0, 1));
    $clientNotif = $sthClient->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail #<?= $bien['id'] ?> | Casavo Cas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2><a href="/"> < </a>  Bien #<?= $bien['id'] ?></h2>
        <div class="row align-items-end">
            <div class="col">
                <p>Adresse :</p>
            </div>
            <div class="col">
                <p><?= $bien['adresse'].', '.$bien['code_postal'].' '.$bien['ville']; ?></p>
            </div>
        </div>
        <div class="row align-items-end">
            <div class="col">
                <p>Superficie :</p>
            </div>
            <div class="col">
                <p><?= $bien['superficie']; ?> m²</p>
            </div>
            <div class="col">
                <p>Prix :</p>
            </div>
            <div class="col">
                <p><?= number_format($bien['prix'], 0, ',', ' '); ?> €</p>
            </div>
        </div>
        <br>
        <h3>Liste des clients qui seront informer au sujet de ce bien</h3>
        <div class="row justify-content-md-center">
            <div class="col col-lg-6">
                <h3>Par EMAIL</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (count($clientEmail)) {
                                foreach($clientEmail as $row) { ?>
                                    <tr>
                                        <th scope="row"><?= $row['id']; ?></th>
                                        <td><?= $row['nom']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                    </tr>
                                <?php }
                            }else{ ?>
                                <tr>
                                    <th scope="row"></th>
                                    <td> Aucun Clients </td>
                                    <td></td>
                                </tr>
                            <?php }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col col-lg-6">
                <h3>Par NOTIFICATION</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (count($clientNotif)) {
                                foreach($clientNotif as $row) { ?>
                                    <tr>
                                        <th scope="row"><?= $row['id']; ?></th>
                                        <td><?= $row['nom']; ?></td>
                                    </tr>
                                <?php }
                            }else{ ?>
                                <tr>
                                    <th scope="row"></th>
                                    <td> Aucun Clients </td>
                                </tr>
                            <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>