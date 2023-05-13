<?php
session_start();
try{
    $bdd = new PDO('mysql:host=localhost;dbname=Skillzz;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   die('Erreur : ' . $e->getMessage());
}
$_SESSION['mail']= "tom.cruise@gmail.com" ;

$reponse = $bdd->query('SELECT nomMatière AS matiere FROM suiviMatière WHERE mailE = '$_SESSION['mail']' ');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header> 
        <p>rfzzfze </p>
    </header>
    <div>
    <?php
        while ($donnees = $reponse->fetch()) {
            ?>
            <p>
            Matière : <?php echo $donnees['matiere']; ?>,<br> 
            </p> <?php
            }
    ?>

    </div>

</body>

</html>