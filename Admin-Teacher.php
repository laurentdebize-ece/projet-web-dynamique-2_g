<?php

session_start();

function getDatabaseConnection()
{
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=skillzz;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getAllUsers()
{
    $bdd = getDatabaseConnection();
    $requete = 'SELECT * FROM prof';
    $rows = $bdd->query($requete);
    return $rows;
}

// function readUser($mail)
// {
//     $bdd = getDatabaseConnection();
//     $requete = "SELECT * FROM elève WHERE mailE = '$mail'";
//     $stmt = $bdd->query($requete);
//     $rows = $stmt->fetchAll();
//     if (!empty($rows)) {
//         return $rows[0];
//     }
// }

function createUser($nom, $prenom, $mail, $mdp)
{
    try {
        $bdd = getDatabaseConnection();
        $requete = "INSERT INTO prof VALUES ('$nom', '$prenom', '$mail', '$mdp')";
        $stmt = $bdd->query($requete);
    } catch (PDOException $e) {
        echo $requete . "<br>" . $e->getMessage();
    }
}

function updateUser($nom, $prenom, $mail, $mdp)
{
    try {
        $bdd = getDatabaseConnection();
        $requete = "UPDATE elève SET nom = '$nom', prénom = '$prenom', mailP = '$mail', mdp = '$mdp' WHERE mailP = '$mail'";
        $stmt = $bdd->query($requete);
    } catch (PDOException $e) {
        echo $requete . "<br>" . $e->getMessage();
    }
}

function deleteUser($mail)
{
    try {
        $mailAdmin = $_SESSION['mailA'];
        $bdd = getDatabaseConnection();
        $requete1 = "DELETE FROM prof WHERE mailP = '$mail'";
        $requete2 = "DELETE FROM enseigné WHERE mailP = '$mail'";
        $requete3 = "UPDATE evaluation SET demandeur = '$mailAdmin' WHERE demandeur = '$mail'";
        $stmt1 = $bdd->query($requete1);
        $stmt2 = $bdd->query($requete2);
        $stmt3 = $bdd->query($requete3);
    } catch (PDOException $e) {
        echo $requete1 . "<br>" . $e->getMessage();
        echo $requete2 . "<br>" . $e->getMessage();
        echo $requete3 . "<br>" . $e->getMessage();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers</title>
    <link rel="stylesheet" href="Table.css">
</head>

<body>

    <?php
    if (isset($_POST["email-delete"])) {
        deleteUser($_POST["email-delete"]);
    }
    if (isset($_POST['maListeCla']) && isset($_POST['maListeMat']) && isset($_POST['teacher-add-name']) && isset($_POST['teacher-add-firstname']) && isset($_POST['teacher-add-email']) && isset($_POST['teacher-add-password'])) {
        $bdd = getDatabaseConnection();
        $email = $_POST['teacher-add-email'];
        $requete = "SELECT mailP FROM prof WHERE mailP = '$email'";
        $stmt = $bdd->query($requete);
        $classeSelect = $_POST['maListeCla'];
        $matSelect = $_POST['maListeMat'];
        if ($stmt->rowCount() > 0) {
            foreach ($classeSelect as $option) {
                $requete2 = "INSERT INTO enseigné VALUES ('$email', '$option', '$matSelect[0]')";
                $stmt2 = $bdd->query($requete2);
            }
        } else {
            createUser($_POST['teacher-add-name'], $_POST['teacher-add-firstname'], $_POST['teacher-add-email'], $_POST['teacher-add-password']);
            foreach ($classeSelect as $option) {
                $requete2 = "INSERT INTO enseigné VALUES ('$email', '$option', '$matSelect[0]')";
                $stmt2 = $bdd->query($requete2);
            }
        }
    }
    $users = getAllUsers();
    ?>

    <div id="back">
        <svg width="30px" height="30px" viewBox="0 0 24 24" stroke-width="1.5" fill="none"
            xmlns="http://www.w3.org/2000/svg" color="#000000">
            <path d="M13 8.5L9.5 12l3.5 3.5" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                stroke-linejoin="round"></path>
            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" stroke="#000000"
                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>

    <div class="table-container" id="table">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Mail</th>
                    <th>Mdp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $ligne): ?>
                    <tr>
                        <td>
                            <?php echo $ligne['nom']; ?>
                        </td>
                        <td>
                            <?php echo $ligne['prénom']; ?>
                        </td>
                        <td>
                            <?php echo $ligne['mailP']; ?>
                        </td>
                        <td>
                            <?php echo $ligne['mdp']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="btn-container">
        <button class="Btn" id="f-edit">Edit
            <svg id="edit" class="svg" viewBox="0 0 512 512">
                <path
                    d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                </path>
            </svg>
        </button>
        <button class="Btn" id="f-add">Add
            <svg id="add" class="svg" width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="white"
                xmlns="http://www.w3.org/2000/svg" color="#ffffff">
                <path d="M6 12h6m6 0h-6m0 0V6m0 6v6" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </button>
        <button class="Btn" id="f-delete">Delete
            <svg id="delete" class="svg" width="24px" height="24px" viewBox="0 0 24 24" stroke-width="1.5" fill="none"
                xmlns="http://www.w3.org/2000/svg" color="#000000">
                <path
                    d="M20 9l-1.995 11.346A2 2 0 0116.035 22h-8.07a2 2 0 01-1.97-1.654L4 9M21 6h-5.625M3 6h5.625m0 0V4a2 2 0 012-2h2.75a2 2 0 012 2v2m-6.75 0h6.75"
                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>

    <form id="form-delete" action="Admin-Teacher.php" method="post">
        <div class="subscribe">
            <p>DELETE</p>
            <input placeholder="E-mail" class="subscribe-input" name="email-delete" type="email">
            <br>
            <button type="submit" class="submit-btn">ENTER</button>
            <svg class="close-btn" width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg" color="#000000">
                <path
                    d="M9.879 14.121L12 12m2.121-2.121L12 12m0 0L9.879 9.879M12 12l2.121 2.121M21 3.6v16.8a.6.6 0 01-.6.6H3.6a.6.6 0 01-.6-.6V3.6a.6.6 0 01.6-.6h16.8a.6.6 0 01.6.6z"
                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
    </form>

    <form id="form-add" action="Admin-Teacher.php" method="post">
        <div class="subscribe">
            <p>ADD</p>
            <input placeholder="Name" class="subscribe-input" name="teacher-add-name" type="text">
            <input placeholder="First name" class="subscribe-input" name="teacher-add-firstname" type="text">
            <input placeholder="E-mail" class="subscribe-input" name="teacher-add-email" type="email">
            <input placeholder="Password" class="subscribe-input" name="teacher-add-password" type="text"><br><br>
            <div class="listeDerou">
                <label for="maListeMat">Associated subjects :</label>
                <select id="maListeMat" name="maListeMat[]">
                    <?php
                    $bdd = getDatabaseConnection();
                    $requete = $bdd->query("SELECT nomMatière FROM matière");
                    while ($option = $requete->fetch()) {
                        echo '<option value="' . $option['nomMatière'] . '">' . $option['nomMatière'] . '</option>';
                    }
                    ?>
                </select>
            </div><br>
            <div class="listeDerou">
                <label for="maListeCla">Associated groups :</label>
                <select id="maListeCla" name="maListeCla[]" multiple>
                    <?php
                    $bdd = getDatabaseConnection();
                    $requete = $bdd->query("SELECT numClasse FROM classe");
                    while ($option = $requete->fetch()) {
                        echo '<option value="' . $option['numClasse'] . '">' . $option['numClasse'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="submit-btn">ENTER</button>
            <svg class="close-btn" width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg" color="#000000">
                <path
                    d="M9.879 14.121L12 12m2.121-2.121L12 12m0 0L9.879 9.879M12 12l2.121 2.121M21 3.6v16.8a.6.6 0 01-.6.6H3.6a.6.6 0 01-.6-.6V3.6a.6.6 0 01.6-.6h16.8a.6.6 0 01.6.6z"
                    stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </div>
    </form>

    <script src="admin_tabs.js"></script>
    <script src="admin-teacher.js"></script>

</body>

</html>