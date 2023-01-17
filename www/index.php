<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casavo Cas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>    
    <div class="container">
        <h3>Biens</h3>
        <div class="row justify-content-md-center">
            <div class="col col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Superficie (m²)</th>
                            <th scope="col">Prix (€)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dbh = new PDO('mysql:host=mysql;port=3306', $_SERVER['MYSQL_USER'], $_SERVER['MYSQL_PASSWORD']);
                            foreach($dbh->query("SELECT * FROM `casavo`.`biens`") as $row) { ?>
                                <tr>
                                    <th scope="row"><?= $row['id']; ?></th>
                                    <td><a href="/detail.php?id=<?= $row['id']; ?>"><?= $row['adresse'].',<br>'.$row['code_postal'].' '.$row['ville']; ?></a></td>
                                    <td><?= $row['superficie']; ?></td>
                                    <td><?= number_format($row['prix'], 0, ',', ' '); ?></td>
                                </tr>
                            <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>Clients</h3>
        <div class="row justify-content-md-center">
            <div class="col col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Envoie nouveau bien</th>
                            <th scope="col">Notif nouveau bien</th>
                            <th scope="col">Status du compte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dbh = new PDO('mysql:host=mysql;port=3306', $_SERVER['MYSQL_USER'], $_SERVER['MYSQL_PASSWORD']);
                            foreach($dbh->query("SELECT * FROM `casavo`.`clients`") as $row) { ?>
                                <tr>
                                    <th scope="row"><?= $row['id']; ?></th>
                                    <td><?= $row['nom']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= ($row['envoie_nouveau_bien'])?'<span class="badge bg-primary">Oui</span>':'<span class="badge bg-danger">Non</span>'; ?></td>
                                    <td><?= ($row['notif_nouveau_bien'])?'<span class="badge bg-primary">Oui</span>':'<span class="badge bg-danger">Non</span>'; ?></td>
                                    <td>
                                        <?php
                                            switch ($row['status_du_compte']) {
                                                case 1: ?>
                                                    <span class="badge bg-info">Compte non finalisé</span>
                                                    <?php break;

                                                case 2: ?>
                                                    <span class="badge bg-success">Compte Valide</span>
                                                    <?php break;

                                                case 3: ?>
                                                    <span class="badge bg-warning">Compte Erreur</span>
                                                    <?php break;

                                                default:
                                                    echo $row['status_du_compte'];
                                                    break;
                                            }
                                        ?>
                                    </td>
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