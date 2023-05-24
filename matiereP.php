<?php
session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=Skillzz;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   die('Erreur : ' . $e->getMessage());
}



$sql=$bdd->prepare("SELECT Distinct nomMatière AS matiere FROM Enseigné WHERE mailP = ? ");
$reponse=$sql->execute(array($_SESSION['mailP']));

$sql2=$bdd->prepare("SELECT * FROM Enseigné WHERE mailP = ? ");
$reponse=$sql2->execute(array($_SESSION['mailP']));
$j=1;
$classe=array();
while ($donnees = $sql2->fetch()) {
    $classe[$j]=$donnees['numClasse'];
    $j++;
}

$divs = array();
$divsComp = array();
$index = 1;
foreach (range(1, 100) as $num) {
    $compID = 'comp' . $num;
    $bouttonID = 'bouttonE' . $num;
    $eleveG = 'eleveG' . $num;
    $bouttonModif = 'bouttonModif' . $num;
    $modif = 'Modif' . $num;

    $id='boutton' . $num;
    $id2='mat' . $num;

    $element2 = array(
        'id' => $id,
        'id2' => $id2
    );

    $element = array(
        'compID' => $compID,
        'bouttonID' => $bouttonID,
        'eleveG' => $eleveG,
        'bouttonModif' => $bouttonModif,
        'modif' => $modif
    );

    $divsComp['comp' . $index] = $element;
    $divs['id' . $index] = $element2;
    $index++;
}

if(isset($_POST["tous"])){
    if($_POST["tous"] ==1){
        $dateEval= htmlspecialchars($_POST["dateEval"]);
        $matiere = htmlspecialchars($_POST["matiereEval"]);
        $competence = htmlspecialchars($_POST["competenceEval"]);
        $mail = $_SESSION['mailP'];
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
        $mail = $_SESSION['mailP'];
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
        $mail = $_SESSION['mailP'];
        $eleve= htmlspecialchars($_POST["eleve"]);

        $evalP = $bdd->prepare("UPDATE Evaluation SET evalProf = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
        $evalP->execute(array($evaluation, $matiere, $eleve, $competence));
        $evalP = $bdd->prepare("UPDATE Evaluation SET commentaire = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
        $evalP->execute(array($commentaire, $matiere, $eleve, $competence));

    }

    else if($_POST["tous"] ==3){
        
        $matiere = htmlspecialchars($_POST["matiere"]);
        $competence = htmlspecialchars($_POST["comp"]);
        $mail = $_SESSION['mailP'];
        $eleve= htmlspecialchars($_POST["eleve"]);

        $evalP = $bdd->prepare("UPDATE Evaluation SET evalProf = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
        $evalP->execute(array(NULL, $matiere, $eleve, $competence));

        $evalP = $bdd->prepare("UPDATE Evaluation SET commentaire = ? WHERE matière = ? AND receveur = ? AND compétence = ?");
        $evalP->execute(array(NULL, $matiere, $eleve, $competence));
    }
    else if($_POST["tous"] ==4){
        $matiere = htmlspecialchars($_POST["matiereEval"]);
        $comp = htmlspecialchars($_POST["comp"]);
        $description= htmlspecialchars($_POST["description"]);

        $competence = $bdd->prepare("INSERT INTO Compétence (nomComp,descriptions,nomMatière ) 
        VALUES (?, ?, ?)");
        $reponse = $competence->execute(array($comp, $description,$matiere));

    }
    else if($_POST["tous"] ==5){
        $matiere = htmlspecialchars($_POST["matiereEval"]);
        $oldComp = htmlspecialchars($_POST["oldComp"]);
        $description= htmlspecialchars($_POST["description"]);
        $newComp = htmlspecialchars($_POST["newComp"]);

        $comp = $bdd->prepare("UPDATE Compétence SET nomComp = ? WHERE nomMatière = ? AND nomComp = ?");
        $comp->execute(array($newComp, $matiere, $oldComp));
        $comp = $bdd->prepare("UPDATE Compétence SET descriptions =? WHERE nomMatière = ? AND nomComp = ?");
        $comp->execute(array( $description, $matiere, $oldComp));
        
    }
    else if($_POST["tous"] ==6){

        $note=htmlspecialchars($_POST["pourcentage"]);
        $commentaire= htmlspecialchars($_POST["commentaire"]);
        $competence = htmlspecialchars($_POST["comp"]);
        $eleve= htmlspecialchars($_POST["eleve"]);
    

        $eval=$bdd->prepare("SELECT * FROM Evaluation WHERE Matière ='compT' AND compétence = ?  AND receveur = ? ");
        $eval->execute(array($competence,$eleve));
        $moyenne =0;

        if($evaluation =$eval->fetch()){
            
            if($evaluation['evalProf'] != NULL){
                echo "deja1";
                $moyenne = ($evaluation['evalProf'] + $note)/2;
                
            }
            else{
                echo "non1";
                $moyenne = $note;
                
            }
    
        }
        
        $evalP = $bdd->prepare("UPDATE Evaluation SET evalProf = ? WHERE matière ='compT' AND receveur = ? AND compétence = ?");
        $evalP->execute(array($moyenne, $eleve, $competence));
        $evalP = $bdd->prepare("UPDATE Evaluation SET commentaire = ? WHERE matière ='compT' AND receveur = ? AND compétence = ?");
        $evalP->execute(array($commentaire, $eleve, $competence));
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
                <button id="<?php echo $row['id']; ?>" class="detail full-rounded">détails</button> 
                <div id="<?php echo $row['id2']; ?>" class="mat" >
                    <?php
                        while ($donnees2 = $comp->fetch() and $row2 = array_shift($divsComp)) {
                            ?>
                            <div class="competence" id="<?php echo $row2['compID']; ?>">
                                <?php
                                $competence=$donnees2['comp'];
                                $eleve = $bdd->prepare("SELECT * FROM suiviMatière WHERE nomMatière = ? ");
                                $eleve->execute(array($matiere));

                                $evalAdmin =$bdd->prepare("SELECT * FROM evaluation WHERE compétence = ? and receveur = ?");
                                $evalAdmin->execute(array($competence,$_SESSION['mailP']));
                                

                                ?>
                                <p> Compétence : <?php echo $donnees2['comp']; ?><br> </p>
                                <p> Description : <?php echo $donnees2['descr']; ?><br> </p>
                                <?php
                                if($Admin=$evalAdmin->fetch()){
                                    ?>
                                    <p> A faire évaluer avant le : <?php echo $Admin['dateEval']; ?><br> </p>
                                    <?php
                                }
                                ?>
                                
                                <button id="<?php echo $row2['bouttonID']; ?>" class="detail full-rounded">élève</button>
                                <button id="<?php echo $row2['bouttonModif']; ?>" class="detail full-rounded">Modifier</button> 
                                <div id="<?php echo $row2['modif']; ?>" class="modifier full-rounded">
                                    <form method="post" action="matiereP.php">
                                        <label>Modifier <?php echo $competence ?>:</label><br>
                                        <label>
                                            Nom Compétence:
                                            <input type="text" name="newComp" required>
                                            <br>
                                        </label>
                                        <label>
                                            Description:
                                            <input type="text" name="description" id="description" required>
                                        </label>
                                        <input type="hidden" name="oldComp" value= "<?php echo $competence; ?>">
                                        <input type="hidden" name="matiereEval" value= "<?php echo $matiere; ?>">
                                        <input type="hidden" name="tous"  value= "5">
                                        <input type="submit" name="submit"> 
                                    </form>
                                </div> 
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
                                            $reponse3= $eval->execute(array($eleveMatière[$i],$_SESSION['mailP'],$competence));
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
                            <br><br><br>
                        </div><?php
                        }
                    ?>
                </div>
            </div>

            <div class="ajouter">

            <form method="post" action="matiereP.php">
                <label>Ajouter à <?php echo $matiere ?>:</label><br>
                <label>
                    Nom Compétence:
                    <input type="text" name="comp" required>
                    <br>
                </label>
                <label>
                    Description:
                    <input type="text" name="description" id="description" required>
                </label>
                <input type="hidden" name="matiereEval" value= "<?php echo $matiere; ?>">
                <input type="hidden" name="tous"  value= "4">
                <input type="submit" name="submit"> 
            </form>
            
        </div>  
        <?php 
        }
        ?>
        <div class="transverse">
            <?php
            $matiereEns=$bdd->prepare("SELECT Distinct nomMatière AS matiere FROM Enseigné WHERE mailP = ? ");
            $reponse=$matiereEns->execute(array($_SESSION['mailP']));

            $z=0;
            $j = 0;
            $compT = array(array());
            $tableauEleveMatieres=array();
            $numMat=array();
            $compT=array();
            $compT2=array();
            $compTunique= array(array());
            $compTMatieres = array();

            while ($donnees = $matiereEns->fetch()) {
                $Association = $bdd->prepare("SELECT nomCompT AS nom FROM Association WHERE nomMatière = ? ");
                $reponse1 = $Association->execute(array($donnees['matiere']));

                $eleve = $bdd->prepare("SELECT * FROM suiviMatière WHERE nomMatière = ? ");
                $reponse2= $eleve->execute(array($donnees['matiere']));

                $eleveMatière=array();
                $increment=0;

                while ($eleveClasse = $eleve->fetch()) {
                    $eleveMatière[$increment] = strtolower(trim($eleveClasse['mailE']));
                    $increment++;
                }
 
                $eleveMatière=array_unique($eleveMatière);
                //$tableauJSON = json_encode($eleveMatière);
                $tableauEleveMatieres[$z] = $eleveMatière;
                

                while ($donnees2 = $Association->fetch()) {
                    $compT[$j] = strtolower(trim($donnees2['nom']));
                    
                    $j = $j + 1;
                }
                $z++;
            }

            $compTunique = array_unique($compT);

            /*
            for($i = $j-1;$i>=0 ; $i--){
                if(isset($compT[$i])){
                    $compTunique[$i][0]=$compT[$i];
                    $compTunique[$i][1]=$numMat[$i];
                }
            }
            */
            
            $divsCompT = array();
            $index = 1;
            foreach (range(1, 100) as $num) {

                $id='compT' . $num;
                $id2='mat' . $num;
                $eleveG='eleveT'.$num;
                $bouttonID='bouttonEleveT'.$num;

                $element2 = array(
                    'id' => $id,
                    'id2' => $id2,
                    'eleveG' => $eleveG,
                    'bouttonID'=>$bouttonID
                );

                $divsCompT['id' . $index] = $element2;
                $index++;
            }
            $z=0;
            ?>
            <p> Compétence Transverse<br> </p>
            <button id="bouttonT" class="detail">détails</button> 
            <div class="compTransverse">
                <?php
                for ($i = $j - 1; $i >= 0; $i--) {
                    if(isset($compTunique[$i][0])){
                        $sql3 = $bdd->prepare("SELECT * FROM compTransverse where nomCompT = ? and evalProf = 1");
                        $sql3->execute(array($compTunique[$i]));

                        $matiereCompT =$bdd->prepare("SELECT * FROM association where nomCompT = ? ");
                        $matiereCompT->execute(array($compTunique[$i]));
                        $eleveCompT=array();
                        $eleveCompTunique=array();
                        $increment =0;

                        while ($donnees3 = $matiereCompT->fetch()){

                            $eleve = $bdd->prepare("SELECT * FROM suiviMatière WHERE nomMatière = ? ");
                            $reponse2= $eleve->execute(array($donnees3['nomMatière']));

                            while ($donnees4 = $eleve->fetch()){
                                $eleveCompT[$increment] = strtolower(trim($donnees4['mailE']));
                                $increment++;
                            }
                        }
                        $eleveCompTunique=array_unique($eleveCompT);
                
                        while ($donnees3 = $sql3->fetch() and $row = array_shift($divsCompT)) {
                            ?>
                            <div id="<?php echo $row['id']; ?>" class="compT">
                                <p>Compétence : <?php echo $donnees3['nomCompT']; ?><br> </p>
                                <p>Description : <?php echo $donnees3['description']; ?><br> </p>
                                <button id="<?php echo $row['bouttonID']; ?>" class="detail">élève</button>
                                <div id="<?php echo $row['eleveG']; ?>" class="eleveG">
                                    <?php
                                    for($k = 0; $k <= 20 ; $k++){
                                        if(isset($eleveCompTunique[$k])){
                                            $eval = $bdd->prepare("SELECT * FROM evaluation WHERE receveur = ?  and compétence = ?");
                                            $reponse2= $eval->execute(array($eleveCompTunique[$k],$donnees3['nomCompT']));

                                            ?>
                                            <div class="eleve">
                                                 <?php
                                                echo $eleveCompTunique[$k]." ";
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

                                                    if($evaluation['dateEval']=NULL and $evaluation['evalEleve']!= "NULL"){
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
                                            
                                                        
                                                        if($evaluation['evalProf']<= 33){
                                                        ?>
                                                            <div class="barre">
                                                                <span class="non-acquise">Non acquise</span>
                                                            </div>
                                                            <?php
                                                        }
                                                        else if ($evaluation['evalProf']>=34 and $evaluation['evalProf']<=66){
                                                            ?>
                                                            <div class="barre">
                                                                <span class="en-cours">en-cours</span>
                                                            </div>
                                                            <?php
                                                        }
                                                        else if ($evaluation['evalProf']>=67){
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
                                                            <input type="hidden" name="matiere" value= "compT">
                                                            <input type="hidden" name="comp" value= "<?php echo $donnees3['nomCompT']; ?>">
                                                            <input type="hidden" name="eleve" value= "<?php echo $eleveCompTunique[$k]; ?>">
                                                            <input type="hidden" name="tous" value= "3">
                                                            <button type="submit">ajouter</button>
                                                        </form>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <form method="post" action="matiereP.php">
                                                            <label>votre évaluation:</label><br>
                                                            <input type="range" name="pourcentage" min="0" max="100" step="1"  id="rangeInput">
                                                                <!--<span id="pourcentageValeur"></span>-->
        
                                                            <label >
                                                                <input type="text" name="commentaire">
                                                            </label>
                                                            <input type="hidden" name="matiere" value= "compT">
                                                            <input type="hidden" name="comp" value= "<?php echo $donnees3['nomCompT']; ?>">
                                                            <input type="hidden" name="eleve" value= "<?php echo $eleveCompTunique[$k]; ?>">
                                                            <input type="hidden" name="tous" value= "6">
                                                            <input type="submit" name="submit"> 
                                                        </form>
                                                        <?php
                                                    }
                                                }
                                                else{
                                                    ?>
                                                        <p>pas de demande d'évaluation ni d'auto évaluation</p><br>
                                                    <?php 
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>  
        </div> 

        <button  class="AjouterB">Ajouter</button> 
    </div>
    <footer>
        <?php include("footerP.php"); ?>
    </footer>
</body>

</html>