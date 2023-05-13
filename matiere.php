<?php
session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=Skillzz;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   die('Erreur : ' . $e->getMessage());
}
$_SESSION['mail']= 'paul.richard@gmail.com' ;

$sql=$bdd->prepare("SELECT nomMatière AS matiere FROM suiviMatière WHERE mailE = ? ");
$reponse=$sql->execute(array($_SESSION['mail']))

//$reponse = $bdd->query("SELECT nomMatière AS matiere FROM suiviMatière WHERE mailE = '".$_SESSION['mail']."'");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cssMatiere.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="scriptMatiere.js"></script>
    <title>Document</title>
</head>

<body>
    <header> 
        <p>rfzzfze </p>
    </header>
    <div>
    <?php
    $divs = array(
        array('id' => 'comp1','class'=>'competence','class2'=>'detail','id2'=>'boutton1'),
        array('id' => 'comp2','class'=>'competence','class2'=>'detail','id2'=>'boutton2'),
        array('id' => 'comp3','class'=>'competence','class2'=>'detail','id2'=>'boutton2'),
        array('id' => 'comp4','class'=>'competence','class2'=>'detail','id2'=>'boutton2'),
        array('id' => 'comp5','class'=>'competence','class2'=>'detail','id2'=>'boutton2'),
        array('id' => 'comp6','class'=>'competence','class2'=>'detail','id2'=>'boutton2'),
        array('id' => 'comp7','class'=>'competence','class2'=>'detail','id2'=>'boutton2'),
    );
        
        while ($donnees = $sql->fetch() and $row = array_shift($divs)) {
        
            $matiere = $donnees['matiere'];
            $comp = $bdd->prepare("SELECT nomComp AS comp , descriptions AS descr FROM Compétence WHERE nomMatière = ? ");
            $reponse1=$comp->execute(array($matiere));
            ?>

            <div class="matiere" >
                <p> Matière : <?php echo $donnees['matiere']; ?><br> </p>

                <button id="<?php echo $row['id2']; ?>" class="<?php echo $row['class2']; ?>">détails</button> 

                <div id="<?php echo $row['id']; ?>" class="<?php echo $row['class']; ?>">
                    <?php
                        while ($donnees2 = $comp->fetch()) {
                            ?>
                            <p> Compétence : <?php echo $donnees2['comp']; ?><br> </p>
                            <p> Description : <?php echo $donnees2['descr']; ?><br> </p> 
                            <?php
                        }
                        ?>
                </div>
            </div>

            <?php 
            }
    ?>

    </div>

</body>

</html>