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
$reponse=$sql->execute(array($_SESSION['mail']));

if(isset($_POST["evalE"])){
    $evaluation= htmlspecialchars($_POST["evalE"]);
    $matiere = htmlspecialchars($_POST["matiere"]);
    $competence = htmlspecialchars($_POST["comp"]);
    $mail = $_SESSION['mail'];
    
    $evalE = $bdd->prepare("UPDATE Evaluation SET evalEleve = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
    $reponse = $evalE->execute(array($evaluation, $matiere, $mail, $competence));

}

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
        
    </header>
    <div>
    <?php
    $divs = array(
        array('id2' => 'comp1','class2'=>'competence','class'=>'detail','id'=>'boutton1','class3'=>'barreE','id3'=>'barreE1',
        'class4'=>'','id4'=>'boutton1','class5'=>'detail','id5'=>'boutton1'),

        array('id2' => 'comp2','class2'=>'competence','class'=>'detail','id'=>'boutton2'),
        array('id2' => 'comp3','class2'=>'competence','class'=>'detail','id'=>'boutton2'),
        array('id2' => 'comp4','class2'=>'competence','class'=>'detail','id'=>'boutton2'),
        array('id2' => 'comp5','class2'=>'competence','class'=>'detail','id'=>'boutton2'),
        array('id2' => 'comp6','class2'=>'competence','class'=>'detail','id'=>'boutton2'),
        array('id2' => 'comp7','class2'=>'competence','class'=>'detail','id'=>'boutton2'),
    );
        
        while ($donnees = $sql->fetch() and $row = array_shift($divs)) {
        
            $matiere = $donnees['matiere'];
            $comp = $bdd->prepare("SELECT nomComp AS comp , descriptions AS descr FROM Compétence WHERE nomMatière = ? ");
            $reponse1=$comp->execute(array($matiere));

            ?>
            <div class="matiere" >
                <p> Matière : <?php echo $donnees['matiere']; ?><br> </p>

                <button id="<?php echo $row['id']; ?>" class="<?php echo $row['class']; ?>">détails</button> 

                <div id="<?php echo $row['id2']; ?>" class="<?php echo $row['class2']; ?>">
                    <?php
                        while ($donnees2 = $comp->fetch()) {
                            $competence=$donnees2['comp'];
                            $eval = $bdd->prepare("SELECT * FROM Evaluation WHERE matière = ?  AND receveur = ? AND compétence = ?");
                            $reponse2= $eval->execute(array($matiere, $_SESSION['mail'], $donnees2['comp']));
                            ?>
                            <p> Compétence : <?php echo $donnees2['comp']; ?><br> </p>
                            <p> Description : <?php echo $donnees2['descr']; ?><br> </p>
                            <?php
                                while ($donnees3 = $eval->fetch()){
                                    if($donnees3['dateEval'] != null){
                                        ?>
                                        <?php
                                        if($donnees3['evalEleve']!= null){
                                            ?>
                                            <div class="barre">
                                                <span class="acquise">Acquise</span>
                                                span class="en-cours">En cours</span>
                                                <span class="non-acquise">Non acquise</span>
                                            </div>
                                            <?php
                                        }
                                        if($donnees3['evalEleve']==NULL){
                                            ?>
                                            <form method="post" action="matiere.php">
                                                <label>votre évaluation:</label><br>
                                                <label>
                                                    <input type="radio" name="evalE" value="3" checked="checked">
                                                    Acquis
                                                </label>
                                                <label>    
                                                    <input type="radio" name="evalE" value="2" >
                                                    En Cours 
                                                </label>
                                                <label>    
                                                    <input type="radio" name="evalE" value="1" >
                                                    Non acquis 
                                                </label>
                                                <input type="hidden" name="matiere" value= "<?php echo $matiere; ?>">
                                                <input type="hidden" name="comp" value= "<?php echo $competence; ?>">
                                                <input type="submit" name="submit"> 
                                            </form>
                                            <?php
                                        }
                                        ?> 
                                    <?php
                                    }
                                }
                                ?>
                                <br><br>
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