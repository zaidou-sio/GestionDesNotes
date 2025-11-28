<?php
require_once(dirname(dirname(__FILE__)) . '/Service/bdd_service.php');


//Modification d'un eleve
if ((isset($_GET["updatedIdMatiere"]) && empty($_GET["updatedIdMatiere"]) === false)
  && (isset($_GET["updatedNomMatiere"]) && empty($_GET["updatedNomMatiere"]) === false)
) {
  $updatedIdMatiere = $_GET["updatedIdMatiere"];
  $updatedNomMatiere = $_GET["updatedNomMatiere"];
  UpdateUneMatiere($updatedIdMatiere, $updatedNomMatiere);
}




//Suppression d'un eleve
if ((isset($_GET["deleteIdMatiere"]) && empty($_GET["deleteIdMatiere"]) === false)) {
  $idMatiereASupprimer = $_GET["deleteIdMatiere"];
  SupprimerUneMatiere($idMatiereASupprimer);
}
//Ajout d'une matiere

if (isset($_POST["ajoutMatiere"]) && empty($_POST["ajoutMatiere"]) === false) {
  $nomMatiere = $_POST["ajoutMatiere"];
  AjouterUneMatiere($nomMatiere);
}

//Chargement de toutes mes matières
$mesMatieres = RecupererToutesLesMatieres();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Matières — Back‑office</title>
  <link rel="stylesheet" href="./assets/styles.css" />
</head>

<body>
  <header class="container">
    <h1>Back‑office — Matières</h1>
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
      <h2>Ajouter une matière</h2>
      <form action="matieres.php" method="POST">
        <label for="libelle">Libellé</label>
        <input name="ajoutMatiere" type="text" placeholder="ex: Maths" />
        <button type="submit">Ajouter</button>
      </form>
    </section>

    <section class="card">
      <h2>Liste des matières</h2>
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
          for ($i = 0; $i < count($mesMatieres); $i++) {
          ?>
            <tr>
              <td><?php echo  $i + 1 ?></td>
              <td><?php echo  $mesMatieres[$i]['Nom_Matiere'] ?></td>
              <td>
                <form style="display: inline;" method="GET" action="modification_matiere.php">

                  <input name="updateIdMatiere" type="text" hidden value="<?php echo $mesMatieres[$i]['Id']; ?>" />
                  <input name="updateNomMatiere" type="text" hidden value="<?php echo $mesMatieres[$i]['Nom_Matiere']; ?>" />

                  <button type="submit">Éditer</button>
                </form>
                <form style="display: inline;" action="matieres.php" method="GET">
                  <input name="deleteIdMatiere" type="text" hidden value="<?php echo $mesMatieres[$i]['Id']; ?>" />
                  <button style="display: inline;" type="submit">Supprimer</button>
                </form>
              </td>
            </tr>
          <?php
          }
          ?>
      </table>
    </section>

  </main>
  <footer class="container small">
    <p>© 2025 — Mini‑projet SLAM</p>
  </footer>
</body>

</html>