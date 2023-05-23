<?php
session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=Skillzz;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   die('Erreur : ' . $e->getMessage());
}
$_SESSION['mail']= 'Eric.dupond@gmail.com' ;


$sql=$bdd->prepare("SELECT Distinct nomMatière AS matiere FROM Enseigné WHERE mailP = ? ");
$reponse=$sql->execute(array($_SESSION['mail']));

$sql2=$bdd->prepare("SELECT * FROM Enseigné WHERE mailP = ? ");
$reponse=$sql2->execute(array($_SESSION['mail']));
$j=1;
$classe=array();
while ($donnees = $sql2->fetch()) {
    $classe[$j]=$donnees['numClasse'];
    $j++;
}
$divs = array(
    //PROBLEME ENTRE JS  ET PHP POUR ACTUALISATION
    array('class'=>'detail','id'=>'boutton1','id2' => 'mat1','class2'=>'mat'),
    array('class'=>'detail','id'=>'boutton2','id2' => 'mat2','class2'=>'mat'),
    array('class'=>'detail','id'=>'boutton2','id2' => 'mat3','class2'=>'mat'),
    array('class'=>'detail','id'=>'boutton2','id2' => 'mat4','class2'=>'mat'),
    array('class'=>'detail','id'=>'boutton2','id2' => 'mat5','class2'=>'mat'),
    array('class'=>'detail','id'=>'boutton2','id2' => 'mat6','class2'=>'mat'),
    array('class'=>'detail','id'=>'boutton2','id2' => 'mat7','class2'=>'mat'),
);
$divsComp = array(
    array('compID' => 'comp1','classComp'=>'competence','bouttonID' =>'bouttonE1','eleveG'=>'eleveG1'),
    array('compID' => 'comp2','classComp'=>'competence','bouttonID' =>'bouttonE2','eleveG'=>'eleveG2'),
    array('compID' => 'comp3','classComp'=>'competence','bouttonID' =>'bouttonE3','eleveG'=>'eleveG3'),
    array('compID' => 'comp4','classComp'=>'competence','bouttonID' =>'bouttonE4','eleveG'=>'eleveG4'),
    array('compID' => 'comp5','classComp'=>'competence','bouttonID' =>'bouttonE5','eleveG'=>'eleveG5'),
    array('compID' => 'comp6','classComp'=>'competence','bouttonID' =>'bouttonE6','eleveG'=>'eleveG6'),
);
if(isset($_POST["tous"])){
    if($_POST["tous"] ==1){
        $dateEval= htmlspecialchars($_POST["dateEval"]);
        $matiere = htmlspecialchars($_POST["matiereEval"]);
        $competence = htmlspecialchars($_POST["competenceEval"]);
        $mail = $_SESSION['mail'];
        $tableauJSON = $_POST["eleveMatiere"];
        $eleveEval =json_decode($tableauJSON, true);
        $nbEleve = htmlspecialchars($_POST["nbEleve"]);

        for( $i = $nbEleve ; $i >= 0 ; $i-- ){
            if(isset($eleveEval[$i])){
            
                $eval=$bdd->prepare("SELECT * FROM Evaluation WHERE Matière = ? AND compétence = ? AND demandeur = ? AND receveur = ? ");
                $eval->execute(array($matiere, $competence,$mail,$eleveEval[$i]));

                if($evaluation =$eval->fetch()){
                    $evalE = $bdd->prepare("UPDATE Evaluation SET dateEval = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
                    $evalE->execute(array($dateEval, $matiere, $eleveEval[$i], $competence));
            
                }
                else{
                    $evalE = $bdd->prepare("INSERT INTO Evaluation (demandeur,receveur,compétence,matière,dateEval ) 
                    VALUES (?, ?, ?, ?, ?)");
                    $reponse = $evalE->execute(array($mail, $eleveEval[$i],$competence,$matiere,$dateEval));
                }
            
            }
        }
    }
    else if($_POST["tous"] ==0) {
        $dateEval= htmlspecialchars($_POST["dateEval"]);
        $matiere = htmlspecialchars($_POST["matiereEval"]);
        $competence = htmlspecialchars($_POST["competenceEval"]);
        $mail = $_SESSION['mail'];
        $eleveEval= htmlspecialchars($_POST["eleveMatiere"]);
    
        $evalE = $bdd->prepare("INSERT INTO Evaluation (demandeur,receveur,compétence,matière,dateEval ) 
        VALUES (?, ?, ?, ?, ?)");
        $reponse = $evalE->execute(array($mail, $eleveEval,$competence,$matiere,$dateEval));

    }
    else if($_POST["tous"] ==2){

        $evaluation=htmlspecialchars($_POST["evalP"]);
        $commentaire= htmlspecialchars($_POST["commentaire"]);
        $matiere = htmlspecialchars($_POST["matiere"]);
        $competence = htmlspecialchars($_POST["comp"]);
        $mail = $_SESSION['mail'];
        $eleve= htmlspecialchars($_POST["eleve"]);

        $evalP = $bdd->prepare("UPDATE Evaluation SET evalProf = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
        $evalP->execute(array($evaluation, $matiere, $eleve, $competence));
        $evalP = $bdd->prepare("UPDATE Evaluation SET commentaire = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
        $evalP->execute(array($commentaire, $matiere, $eleve, $competence));

    }

    else if($_POST["tous"] ==3){
        
        $matiere = htmlspecialchars($_POST["matiere"]);
        $competence = htmlspecialchars($_POST["comp"]);
        $mail = $_SESSION['mail'];
        $eleve= htmlspecialchars($_POST["eleve"]);

        $evalP = $bdd->prepare("UPDATE Evaluation SET evalProf = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
        $evalP->execute(array(NULL, $matiere, $eleve, $competence));

        $evalP = $bdd->prepare("UPDATE Evaluation SET commentaire = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
        $evalP->execute(array(NULL, $matiere, $eleve, $competence));
    }

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
    <?php include("headerP.php"); ?>
    <?php include("footerP.php"); ?>
    
    <div>
    <?php
        
        while ($donnees = $sql->fetch() and $row = array_shift($divs)) {
            
            
            $matiere = $donnees['matiere'];
            $comp = $bdd->prepare("SELECT nomComp AS comp , descriptions AS descr FROM Compétence WHERE nomMatière = ? ");
            $reponse1=$comp->execute(array($matiere));

            ?>
            <div class="matiere">

                <p> Matière : <?php echo $donnees['matiere']; ?><br> </p>
                <button id="<?php echo $row['id']; ?>" class="<?php echo $row['class']; ?>">détails</button> 
                <div id="<?php echo $row['id2']; ?>" class="<?php echo $row['class2']; ?>" >
                    <?php
                        while ($donnees2 = $comp->fetch() and $row2 = array_shift($divsComp)) {
                            ?>
                            <div class="competence" id="<?php echo $row2['compID']; ?>">
                                <?php
                                $competence=$donnees2['comp'];
                                $eleve = $bdd->prepare("SELECT * FROM suiviMatière WHERE nomMatière = ? ");
                                $reponse2= $eleve->execute(array($matiere));

                                ?>
                                <p> Compétence : <?php echo $donnees2['comp']; ?><br> </p>
                                <p> Description : <?php echo $donnees2['descr']; ?><br> </p>
                                
                                <button id="<?php echo $row2['bouttonID']; ?>" class="detail">élève</button> 
                                <div id="<?php echo $row2['eleveG']; ?>" class="eleveG" >
                                    <?php


                                    $eleveMatière=array();
                                    $increment=0;

                                    while ($eleveClasse = $eleve->fetch()) {

                                        $classeEleve = $bdd->prepare("SELECT numClasse FROM Elève WHERE mailE = ? ");
                                        $reponse3= $classeEleve->execute(array($eleveClasse['mailE']));

                                        while ($donnee4 = $classeEleve->fetch()) {
                                            for( $i = $j ; $i > 0 ; $i--){
                                                if(isset($classe[$i])){
                                                    if($classe[$i] = $donnee4['numClasse']){
                                                        $eleveMatière[$increment]=strtolower(trim($eleveClasse['mailE']));
                                                        $increment++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    $eleveMatière=array_unique($eleveMatière);
                                    $tableauJSON = json_encode($eleveMatière);
                                    ?>
                                    <form method="post" action="matiereP.php">
                                        <label>Evaluation à tous les élèves:</label><br>
                                        <label>
                                            <input type="date" name="dateEval" required>
                                        </label>
                                        <input type="hidden" name="matiereEval" value= "<?php echo $matiere; ?>">
                                        <input type="hidden" name="competenceEval" value= "<?php echo $competence; ?>">
                                        <input type="hidden" name="eleveMatiere"  value= "<?php echo htmlspecialchars($tableauJSON); ?>">
                                        <input type="hidden" name="nbEleve"  value= "<?php echo $increment; ?>">
                                        <input type="hidden" name="tous"  value= "1">
                                        <input type="submit" name="submit"> 
                                    </form>
                                    <?php
                                    for($i = $increment; $i >= 0 ; $i--){
                                        if(isset($eleveMatière[$i])){
                                            $eval = $bdd->prepare("SELECT * FROM Evaluation WHERE receveur = ? and demandeur = ? and compétence = ?");
                                            $reponse3= $eval->execute(array($eleveMatière[$i],$_SESSION['mail'],$competence));
                                            ?>
                                            <div class="eleve">
                                                <?php
                                                echo $eleveMatière[$i]." ";
                                                if($evaluation = $eval->fetch()){
                                                    ?>
                                                    <p>notation élève :</p><br>
                                                    <?php 
                                                    if($evaluation['evalEleve']== 1){
                                                        ?>
                                                        <div class="barre">
                                                            <span class="non-acquise">Non acquise</span>
                                                        </div>
                                                        <?php
                                                    }
                                                    else if ($evaluation['evalEleve']==2){
                                                        ?>
                                                        <div class="barre">
                                                            <span class="en-cours">en-cours</span>
                                                        </div>
                                                        <?php
                                                    }
                                                    else if ($evaluation['evalEleve']==3){
                                                        ?>
                                                        <div class="barre">
                                                            <span class="acquise">Acquise</span>
                                                        </div>
                                                        <?php
                                                    }
                                                    else if ($evaluation['evalEleve']="NULL"){
                                                        ?>
                                                        <p>pas encore auto-évalué</p><br>
                                                        <?php 
                                                    }

                                                    if($evaluation['dateEval']="NULL" and $evaluation['evalEleve']!= "NULL"){
                                                        ?>
                                                        <p>date: auto-évaluation</p><br>
                                                        <?php 
                                                    }else if($evaluation['dateEval']!="NULL" and $evaluation['evalEleve']!= "NULL"){
                                                        ?>
                                                        <p>date: <?php echo $evaluation['dateEval'];?></p><br>
                                                        <?php 
                                                    }
                                                    ?>
                                                    <p>notation professeur :</p><br>
                                                    <?php 
                                                    if (isset($evaluation['evalProf'])){
                                                        if($evaluation['evalProf']== 1){
                                                            ?>
                                                            <div class="barre">
                                                                <span class="non-acquise">Non acquise</span>
                                                            </div>
                                                            <?php
                                                        }
                                                        else if ($evaluation['evalProf']==2){
                                                            ?>
                                                            <div class="barre">
                                                                <span class="en-cours">en-cours</span>
                                                            </div>
                                                            <?php
                                                        }
                                                        else if ($evaluation['evalProf']==3){
                                                            ?>
                                                            <div class="barre">
                                                                <span class="acquise">Acquise</span>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                        <p>Commentaire prof :</p><br>
                                                        <?php 
                                                        if($evaluation['commentaire']!= null){
                                                            echo htmlspecialchars($evaluation['commentaire']);
                                                        }
                                                        ?>
                                                        <form method="post" action="matiereP.php">
                                                            <input type="hidden" name="matiere" value= "<?php echo $matiere; ?>">
                                                            <input type="hidden" name="comp" value= "<?php echo $competence; ?>">
                                                            <input type="hidden" name="eleve" value= "<?php echo $eleveMatière[$i]; ?>">
                                                            <input type="hidden" name="tous" value= "3">
                                                            <button type="submit">modifier</button>
                                                        </form>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <form method="post" action="matiereP.php">
                                                            <label>votre évaluation:</label><br>
                                                            <label>
                                                                <input type="radio" name="evalP" value="3" checked="checked">
                                                                Acquis
                                                            </label>
                                                            <label>    
                                                                <input type="radio" name="evalP" value="2" >
                                                                En Cours 
                                                            </label>
                                                            <label>    
                                                                <input type="radio" name="evalP" value="1" >
                                                                Non acquis 
                                                            </label>
                                                            <label >
                                                                <input type="text" name="commentaire">
                                                            </label>
                                                            <input type="hidden" name="matiere" value= "<?php echo $matiere; ?>">
                                                            <input type="hidden" name="comp" value= "<?php echo $competence; ?>">
                                                            <input type="hidden" name="eleve" value= "<?php echo $eleveMatière[$i]; ?>">
                                                            <input type="hidden" name="tous" value= "2">
                                                            <input type="submit" name="submit"> 
                                                        </form>
                                                        <?php
                                                    }
                                                    

                                                }
                                                else{
                                                    ?>
                                                        <p>pas de demande d'évaluation ni d'auto évaluation</p><br>
                                                        <form method="post" action="matiereP.php">
                                                            <label>Evaluation à cet élève:</label><br>
                                                            <label>
                                                                <input type="date" name="dateEval" required>
                                                            </label>
                                                            <input type="hidden" name="matiereEval" value= "<?php echo $matiere; ?>">
                                                            <input type="hidden" name="competenceEval" value= "<?php echo $competence; ?>">
                                                            <input type="hidden" name="eleveMatiere"  value= "<?php echo htmlspecialchars($eleveMatière[$i]); ?>">
                                                            <input type="hidden" name="nbEleve"  value= "<?php echo $increment; ?>">
                                                            <input type="hidden" name="tous"  value= "0">
                                                            <input type="submit" name="submit"> 
                                                        </form>
                                                    <?php 
                                                    
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    }
                            ?>
                            </div>
                            <?php
                                
                                    
                            ?><br><br><br>
                        </div><?php
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