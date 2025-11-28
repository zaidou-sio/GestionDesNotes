<?php
require_once(dirname(dirname(__FILE__)) . '/Service/bdd_service.php');

$updateIdMatiere = "";
$updateNomMatiere = "";

if ((isset($_GET["updateIdMatiere"]) && empty($_GET["updateIdMatiere"]) === false)
    && (isset($_GET["updateNomMatiere"]) && empty($_GET["updateNomMatiere"]) === false)
) {
    $updateIdMatiere = $_GET["updateIdMatiere"];
    $updateNomMatiere = $_GET["updateNomMatiere"];
}

$mesMatieres = RecupererToutesLesMatieres();
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
            <form method="GET" action="matieres.php">
                <input name="updatedIdMatiere" type="text" hidden value="<?php echo $updateIdMatiere; ?>" />
                <label for="nom">Nom</label>
                <input name="updatedNomMatiere" type="text" value="<?php echo $updateNomMatiere; ?>" />
                <button type="submit">Modifier</button>
            </form>
        </section>

    </main>
    <footer class="container small">
        <p>© 2025 — Mini‑projet SLAM</p>
    </footer>
</body>

</html>