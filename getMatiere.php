<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=Skillzz;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$prof = $_GET['prof'];

$sql = $bdd->prepare("SELECT distinct nomMatière AS matiere FROM enseigné WHERE mailP = ? ");
$sql->execute(array($prof));
$matieres = array();
$increment = 0;

while ($donnees = $sql->fetch()) {
    $matiere = $donnees['matiere'];
    $comp = $bdd->prepare("SELECT distinct nomComp AS comp  FROM Compétence WHERE nomMatière = ? ");
    $comp->execute(array($matiere));
    while ($donnees2 = $comp->fetch()) {
        $matieres[$increment] = $donnees2['comp'];
        $increment++;
    }
}

header('Content-Type: application/json');
echo json_encode($matieres);
?>
