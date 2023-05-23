<?php

function getDatabaseConnection()
{
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=skillzz;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

function getAllComp()
{
    $bdd = getDatabaseConnection();
    $requete = 'SELECT * FROM compétence';
    $rows = $bdd->query($requete);
    return $rows;
}

function getAllCompTrans()
{
    $bdd = getDatabaseConnection();
    $requete = 'SELECT * FROM comptransverse';
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

function createComp($comp, $descri, $mat)
{
    try {
        $bdd = getDatabaseConnection();
        $requete = "INSERT INTO compétence (nomComp, descriptions, nomMatière) VALUES ('$comp', '$descri', '$mat')";
        $stmt = $bdd->query($requete);
    } catch (PDOException $e) {
        echo $requete . "<br>" . $e->getMessage();
    }
}

function createCompT($compT, $descri)
{
    try {
        $bdd = getDatabaseConnection();
        $eval = 0;
        $requete1 = "INSERT INTO comptransverse VALUES ('$compT', '$descri', '$eval')";
        $stmt = $bdd->query($requete1);
    } catch (PDOException $e) {
        echo $requete1 . "<br>" . $e->getMessage();
    }
}

// function updateUser($nom, $prenom, $mail, $mdp, $ecole, $numClasse)
// {
//     try {
//         $bdd = getDatabaseConnection();
//         $requete = "UPDATE elève SET nom = '$nom', prenom = '$prenom', mailE = '$mail', mdp = '$mdp', ecole = '$ecole', numClasse = '$numClasse'";
//         $stmt = $bdd->query($requete);
//     } catch (PDOException $e) {
//         echo $requete . "<br>" . $e->getMessage();
//     }
// }

// function deleteUser($skillzz)
// {
//     try {
//         $bdd = getDatabaseConnection();
//         $requete = "DELETE FROM compétence WHERE nomComp = '$skillzz'";
//         $stmt = $bdd->query($requete);
//     } catch (PDOException $e) {
//         echo $requete . "<br>" . $e->getMessage();
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillzz</title>
    <link rel="stylesheet" href="Table.css">
</head>

<body>

    <?php
    if (isset($_POST['maListe']) && isset($_POST['skillzz-add-name']) && isset($_POST['skillzz-add-descri'])) {
        $optionsSelect = $_POST['maListe'];

        if (count($optionsSelect) > 1) {
            createCompT($_POST['skillzz-add-name'], $_POST['skillzz-add-descri']);
            $compName = $_POST['skillzz-add-name'];
            foreach ($optionsSelect as $option) {
                $bdd = getDatabaseConnection();
                $requete = "INSERT INTO association VALUES ('$compName', '$option')";
                $stmt = $bdd->query($requete);
            }
        } else {
            createComp($_POST['skillzz-add-name'], $_POST['skillzz-add-descri'], $optionsSelect[0]);
        }
    }
    $comp = getAllComp();
    $comp_trans = getAllCompTrans();
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

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Compétence</th>
                    <th>Description</th>
                    <th>Matière associée</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comp as $ligne): ?>
                    <tr>
                        <td>
                            <?php echo $ligne['nomComp']; ?>
                        </td>
                        <td>
                            <?php echo $ligne['descriptions']; ?>
                        </td>
                        <td>
                            <?php echo $ligne['nomMatière']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <table>
            <thead>
                <tr>
                    <th>Compétence Transverse</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comp_trans as $ligne): ?>
                    <tr>
                        <td>
                            <?php echo $ligne['nomCompT']; ?>
                        </td>
                        <td>
                            <?php echo $ligne['description']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="btn-container">
        <!-- <button class="Btn" id="f-edit">Edit
            <svg id="edit" class="svg" viewBox="0 0 512 512">
                <path
                    d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                </path>
            </svg>
        </button> -->
        <button class="Btn" id="f-add">Add
            <svg id="add" class="svg" width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="white"
                xmlns="http://www.w3.org/2000/svg" color="#ffffff">
                <path d="M6 12h6m6 0h-6m0 0V6m0 6v6" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
        </button>
    </div>

    <form id="form-add" action="Admin-Skillzz.php" method="post">
        <div class="subscribe">
            <p>ADD</p>
            <input placeholder="Skillzz" class="subscribe-input" name="skillzz-add-name" type="text">
            <input placeholder="Description" class="subscribe-input" name="skillzz-add-descri" type="text"><br><br>
            <div class="listeDerou">
                <label for="maListe">Associated subjects :</label>
                <select id="maListe" name="maListe[]" multiple>
                    <?php
                    $bdd = getDatabaseConnection();
                    $requete = $bdd->query("SELECT nomMatière FROM matière");
                    while ($option = $requete->fetch()) {
                        echo '<option value="' . $option['nomMatière'] . '">' . $option['nomMatière'] . '</option>';
                    }
                    ?>
                </select>
            </div>
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

    <script src="admin_tabs.js"></script>
    <script src="admin-skillzz.js"></script>

</body>

</html>