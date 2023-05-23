<?php
session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=Skillzz;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   die('Erreur : ' . $e->getMessage());
}


$sql=$bdd->prepare("SELECT distinct nomMatière AS matiere FROM enseigné WHERE mailP = ? ");
$sql->execute(array($_SESSION['mailP']));
$tabComp=array(array());
$increment=0;

while ($donnees = $sql->fetch() ) {
    $matiere = $donnees['matiere'];
    $comp = $bdd->prepare("SELECT distinct nomComp AS comp , descriptions AS descr FROM Compétence WHERE nomMatière = ? ");
    $comp->execute(array($matiere));
    while($donnees2 = $comp->fetch()){
        $tabComp[$increment][0]=$donnees2['comp'];
        $tabComp[$increment][1]=$matiere;
        $tabComp[$increment][2]=$donnees2['descr'];

        $sql2=$bdd->prepare("SELECT * FROM evaluation WHERE demandeur = ? and compétence = ? ");
        $sql2->execute(array($_SESSION['mailP'],$donnees2['comp']));

        while ($donnees2 = $sql2->fetch() ) {
            $tabComp[$increment][3]=$donnees2['demandeur'];
            $tabComp[$increment][4]=$donnees2['dateEval'];
            $tabComp[$increment][5]=$donnees2['evalEleve'];
            $tabComp[$increment][6]=$donnees2['evalProf'];
        }
        $increment++;
    }
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

function affichage($tabComp){
    foreach($tabComp as $row){
        ?>
        <div class="competence">
            <?php
            if(isset($row[0])){
                ?>
                <p> Compétence : <?php echo $row[0]; ?><br> </p>
                <p> Description : <?php echo $row[2]; ?><br> </p>
                <p> Matière : <?php echo $row[1]; ?><br> </p>
                <?php
            }
            if(isset($row[4])){
                ?>
                <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                <?php
            }
            if(isset($row[3])){
                ?>
                <p> Demandeur : <?php echo $row[3]; ?><br> </p>
                <?php
            }
            if(isset($row[5])){
                ?>
                <p> Eval eleve : <br> </p>
                <?php
                if($row[5]== 1){
                    ?>
                    <div class="barre">
                        <span class="non-acquise">Non acquise</span>
                    </div>
                    <?php
                }
                else if ($row[5]==2){
                    ?>
                    <div class="barre">
                        <span class="en-cours">en-cours</span>
                    </div>
                    <?php
                }
                else if ($row[5]==3){
                    ?>
                    <div class="barre">
                        <span class="acquise">Acquise</span>
                    </div>
                    <?php
                }
            }    
            if(isset($row[6])){
                ?>
                <p> Eval Prof : <br> </p>
                <?php
                if($row[6]== 1){
                    ?>
                    <div class="barre">
                        <span class="non-acquise">Non acquise</span>
                    </div>
                    <?php
                }
                else if ($row[6]==2){
                    ?>
                    <div class="barre">
                        <span class="en-cours">en-cours</span>
                    </div>
                    <?php
                }
                else if ($row[6]==3){
                    ?>
                    <div class="barre">
                        <span class="acquise">Acquise</span>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php    
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
    <title>Compétences</title>
</head>

<body>

    <?php include("headerP.php"); ?>
    <?php include("footerP.php"); ?>

    <div class="container">
        <form action="competenceP.php" method="post" class="card">
            <button type="submit" name="tri" value='NULL'> Default </button>
            <button type="submit" name="tri" value="1"> Croissant Alphabétique </button>
            <button type="submit" name="tri" value="2"> Décroissant Alphabétique </button>
            <button type="submit" name="tri" value="3"> Date Evaluation croissante </button>
            <button type="submit" name="tri" value="4"> Date Evaluation décroissante </button>
            
        </form>
        <form action="competenceP.php" method="post">
            <select name="prof" onchange="submitForm()">
                <?php
                $profs = array(); 
                foreach ($tabComp as $row) {
                    $prof = $row[3];
                    if (!in_array($prof, $profs)) { 
                        $profs[] = $prof; 
                        echo "<option value='$prof'>$prof</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" name="tri" value="6"> Prof </button>
        </form>
        <form action="competenceP.php" method="post">
            <select name="matiere" onchange="submitForm()">
                <?php
                $matieres = array(); 
                foreach ($tabComp as $row) {
                    $matiere = $row[1];
                    if (!in_array($matiere, $matieres)) { 
                        $matieres[] = $matiere; 
                        echo "<option value='$matiere'>$matiere</option>";
                    }
                }
                ?>
            </select>
            <button type="submit" name="tri" value="5"> Matiere </button>
        </form>
        
        <?php
        if(isset($_POST['tri'])){
            if($_POST['tri']!='NULL'){
                if($_POST['tri']==1){//Croissant alphabétique
                    usort($tabComp, function($a, $b) {
                        return strcmp($a[0], $b[0]);
                    });
                    affichage($tabComp); 
                                
                }
                else if($_POST['tri']==2){//décroissant aplabétique
                    usort($tabComp, function($a, $b) {
                        return strcmp($b[0], $a[0]);
                    });
                    affichage($tabComp);  
                }
                else if ($_POST['tri']==3){//date croissante
                    usort($tabComp, function($a, $b) {
                        // Vérifier si $a[4] et $b[4] existent
                        if (isset($a[4]) && isset($b[4])) {
                            $dateA = strtotime($a[4]);
                            $dateB = strtotime($b[4]);
                    
                            if ($dateA === $dateB) {
                                return 0;
                            }
                    
                            return ($dateA < $dateB) ? -1 : 1;
                        }
                    
                        // Si $a[4] ou $b[4] n'existe pas, renvoyer une valeur par défaut
                        return 0;
                    });
                    affichage($tabComp); 

                }
                else if ($_POST['tri']==4){//date décroissante
                    usort($tabComp, function($a, $b) {
                        // Vérifier si $a[4] et $b[4] existent
                        if (isset($a[4]) && isset($b[4])) {
                            $dateA = strtotime($a[4]);
                            $dateB = strtotime($b[4]);
                    
                            if ($dateA === $dateB) {
                                return 0;
                            }
                    
                            return ($dateA > $dateB) ? -1 : 1;
                        }
                    
                        // Si $a[4] ou $b[4] n'existe pas, renvoyer une valeur par défaut
                        return 0;
                    });
                    affichage($tabComp); 

                }
                else if ($_POST['tri']==5){//matiere
                    
                    foreach($tabComp as $row ){
                        if(isset ($row[1])){
                            if($row[1]==$_POST['matiere'] ){
                                ?>
                                <div class="competence">
                                <?php
                                    if(isset($row[0])){
                                        ?>
                                        <p> Compétence : <?php echo $row[0]; ?><br> </p>
                                        <p> Description : <?php echo $row[2]; ?><br> </p>
                                        <p> Matière : <?php echo $row[1]; ?><br> </p>
                                        <?php
                                    }
                                    if(isset($row[4])){
                                        ?>
                                        <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                                        <?php
                                    }
                                    if(isset($row[3])){
                                        ?>
                                        <p> Demandeur : <?php echo $row[3]; ?><br> </p>
                                        <?php
                                    }
                                    if(isset($row[5])){
                                        ?>
                                        <p> Eval eleve : <br> </p>
                                        <?php
                                        if($row[5]== 1){
                                            ?>
                                            <div class="barre">
                                                <span class="non-acquise">Non acquise</span>
                                            </div>
                                            <?php
                                        }
                                        else if ($row[5]==2){
                                            ?>
                                            <div class="barre">
                                                <span class="en-cours">en-cours</span>
                                            </div>
                                            <?php
                                        }
                                        else if ($row[5]==3){
                                            ?>
                                            <div class="barre">
                                                <span class="acquise">Acquise</span>
                                            </div>
                                            <?php
                                        }
                                    }    
                                    if(isset($row[6])){
                                        ?>
                                        <p> Eval Prof : <br> </p>
                                        <?php
                                        if($row[6]== 1){
                                            ?>
                                            <div class="barre">
                                                <span class="non-acquise">Non acquise</span>
                                            </div>
                                            <?php
                                        }
                                        else if ($row[6]==2){
                                            ?>
                                            <div class="barre">
                                                <span class="en-cours">en-cours</span>
                                            </div>
                                            <?php
                                        }
                                        else if ($row[6]==3){
                                            ?>
                                            <div class="barre">
                                                <span class="acquise">Acquise</span>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }    
                    }
                }
                else if ($_POST['tri']==6){//prof
                    
                    foreach($tabComp as $row ){
                        if(isset ($row[3])){
                            if($row[3]==$_POST['prof'] ){
                                ?>
                                <div class="competence">
                                <?php
                                    if(isset($row[0])){
                                        ?>
                                        <p> Compétence : <?php echo $row[0]; ?><br> </p>
                                        <p> Description : <?php echo $row[2]; ?><br> </p>
                                        <p> Matière : <?php echo $row[1]; ?><br> </p>
                                        <?php
                                    }
                                    if(isset($row[4])){
                                        ?>
                                        <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                                        <?php
                                    }
                                    if(isset($row[3])){
                                        ?>
                                        <p> Demandeur : <?php echo $row[3]; ?><br> </p>
                                        <?php
                                    }
                                    if(isset($row[5])){
                                        ?>
                                        <p> Eval eleve : <br> </p>
                                        <?php
                                        if($row[5]== 1){
                                            ?>
                                            <div class="barre">
                                                <span class="non-acquise">Non acquise</span>
                                            </div>
                                            <?php
                                        }
                                        else if ($row[5]==2){
                                            ?>
                                            <div class="barre">
                                                <span class="en-cours">en-cours</span>
                                            </div>
                                            <?php
                                        }
                                        else if ($row[5]==3){
                                            ?>
                                            <div class="barre">
                                                <span class="acquise">Acquise</span>
                                            </div>
                                            <?php
                                        }
                                    }    
                                    if(isset($row[6])){
                                        ?>
                                        <p> Eval Prof : <br> </p>
                                        <?php
                                        if($row[6]== 1){
                                            ?>
                                            <div class="barre">
                                                <span class="non-acquise">Non acquise</span>
                                            </div>
                                            <?php
                                        }
                                        else if ($row[6]==2){
                                            ?>
                                            <div class="barre">
                                                <span class="en-cours">en-cours</span>
                                            </div>
                                            <?php
                                        }
                                        else if ($row[6]==3){
                                            ?>
                                            <div class="barre">
                                                <span class="acquise">Acquise</span>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }        
                    }
                }
            }
            else{
                affichage($tabComp);
            }
        }
        else{
            affichage($tabComp); 
        }
        ?>   
    </div>
</body>

</html>