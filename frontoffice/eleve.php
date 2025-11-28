<?php
// FRONT OFFICE

require_once(dirname(dirname(__FILE__)) . '/Service/bdd_service.php');

$getData = $_GET;
$mesEleves = RecupererTousLesEleves();

//Chargement des notes de l'eleve
if (isset($getData['eleve'])) {
    $notes = RecupererLesNotesDunEleve($getData['eleve']);
} else {
    $notes = array();
}


?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des notes</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>

    <nav>
        <ul>
            <li> <a href="index.html">Accueil</a> </li>
            <li> <a href="eleve.php">Note des élèves</a> </li>

        </ul>
    </nav>


    <form action="eleve.php" method="get">

        <label for="eleve">Veuillez selectionner l'élève que vous souhaitez voir ses notes :</label>
        <select name="eleve"> <!-- ListBox -->
            <?php
            for ($i = 0; $i < count($mesEleves); $i++) {
                if ($mesEleves[$i]['Id'] === $getData['eleve']) {
                    echo  '<option value="' . $mesEleves[$i]['Id'] . '" selected>' . $mesEleves[$i]['Prenom'] . ' ' . $mesEleves[$i]['Nom'] . '</option>';
                } else {
                    echo  '<option value="' . $mesEleves[$i]['Id'] . '">' . $mesEleves[$i]['Prenom'] . ' ' . $mesEleves[$i]['Nom'] . '</option>';
                }
            }
            ?>
        </select>
        <input type="submit" value="Rafraichir">
    </form>
    <?php
    if (isset($notes) && count($notes) > 0) {
        echo '<br></r>Voiçi les notes de ' . $notes[0]['Nom'] . ' ' . $notes[0]['Prenom'] . ' : <br><br>';
    ?>
        <table>
            <tr>
                <td>Classe</td>
                <td>Matière</td>
                <td>Note</td>
                <td>Date</td>
            </tr>
            <?php
            $moyenne = 0;
            for ($i = 0; $i < count($notes); $i++) {
                echo '<tr>';
                echo '<td>' . $notes[$i]['Nom_Classe'] . '</td>';
                echo '<td>' . $notes[$i]['Nom_Matiere'] . '</td>';
                echo '<td>' . $notes[$i]['Note'] . '</td>';
                echo '<td>' . $notes[$i]['Date'] . '</td>';
                echo '</tr>';
                $moyenne += intval($notes[$i]['Note']);
            }

            ?>
        </table> <br><br>
    <?php
        echo "La moyenne de l'élève est de : " . $moyenne / count($notes);
    } else if (isset($notes)) {
        echo '<br><br></r>L\'élève que vous avez selectionnez n\'a actuellement aucune note.';
    }
    ?>

</body>

</html>