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
$_SESSION['classe']='1';

$sql=$bdd->prepare("SELECT nomMatière AS matiere FROM suiviMatière WHERE mailE = ? ");
$reponse=$sql->execute(array($_SESSION['mail']));

if(isset($_POST["evalE"])){
    $evaluation= htmlspecialchars($_POST["evalE"]);
    $matiere = htmlspecialchars($_POST["matiere"]);
    $competence = htmlspecialchars($_POST["comp"]);
    $mail = $_SESSION['mail'];

    if($_POST["auto"]==0){
        $evalE = $bdd->prepare("UPDATE Evaluation SET evalEleve = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
        $reponse = $evalE->execute(array($evaluation, $matiere, $mail, $competence));
    }
    else{
        $prof=$bdd->prepare("SELECT * FROM Enseigné WHERE nomMatière = ? AND numClasse = ? ");
        $reponse=$evalE->execute(array($matiere, $_SESSION['classe']));
        while($donnees=$prof->fetch()){
            $mailP=$donnees['mailP'];
        }
        $evalE = $bdd->prepare("INSERT INTO Evaluation (demandeur,receveur,compétence,matière,evalEleve ) 
        VALUES (?, ?, ?, ?, ?)");
        $reponse = $evalE->execute(array($mailP, $mail,$competence,$matiere,$evaluation));
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
    <header> 
        <p>nvevdf
        </p>
    </header>
    <div>
    <?php

    $divs = array(
        array('class'=>'detail','id'=>'boutton1','id2' => 'mat1','class2'=>'mat'),
        array('class'=>'detail','id'=>'boutton2','id2' => 'mat2','class2'=>'mat'),
        array('class'=>'detail','id'=>'boutton2','id2' => 'mat3','class2'=>'mat'),
        array('class'=>'detail','id'=>'boutton2','id2' => 'mat4','class2'=>'mat'),
        array('class'=>'detail','id'=>'boutton2','id2' => 'mat5','class2'=>'mat'),
        array('class'=>'detail','id'=>'boutton2','id2' => 'mat6','class2'=>'mat'),
        array('class'=>'detail','id'=>'boutton2','id2' => 'mat7','class2'=>'mat'),
    );
        
        while ($donnees = $sql->fetch() and $row = array_shift($divs)) {
            /*
            $divsComp = array(
                array('compID' => 'comp1','classComp'=>'competence'),
                array('compID' => 'comp2','classComp'=>'competence'),
                array('compID' => 'comp3','classComp'=>'competence'),
                array('compID' => 'comp4','classComp'=>'competence'),
                array('compID' => 'comp5','classComp'=>'competence'),
                array('compID' => 'comp6','classComp'=>'competence'),
                array('compID' => 'comp7','classComp'=>'competence'),
            );
            */
            $matiere = $donnees['matiere'];
            $comp = $bdd->prepare("SELECT nomComp AS comp , descriptions AS descr FROM Compétence WHERE nomMatière = ? ");
            $reponse1=$comp->execute(array($matiere));

            ?>
            <div class="matiere">
                <p> Matière : <?php echo $donnees['matiere']; ?><br> </p>
                <button id="<?php echo $row['id']; ?>" class="<?php echo $row['class']; ?>">détails</button> 
                <div id="<?php echo $row['id2']; ?>" class="<?php echo $row['class2']; ?>" >
                    <?php
                        while ($donnees2 = $comp->fetch() ) {
                            ?>
                            <div class="competence1">
                                <?php
                                $competence=$donnees2['comp'];
                                $eval = $bdd->prepare("SELECT * FROM Evaluation WHERE matière = ?  AND receveur = ? AND compétence = ?");
                                $reponse2= $eval->execute(array($matiere, $_SESSION['mail'], $donnees2['comp']));
                                ?>
                                <p> Compétence : <?php echo $donnees2['comp']; ?><br> </p>
                                <p> Description : <?php echo $donnees2['descr']; ?><br> </p>
                                <?php
            
                                    if(($donnees3 = $eval->fetch())!=null){

                                        if($donnees3['dateEval'] != null){
                                            ?>
                                            <?php
                                            if($donnees3['evalEleve']!= null){
                                                ?>
                                                <p>notation élève :</p><br>
                                                <?php 
                                                if($donnees3['evalEleve']== 1){
                                                    ?>
                                                    <div class="barre">
                                                        <span class="non-acquise">Non acquise</span>
                                                    </div>
                                                    <?php
                                                }
                                                else if ($donnees3['evalEleve']==2){
                                                    ?>
                                                    <div class="barre">
                                                        <span class="en-cours">en-cours</span>
                                                    </div>
                                                    <?php
                                                }
                                                else if ($donnees3['evalEleve']==3){
                                                    ?>
                                                    <div class="barre">
                                                        <span class="acquise">Acquise</span>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <p>date butoir:</p> <?php 
                                                echo htmlspecialchars($donnees3['dateEval']); 
                                            }
                                            if($donnees3['evalEleve']==NULL){
                                                ?>
                                                <form method="post" action="matiereE.php">
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
                                                    <input type="hidden" name="auto" value= "0">
                                                    <input type="submit" name="submit"> 
                                                </form>
                                                <p>date butoir:</p> <?php 
                                                echo htmlspecialchars($donnees3['dateEval']); 
                                            }
                                        }
                                    }
                            
                                else{
                                    ?>
                                    <form method="post" action="matiereE.php">
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
                                        <input type="hidden" name="auto" value= "1">
                                        <input type="submit" name="submit"> 
                                    </form>
                                    <?php
                                }
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