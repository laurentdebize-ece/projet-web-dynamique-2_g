<?php
session_start();

try{
    $bdd = new PDO('mysql:host=localhost;dbname=Skillzz;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   die('Erreur : ' . $e->getMessage());
}



$sql=$bdd->prepare("SELECT nomMatière AS matiere FROM suiviMatière WHERE mailE = ? ");
$sql->execute(array($_SESSION['mailE']));
$tabComp=array(array());
$increment=0;

while ($donnees = $sql->fetch() ) {
    $matiere = $donnees['matiere'];
    $comp = $bdd->prepare("SELECT nomComp AS comp , descriptions AS descr FROM Compétence WHERE nomMatière = ? ");
    $comp->execute(array($matiere));
    while($donnees2 = $comp->fetch()){
        $tabComp[$increment][0]=$donnees2['comp'];
        $tabComp[$increment][1]=$matiere;
        $tabComp[$increment][2]=$donnees2['descr'];

        $sql2=$bdd->prepare("SELECT * FROM evaluation WHERE receveur = ? and compétence = ? ");
        $sql2->execute(array($_SESSION['mailE'],$donnees2['comp']));

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
        <p>aa</p><br>
        <?php echo $_SESSION['mailE']; ?>
    </header>
    <div>
        <form action="competenceE.php" method="post">
            <button type="submit" name="tri" value='NULL'> Default </button>
            <button type="submit" name="tri" value="1"> Croissant Alphabétique </button>
            <button type="submit" name="tri" value="2"> Décroissant Alphabétique </button>
            <button type="submit" name="tri" value="3"> Date Evaluation croissante </button>
            <button type="submit" name="tri" value="4"> Date Evaluation décroissante </button>
            
        </form>
        <form action="competenceE.php" method="post">
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
        <form action="competenceE.php" method="post">
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
                    foreach($tabComp as $row){
                        ?>
                        <div class="competence">
                            <p> Compétence : <?php echo $row[0]; ?><br> </p>
                            <p> Description : <?php echo $row[2]; ?><br> </p>
                            <p> Matière : <?php echo $row[1]; ?><br> </p>
                            <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                            <p> Demandeur : <?php echo $row[3]; ?><br> </p>
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
                            ?>
                        </div>
                        <?php    
                    } 
                                
                }
                else if($_POST['tri']==2){//décroissant aplabétique
                    usort($tabComp, function($a, $b) {
                        return strcmp($b[0], $a[0]);
                    });
                    foreach($tabComp as $row){
                        ?>
                        <div class="competence">
                            <p> Compétence : <?php echo $row[0]; ?><br> </p>
                            <p> Description : <?php echo $row[2]; ?><br> </p>
                            <p> Matière : <?php echo $row[1]; ?><br> </p>
                            <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                            <p> Demandeur : <?php echo $row[3]; ?><br> </p>
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
                            ?>
                        </div>
                        <?php    
                    } 
                }
                else if ($_POST['tri']==3){//date croissante
                    usort($tabComp, function($a, $b) {
                        $dateA = strtotime($a[4]);
                        $dateB = strtotime($b[4]);
                    
                        if ($dateA === $dateB) {
                            return 0;
                        }
                    
                        return ($dateA < $dateB) ? -1 : 1;
                    });
                    foreach($tabComp as $row){
                        ?>
                        <div class="competence">
                            <p> Compétence : <?php echo $row[0]; ?><br> </p>
                            <p> Description : <?php echo $row[2]; ?><br> </p>
                            <p> Matière : <?php echo $row[1]; ?><br> </p>
                            <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                            <p> Demandeur : <?php echo $row[3]; ?><br> </p>
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
                            ?>
                        </div>
                        <?php    
                    } 

                }
                else if ($_POST['tri']==4){//date décroissante
                    usort($tabComp, function($a, $b) {
                        $dateA = strtotime($a[4]);
                        $dateB = strtotime($b[4]);
                    
                        if ($dateA === $dateB) {
                            return 0;
                        }
                    
                        return ($dateA > $dateB) ? -1 : 1;
                    });
                    foreach($tabComp as $row){
                        ?>
                        <div class="competence">
                            <p> Compétence : <?php echo $row[0]; ?><br> </p>
                            <p> Description : <?php echo $row[2]; ?><br> </p>
                            <p> Matière : <?php echo $row[1]; ?><br> </p>
                            <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                            <p> Demandeur : <?php echo $row[3]; ?><br> </p>
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
                            ?>
                        </div>
                        <?php    
                    }

                }
                else if ($_POST['tri']==5){//matiere
                    
                    foreach($tabComp as $row ){
                        if($row[1]==$_POST['matiere'] ){
                            ?>
                            <div class="competence">
                                <p> Compétence : <?php echo $row[0]; ?><br> </p>
                                <p> Description : <?php echo $row[2]; ?><br> </p>
                                <p> Matière : <?php echo $row[1]; ?><br> </p>
                                <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                                <p> Demandeur : <?php echo $row[3]; ?><br> </p>
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
                            
                                ?>
                            </div>
                            <?php
                        }    
                    }
                }
                else if ($_POST['tri']==6){//prof
                    
                    foreach($tabComp as $row ){
                        if($row[3]==$_POST['prof'] ){
                            ?>
                            <div class="competence">
                                <p> Compétence : <?php echo $row[0]; ?><br> </p>
                                <p> Description : <?php echo $row[2]; ?><br> </p>
                                <p> Matière : <?php echo $row[1]; ?><br> </p>
                                <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                                <p> Demandeur : <?php echo $row[3]; ?><br> </p>
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
                            
                                ?>
                            </div>
                            <?php
                        }    
                    }
                }
            }
            else{
                foreach($tabComp as $row){
                    ?>
                    <div class="competence">
                        <p> Compétence : <?php echo $row[0]; ?><br> </p>
                        <p> Description : <?php echo $row[2]; ?><br> </p>
                        <p> Matière : <?php echo $row[1]; ?><br> </p>
                        <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                        <p> Demandeur : <?php echo $row[3]; ?><br> </p>
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
                            ?>
                    </div>
                    <?php    
                } 
            }
        }
        else{
            foreach($tabComp as $row){
                ?>
                <div class="competence">
                    <p> Compétence : <?php echo $row[0]; ?><br> </p>
                    <p> Description : <?php echo $row[2]; ?><br> </p>
                    <p> Matière : <?php echo $row[1]; ?><br> </p>
                    <p> Date Evaluation : <?php echo $row[4]; ?><br> </p>
                    <p> Demandeur : <?php echo $row[3]; ?><br> </p>
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
                            ?>
                </div>
                <?php    
            } 
        }
        ?>   
    </div>
</body>

</html>