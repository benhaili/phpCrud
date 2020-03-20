<?php
    session_start();
    require_once 'conection.php';
    if (!isset($_SESSION['User'])) {
        header('location:login.php');
    } else {?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <title>index.php</title>

</head>

<body>

    <?php $port = 3306;
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'programmation-web-3';
    $mysqli = mysqli_connect($host, $user, $pass, $db, $port);

    mysqli_set_charset($mysqli, 'utf8');

    if (mysqli_connect_errno()) {
        echo 'Erreur de connection au serveur MySQL: ('.$mysqli->connect_errno.') '.$mysqli->connect_error;
        exit;
    }

    $sql = 'SELECT * FROM `tp_user`';

    $result = mysqli_query($con, $sql);

    if (!$result) {
        $error = mysqli_error($mysqli);
    }

    $usager = [];
    while ($listusagers = mysqli_fetch_assoc($result)) {
        array_push($usager, $listusagers);
    }

    mysqli_free_result($result);

    mysqli_close($mysqli);

    ?>
    <div class="container">


        <ul class="thead-dark">
            <li>MySQL User Form</li>
            <li><a href="form.php">ajouter</a></li>
        </ul>


        <table class="table table-bordered">

            <tr>
                <th scope="col">Prenom</th>
                <th scope="col">Nom</th>
                <th scope="col">Courriel</th>
                <th scope="col">Date de creation</th>
                <th scope="col">Date de modification</th>
                <th scope="col"></th>
            </tr>

            <?php foreach ($usager as $userinfo): ?>
            <tr>

                <td><?=$userinfo['firstName']; ?>
                </td>
                <td><?=$userinfo['lastName']; ?>
                </td>
                <td><?=$userinfo['email']; ?>
                </td>
                <td><?=$userinfo['creationDate']; ?>
                </td>
                <td><?=$userinfo['modificationDate']; ?>
                </td>
                <td><a href="form.php?modifier=<?=$userinfo['id']; ?>"><i class="fas fa-pen-square"></i></a>
                </td>
                <td><a href="actions.php?supprimer=<?=$userinfo['id']; ?>"><i class="fas fa-minus-square"></i></a>
                </td>
            </tr>

            <?php endforeach; ?>

        </table>
    </div>

</body>

</html>
<?php }
