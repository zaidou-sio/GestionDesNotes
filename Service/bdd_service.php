<?php

function connexionBdd()
{
    try {
        // On se connecte à MySQL
        $mysqlClient = new PDO('mysql:host=localhost;dbname=GestionNotes;charset=utf8', 'root', '');
        return $mysqlClient;
    } catch (Exception $e) {
        // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : ' . $e->getMessage());
    }
}

/********************************************
 * 
 * Permet de recuperer toutes les classes
 * 
 *********************************************/
function RecupererToutesLesClasses()
{
    $mysqlClient = connexionBdd();
    $sql_requete = 'SELECT * FROM Classes';
    $sql = $mysqlClient->prepare($sql_requete);
    $sql->execute();
    $sql_resultat = $sql->fetchAll();

    return $sql_resultat;
}

/********************************************
 * 
 * Permet de recuperer tous les élèves
 * 
 *********************************************/

function RecupererTousLesEleves()
{
    $mysqlClient = connexionBdd();
    $sql_requete = "select elv.Id, elv.Nom, elv.Prenom,cls.Nom_Classe, elv.Id_Classe
from Eleves elv 
JOIN Classes cls on cls.id = elv.Id_Classe;";
    $sql = $mysqlClient->prepare($sql_requete);
    $sql->execute();
    $sql_resultat = $sql->fetchAll();

    return $sql_resultat;
}


/********************************************
 * 
 * Permet de mettre à jour une classe
 * 
 *********************************************/

function UpdateUneClasse($updatedIdClasse, $updatedNomClasse)
{
    $mysqlClient = connexionBdd();
    $sql_requete = "UPDATE Classes SET Nom_Classe=:nouveauNom WHERE Id = :updatedIdClasse";
    $sql = $mysqlClient->prepare($sql_requete);
    $sql->execute(
        [
            'nouveauNom' => $updatedNomClasse,
            'updatedIdClasse' => $updatedIdClasse
        ]
    );
}


/********************************************
 * 
 * Permet de mettre à jour une matiere
 * 
 *********************************************/

function UpdateUneMatiere($updatedIdMatiere, $updatedNomMatiere)
{
    $mysqlClient = connexionBdd();
    $sql_requete = "UPDATE Matieres SET Nom_Matiere=:nouveauNom WHERE Id = :updatedIdMatiere";
    $sql = $mysqlClient->prepare($sql_requete);
    $sql->execute(
        [
            'nouveauNom' => $updatedNomMatiere,
            'updatedIdMatiere' => $updatedIdMatiere
        ]
    );
}

/********************************************
 * 
 * Permet de mettre à jour un eleve
 * 
 *********************************************/

function UpdateUnEleve($updatedIdEleve, $updatedPrenomEleve, $updatedIdClass, $updatedNomEleve)
{
    $mysqlClient = connexionBdd();
    $sql_requete = "UPDATE Eleves SET Nom=:updatedNomEleve, Prenom= :updatedPrenomEleve, Id_Classe= :updatedIdClass WHERE Id = :updatedIdEleve";
    $sql = $mysqlClient->prepare($sql_requete);
    $sql->execute(
        [
            'updatedNomEleve' => $updatedNomEleve,
            'updatedIdEleve' => $updatedIdEleve,
            'updatedPrenomEleve' => $updatedPrenomEleve,
            'updatedIdClass' => $updatedIdClass
        ]
    );
}

/********************************************
 * 
 * Permet de mettre à jour une note
 * 
 *********************************************/

function UpdateUneNote($updatedIdNote, $updatedIdEleve, $updatedIdMatiere, $updatedNote, $updatedDate)
{
    $mysqlClient = connexionBdd();
    $sql_requete = "UPDATE Notes SET Note=:updatedNote,Date=:updatedDate, Id_Eleve= :updatedIdEleve, Id_Matiere= :updatedIdMatiere WHERE Id = :updatedIdNote";
    $sql = $mysqlClient->prepare($sql_requete);
    $sql->execute(
        [
            'updatedNote' => $updatedNote,
            'updatedDate' => $updatedDate,
            'updatedIdEleve' => $updatedIdEleve,
            'updatedIdMatiere' => $updatedIdMatiere,
            'updatedIdNote' => $updatedIdNote
        ]
    );
}

/********************************************
 * 
 * Permet de recuperer tous les élèves
 * 
 *********************************************/

function RecupererLesNotesDunEleve($IdEleve)
{
    $mysqlClient = connexionBdd();
    $sql_requete = "select elv.Nom, elv.Prenom,cls.Nom_Classe, mtr.Nom_Matiere, nte.Note, nte.Date
                    from Notes nte
                    JOIN Eleves elv on elv.Id = nte.Id_Eleve
                    JOIN Matieres mtr on nte.Id_Matiere = mtr.Id
                    JOIN Classes cls on cls.id = elv.Id_Classe
                    where elv.id = :idEleve";
    $sql = $mysqlClient->prepare($sql_requete);
    $sql->execute([
        'idEleve' => $IdEleve
    ]);
    $sql_resultat = $sql->fetchAll();

    return $sql_resultat;
}

/********************************************
 * 
 * Permet de recuperer toutes les notes 
 * 
 *********************************************/
function RecupererToutesLesNotes()
{
    $mysqlClient = connexionBdd();
    $sql_requete = "select nte.Id, elv.Nom, elv.Prenom,cls.Nom_Classe, mtr.Nom_Matiere, nte.Note, nte.Date, nte.Id_Eleve, nte.Id_Matiere
                    from Notes nte
                    JOIN Eleves elv on elv.Id = nte.Id_Eleve
                    JOIN Matieres mtr on nte.Id_Matiere = mtr.Id
                    JOIN Classes cls on cls.id = elv.Id_Classe;";
    $sql = $mysqlClient->prepare($sql_requete);
    $sql->execute();
    $sql_resultat = $sql->fetchAll();

    return $sql_resultat;
}


/********************************************
 * 
 * Permet de recuperer toutes les matières
 * 
 *********************************************/
function RecupererToutesLesMatieres()
{
    $mysqlClient = connexionBdd();
    $sql_requete = 'SELECT * FROM Matieres';
    $sql = $mysqlClient->prepare($sql_requete);
    $sql->execute();
    $sql_resultat = $sql->fetchAll();

    return $sql_resultat;
}

/********************************************
 * 
 * Permet d'Ajouter une classe
 * 
 *********************************************/
function AjouterUneClasse($nomClasse)
{
    $mysqlClient = connexionBdd();

    // Ecriture de la requête
    $sql_requete = 'INSERT INTO Classes(Nom_Classe) VALUES (:nomDeClasse)';

    // Préparation
    $sql = $mysqlClient->prepare($sql_requete);

    // Exécution ! La recette est maintenant en base de données
    $sql->execute([
        'nomDeClasse' => $nomClasse
    ]);
}


/********************************************
 * 
 * Permet d'Ajouter une classe
 * 
 *********************************************/
function AjouterUneMatiere($nomMatiere)
{
    $mysqlClient = connexionBdd();

    // Ecriture de la requête
    $sql_requete = 'INSERT INTO Matieres(Nom_Matiere) VALUES (:nomMatiere)';

    // Préparation
    $sql = $mysqlClient->prepare($sql_requete);

    // Exécution ! La recette est maintenant en base de données
    $sql->execute([
        'nomMatiere' => $nomMatiere
    ]);
}


/********************************************
 * 
 * Permet d'Ajouter un eleve
 * 
 *********************************************/
function AjouterUnEleve($nomEleve, $prenomEleve, $idClasse)
{
    $mysqlClient = connexionBdd();

    // Ecriture de la requête
    $sql_requete = 'INSERT INTO `Eleves`(`Nom`, `Prenom`, `Id_Classe`) VALUES (:nom,:prenom,:idClasse)';

    // Préparation
    $sql = $mysqlClient->prepare($sql_requete);

    // Exécution ! La recette est maintenant en base de données
    $sql->execute([
        'nom' => $nomEleve,
        'prenom' => $prenomEleve,
        'idClasse' => $idClasse
    ]);
}



/********************************************
 * 
 * Permet de supprier un eleve
 * 
 *********************************************/
function SupprimerUneNote($idNote)
{
    $mysqlClient = connexionBdd();

    // Ecriture de la requête
    $sql_requete = 'DELETE FROM `Notes` WHERE Id = :idNote';

    // Préparation
    $sql = $mysqlClient->prepare($sql_requete);

    // Exécution ! La recette est maintenant en base de données
    $sql->execute([
        'idNote' => $idNote
    ]);
}



/********************************************
 * 
 * Permet de supprier un eleve
 * 
 *********************************************/
function SupprimerUnEleve($idEleve)
{
    $mysqlClient = connexionBdd();

    // Ecriture de la requête
    $sql_requete = 'DELETE FROM `Eleves` WHERE Id = :idEleve';

    // Préparation
    $sql = $mysqlClient->prepare($sql_requete);

    // Exécution ! La recette est maintenant en base de données
    $sql->execute([
        'idEleve' => $idEleve
    ]);
}


/********************************************
 * 
 * Permet de supprier une classe
 * 
 *********************************************/
function SupprimerUneClasse($idClasse)
{
    $mysqlClient = connexionBdd();

    // Ecriture de la requête
    $sql_requete = 'DELETE FROM `Classes` WHERE Id = :idClasse';

    // Préparation
    $sql = $mysqlClient->prepare($sql_requete);

    // Exécution ! La recette est maintenant en base de données
    $sql->execute([
        'idClasse' => $idClasse
    ]);
}


/********************************************
 * 
 * Permet de supprier une Matiere
 * 
 *********************************************/
function SupprimerUneMatiere($idMatiere)
{
    $mysqlClient = connexionBdd();

    // Ecriture de la requête
    $sql_requete = 'DELETE FROM `Matieres` WHERE Id = :idMatiere';

    // Préparation
    $sql = $mysqlClient->prepare($sql_requete);

    // Exécution ! La recette est maintenant en base de données
    $sql->execute([
        'idMatiere' => $idMatiere
    ]);
}

/********************************************
 * 
 * Permet d'Ajouter une note
 * 
 *********************************************/
function AjouterUneNote($idEleve, $idMatiere, $note, $date)
{
    $mysqlClient = connexionBdd();

    // Ecriture de la requête
    $sql_requete = 'INSERT INTO `Notes`(`Note`, `Date`, `Id_Eleve`, `Id_Matiere`) VALUES (:note,:date,:idEleve,:idMatiere)';

    // Préparation
    $sql = $mysqlClient->prepare($sql_requete);

    // Exécution ! La recette est maintenant en base de données
    $sql->execute([
        'note' => $note,
        'date' => $date,
        'idEleve' => $idEleve,
        'idMatiere' => $idMatiere
    ]);
}
