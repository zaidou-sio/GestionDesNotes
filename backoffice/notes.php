<?php
require_once(dirname(dirname(__FILE__)) . '/Service/bdd_service.php');

//Modification d'une note
if ((isset($_GET["updatedIdNote"]) && empty($_GET["updatedIdNote"]) === false)
  && (isset($_GET["updatedIdEleve"]) && empty($_GET["updatedIdEleve"]) === false)
  && (isset($_GET["updatedIdMatiere"]) && empty($_GET["updatedIdMatiere"]) === false)
  && (isset($_GET["updatedNote"]) && empty($_GET["updatedNote"]) === false)
  && (isset($_GET["updatedDate"]) && empty($_GET["updatedDate"]) === false)
) {
  $updatedIdNote = $_GET["updatedIdNote"];
  $updatedIdMatiere = $_GET["updatedIdMatiere"];
  $updatedIdEleve = $_GET["updatedIdEleve"];
  $updatedNote = $_GET["updatedNote"];
  $updatedDate = $_GET["updatedDate"];
  UpdateUneNote($updatedIdNote, $updatedIdEleve, $updatedIdMatiere, $updatedNote, $updatedDate);
}




//Suppression d'une note
if ((isset($_GET["deleteIdNote"]) && empty($_GET["deleteIdNote"]) === false)) {
  $idNoteASupprimer = $_GET["deleteIdNote"];
  SupprimerUneNote($idNoteASupprimer);
}

//Ajout d'une note

if ((isset($_POST["ajoutIdEleve"]) && empty($_POST["ajoutIdEleve"]) === false)
  && (isset($_POST["ajoutIdMatiere"]) && empty($_POST["ajoutIdMatiere"]) === false)
  && (isset($_POST["ajoutNote"]) && empty($_POST["ajoutNote"]) === false)
  && (isset($_POST["ajoutDate"]) && empty($_POST["ajoutDate"]) === false)
) {
  $idEleve = $_POST["ajoutIdEleve"];
  $idMatiere = $_POST["ajoutIdMatiere"];
  $note = $_POST["ajoutNote"];
  $date = $_POST["ajoutDate"];
  AjouterUneNote($idEleve, $idMatiere, $note, $date);
}

//Chargement des données matieres,eleves et les notes de la page


$mesMatieres = RecupererToutesLesMatieres();
$mesEleves = RecupererTousLesEleves();
$notes = RecupererToutesLesNotes();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Notes — Back‑office</title>
  <link rel="stylesheet" href="./assets/styles.css" />
</head>

<body>
  <header class="container">
    <h1>Back‑office — Notes</h1>
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
      <h2>Ajouter une note</h2>
      <form action="notes.php" method="POST">
        <label for="eleve">Élève</label>
        <select name="ajoutIdEleve">
          <?php
          for ($i = 0; $i < count($mesEleves); $i++) {
          ?>
            <?php echo  '<option value="' . $mesEleves[$i]['Id'] . '">' . $mesEleves[$i]['Prenom'] . ' ' . $mesEleves[$i]['Nom'] . '</option>' ?>

          <?php
          }
          ?>
        </select>

        <label for="matiere">Matière</label>
        <select name="ajoutIdMatiere">
          <?php
          for ($i = 0; $i < count($mesMatieres); $i++) {
          ?>
            <?php echo  '<option value="' . $mesMatieres[$i]['Id'] . '">' . $mesMatieres[$i]['Nom_Matiere'] . '</option>' ?>

          <?php
          }
          ?>
        </select>

        <label for="valeur">Note (0–20)</label>
        <input name="ajoutNote" type="number" min="0" max="20" step="0.5" />

        <label for="date_note">Date</label>
        <input name="ajoutDate" type="date" />

        <br>
        <br>
        <button>Ajouter</button>
      </form>
    </section>

    <section class="card">
      <h2>Liste des notes</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Élève</th>
            <th>Matière</th>
            <th>Note</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < count($notes); $i++) {
          ?>
            <tr>
              <td><?php echo  $i + 1 ?></td>
              <td><?php echo  $notes[$i]['Prenom'] . ' ' . $notes[$i]['Nom'] ?></td>
              <td><?php echo  $notes[$i]['Nom_Matiere'] ?></td>
              <td><?php echo  $notes[$i]['Note'] ?></td>
              <td><?php echo  $notes[$i]['Date'] ?></td>
              <td>
                <form style="display: inline;" method="GET" action="modification_note.php">

                  <input name="updateIdNote" type="text" hidden value="<?php echo $notes[$i]['Id']; ?>" />
                  <input name="updateIdEleve" type="text" hidden value="<?php echo $notes[$i]['Id_Eleve']; ?>" />
                  <input name="updateIdMatiere" type="text" hidden value="<?php echo $notes[$i]['Id_Matiere']; ?>" />
                  <input name="updateNote" type="text" hidden value="<?php echo $notes[$i]['Note']; ?>" />
                  <input name="updateDate" type="text" hidden value="<?php echo $notes[$i]['Date']; ?>" />

                  <button type="submit">Éditer</button>
                </form>
                <form style="display: inline;" action="notes.php" method="GET">
                  <input name="deleteIdNote" type="text" hidden value="<?php echo $notes[$i]['Id']; ?>" />
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