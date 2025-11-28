<?php
require_once(dirname(dirname(__FILE__)) . '/Service/bdd_service.php');

$updateIdEleve = "";
$updateNomEleve = "";
$updatePrenomEleve = "";
$updateIdClasse = "";


if ((isset($_GET["updateIdEleve"]) && empty($_GET["updateIdEleve"]) === false)
    && (isset($_GET["updateNomEleve"]) && empty($_GET["updateNomEleve"]) === false)
    && (isset($_GET["updatePrenomEleve"]) && empty($_GET["updatePrenomEleve"]) === false
        && (isset($_GET["updateIdClasse"]) && empty($_GET["updateIdClasse"]) === false))
) {
    $updateIdEleve = $_GET["updateIdEleve"];
    $updateNomEleve = $_GET["updateNomEleve"];
    $updatePrenomEleve = $_GET["updatePrenomEleve"];
    $updateIdClasse = $_GET["updateIdClasse"];
}

$mesClasses = RecupererToutesLesClasses();
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
            <h2>Modifier un élève</h2>
            <form method="GET" action="eleves.php">
                <input name="updatedIdEleve" type="text" hidden value="<?php echo $updateIdEleve; ?>" />
                <label for="prenom">Prénom</label>
                <input name="updatedPrenomEleve" type="text" value="<?php echo $updatePrenomEleve; ?>" />
                <label for="nom">Nom</label>
                <input name="updatedNomEleve" type="text" value="<?php echo $updateNomEleve; ?>" />
                <label for="classe">Classe</label>
                <select id="classe" name="updatedIdClass">
                    <?php
                    for ($i = 0; $i < count($mesClasses); $i++) {
                    ?>

                        <?php
                        if ($updateIdClasse === $mesClasses[$i]['Id']) {
                            echo  '<option value="' . $mesClasses[$i]['Id'] . '" selected>' . $mesClasses[$i]['Nom_Classe'] . '</option>';
                        } else {
                            echo  '<option value="' . $mesClasses[$i]['Id'] . '">' . $mesClasses[$i]['Nom_Classe'] . '</option>';
                        }
                        ?>

                    <?php
                    }
                    ?>
                </select>
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