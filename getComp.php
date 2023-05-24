<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=Skillzz;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$eleve = $_GET['eleve'];

$sql = $bdd->prepare("SELECT distinct nomMatière AS matiere FROM suiviMatière WHERE mailE = ? ");
$sql->execute(array($eleve));

$competence = array();
$increment =0;

while ($donnees = $sql->fetch()) {
    $donnees['matiere'];

    $comp = $bdd->prepare("SELECT distinct nomCompT AS comp FROM Association WHERE nomMatière = ? ");
    $comp->execute(array($donnees['matiere']));
    while ($donnees2 = $comp->fetch()) {
        $competence[$increment] = $donnees2['comp'];
        $increment++;
    }
}
//$competence = array_unique($competence);

header('Content-Type: application/json');
echo json_encode($competence);
?>