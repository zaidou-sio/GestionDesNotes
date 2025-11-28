<?php
require_once(dirname(dirname(__FILE__)) . '/Service/bdd_service.php');


//Modification d'un eleve
if ((isset($_GET["updatedIdClasse"]) && empty($_GET["updatedIdClasse"]) === false)
  && (isset($_GET["updatedNomClasse"]) && empty($_GET["updatedNomClasse"]) === false)
) {
  $updatedIdClasse = $_GET["updatedIdClasse"];
  $updatedNomClasse = $_GET["updatedNomClasse"];
  UpdateUneClasse($updatedIdClasse, $updatedNomClasse);
}




//Suppression d'un eleve
if ((isset($_GET["deleteIdClasse"]) && empty($_GET["deleteIdClasse"]) === false)) {
  $idClasseASupprimer = $_GET["deleteIdClasse"];
  SupprimerUneClasse($idClasseASupprimer);
}



//Ajout de ma classe

if (isset($_POST["ajoutClasse"]) && empty($_POST["ajoutClasse"]) === false) {
  $nomClasse = $_POST["ajoutClasse"];
  AjouterUneClasse($nomClasse);
}
//Chargement de toutes mes classes
$mesClasses = RecupererToutesLesClasses();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Classes — Back‑office</title>
  <link rel="stylesheet" href="./assets/styles.css" />
</head>

<body>
  <header class="container">
    <h1>Back‑office — Classes</h1>
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
      <h2>Ajouter une classe</h2>

      <form action="classes.php" method="POST">

        <label for="libelle">Libellé</label>
        <input name="ajoutClasse" type="text" placeholder="ex: SIO1 A" />

        <button type="submit">Ajouter</button>
      </form>

    </section>

    <section class="card">
      <h2>Liste des classes</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Libellé</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < count($mesClasses); $i++) {
          ?>
            <tr>
              <td><?php echo  $i + 1 ?></td>
              <td><?php echo  $mesClasses[$i]['Nom_Classe'] ?></td>
              <td>

                <form style="display: inline;" method="GET" action="modification_classe.php">

                  <input name="updateIdClasse" type="text" hidden value="<?php echo $mesClasses[$i]['Id']; ?>" />
                  <input name="updateNomClasse" type="text" hidden value="<?php echo $mesClasses[$i]['Nom_Classe']; ?>" />

                  <button type="submit">Éditer</button>
                </form>
                <form style="display: inline;" action="classes.php" method="GET">
                  <input name="deleteIdClasse" type="text" hidden value="<?php echo $mesClasses[$i]['Id']; ?>" />
                  <button style="display: inline;" type="submit">Supprimer</button>
                </form>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </section>

  </main>
  <footer class="container small">
    <p>© 2025 — Mini‑projet SLAM</p>
  </footer>
</body>

</html>