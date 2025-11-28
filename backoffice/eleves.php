<?php
require_once(dirname(dirname(__FILE__)) . '/Service/bdd_service.php');


//Modification d'un eleve
if ((isset($_GET["updatedIdEleve"]) && empty($_GET["updatedIdEleve"]) === false)
  && (isset($_GET["updatedPrenomEleve"]) && empty($_GET["updatedPrenomEleve"]) === false)
  && (isset($_GET["updatedIdClass"]) && empty($_GET["updatedIdClass"]) === false)
  && (isset($_GET["updatedNomEleve"]) && empty($_GET["updatedNomEleve"]) === false)
) {
  $updatedIdEleve = $_GET["updatedIdEleve"];
  $updatedPrenomEleve = $_GET["updatedPrenomEleve"];
  $updatedIdClass = $_GET["updatedIdClass"];
  $updatedNomEleve = $_GET["updatedNomEleve"];
  UpdateUnEleve($updatedIdEleve, $updatedPrenomEleve, $updatedIdClass, $updatedNomEleve);
}




//Suppression d'un eleve
if ((isset($_GET["deleteIdEleve"]) && empty($_GET["deleteIdEleve"]) === false)) {
  $idEleveASupprimer = $_GET["deleteIdEleve"];
  SupprimerUnEleve($idEleveASupprimer);
}



//Ajout d'un eleve

if ((isset($_GET["ajoutNomEleve"]) && empty($_GET["ajoutNomEleve"]) === false)
  && (isset($_GET["ajoutPrenomEleve"]) && empty($_GET["ajoutPrenomEleve"]) === false)
  && (isset($_GET["ajoutIdClass"]) && empty($_GET["ajoutIdClass"]) === false)
) {
  $nomEleve = $_GET["ajoutNomEleve"];
  $prenomEleve = $_GET["ajoutPrenomEleve"];
  $idClass = $_GET["ajoutIdClass"];
  AjouterUnEleve($nomEleve, $prenomEleve, $idClass);
}

$mesClasses = RecupererToutesLesClasses();
$mesEleves = RecupererTousLesEleves();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Élèves — Back‑office</title>
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
      <h2>Ajouter un élève</h2>
      <form id="formAddEleve" method="GET" action="eleves.php">
        <label for="prenom">Prénom</label>
        <input name="ajoutPrenomEleve" id="ajoutPrenomEleve" required type="text" placeholder="ex: Alice" />
        <label for="nom">Nom</label>
        <input name="ajoutNomEleve" id="ajoutNomEleve" required type="text" placeholder="ex: Durand" />
        <label for="classe">Classe</label>
        <select id="classe" name="ajoutIdClass">
          <?php
          for ($i = 0; $i < count($mesClasses); $i++) {
          ?>

            <?php echo  '<option value="' . $mesClasses[$i]['Id'] . '">' . $mesClasses[$i]['Nom_Classe'] . '</option>' ?>

          <?php
          }
          ?>
        </select>
        <br>
        <br>
        <button type="submit">Ajouter</button>
      </form>
    </section>

    <section class=" card">
      <h2>Liste des élèves</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Classe</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < count($mesEleves); $i++) {
          ?>
            <tr>
              <td><?php echo  $i + 1 ?></td>
              <td><?php echo  $mesEleves[$i]['Nom'] ?></td>
              <td><?php echo  $mesEleves[$i]['Prenom'] ?></td>
              <td><?php echo  $mesEleves[$i]['Nom_Classe'] ?></td>
              <td>
                <form style="display: inline;" method="GET" action="modification_eleve.php">

                  <input name="updateIdEleve" type="text" hidden value="<?php echo $mesEleves[$i]['Id']; ?>" />
                  <input name="updateNomEleve" type="text" hidden value="<?php echo $mesEleves[$i]['Nom']; ?>" />
                  <input name="updatePrenomEleve" type="text" hidden value="<?php echo $mesEleves[$i]['Prenom']; ?>" />
                  <input name="updateIdClasse" type="text" hidden value="<?php echo $mesEleves[$i]['Id_Classe']; ?>" />

                  <button type="submit">Éditer</button>
                </form>
                <form style="display: inline;" action="eleves.php" method="GET">
                  <input name="deleteIdEleve" type="text" hidden value="<?php echo $mesEleves[$i]['Id']; ?>" />
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