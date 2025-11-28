<?php
require_once(dirname(dirname(__FILE__)) . '/Service/bdd_service.php');

$updateIdNote = "";
$updateIdEleve = "";
$updateIdMatiere = "";
$updateNote = "";
$updateDate = "";


if ((isset($_GET["updateIdNote"]) && empty($_GET["updateIdNote"]) === false)
    && (isset($_GET["updateIdEleve"]) && empty($_GET["updateIdEleve"]) === false)
    && (isset($_GET["updateIdMatiere"]) && empty($_GET["updateIdMatiere"]) === false
        && (isset($_GET["updateNote"]) && empty($_GET["updateNote"]) === false)
        && (isset($_GET["updateDate"]) && empty($_GET["updateDate"]) === false))
) {
    $updateIdNote = $_GET["updateIdNote"];
    $updateIdEleve = $_GET["updateIdEleve"];
    $updateIdMatiere = $_GET["updateIdMatiere"];
    $updateNote = $_GET["updateNote"];
    $updateDate = $_GET["updateDate"];
}

$mesMatieres = RecupererToutesLesMatieres();
$mesEleves = RecupererTousLesEleves();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modification Élèves — Back‑office</title>
    <link rel="stylesheet" href="./assets/styles.css" />
</head>

<body>
    <header class="container">
        <h1>Back‑office — Élèves</h1>
        <nav>
            <a href="./index.html">Dashboard</a>
            <a href="./classes.php">Classes</a>
            <a href="./eleves.php">Élèves</a>
            <a href="./matieres.php">Matières</a>
            <a href="./notes.php">Notes</a>
        </nav>
    </header>
    <main class="container">

        <section class="card">
            <h2>Modifier une Note</h2>
            <form method="GET" action="notes.php">
                <input name="updatedIdNote" type="text" hidden value="<?php echo $updateIdNote; ?>" />
                <label for="eleve">Élève</label>
                <select id="eleve" name="updatedIdEleve">
                    <?php
                    for ($i = 0; $i < count($mesEleves); $i++) {
                    ?>

                        <?php
                        if ($updateIdEleve === $mesEleves[$i]['Id']) {
                            echo  '<option value="' . $mesEleves[$i]['Id'] . '" selected>' . $mesEleves[$i]['Prenom'] . ' ' . $mesEleves[$i]['Nom'] . '</option>';
                        } else {
                            echo  '<option value="' . $mesEleves[$i]['Id'] . '" >' . $mesEleves[$i]['Prenom'] . ' ' . $mesEleves[$i]['Nom'] . '</option>';
                        }
                        ?>

                    <?php
                    }
                    ?>
                </select>
                <label for="matiere">Matieres</label>
                <select id="matiere" name="updatedIdMatiere">
                    <?php
                    for ($i = 0; $i < count($mesMatieres); $i++) {
                    ?>

                        <?php
                        if ($updateIdMatiere === $mesMatieres[$i]['Id']) {
                            echo  '<option value="' . $mesMatieres[$i]['Id'] . '" selected>'  . $mesMatieres[$i]['Nom_Matiere'] . '</option>';
                        } else {
                            echo  '<option value="' . $mesMatieres[$i]['Id'] . '">'  . $mesMatieres[$i]['Nom_Matiere'] . '</option>';
                        }
                        ?>

                    <?php
                    }
                    ?>
                </select>

                <label for="valeur">Note (0–20)</label>
                <input name="updatedNote" type="number" min="0" max="20" step="0.5" value="<?php echo $updateNote; ?>" />

                <label for="date_note">Date</label>
                <input name="updatedDate" type="date" value="<?php echo $updateDate; ?>" />

                <br>
                <br>
                <button type="submit">Modifier</button>
            </form>
        </section>

    </main>
    <footer class="container small">
        <p>© 2025 — Mini‑projet SLAM</p>
    </footer>
</body>

</html>