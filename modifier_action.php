<?php

$con = new PDO("mysql:host=localhost;dbname=gestion des voitures", "root", "");
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_GET['id'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee'];
    $immatriculation = $_POST['immatriculation'];
    $disponibilite = $_POST['disponibilite'];

    
    $stmt = $con->prepare("UPDATE voitures SET Marque = :marque, Modele = :modele, Annee = :annee, Immatriculation = :immatriculation, Disponibilite = :disponibilite WHERE ID = :id");

   
    $stmt->bindParam(':marque', $marque);
    $stmt->bindParam(':modele', $modele);
    $stmt->bindParam(':annee', $annee);
    $stmt->bindParam(':immatriculation', $immatriculation);
    $stmt->bindParam(':disponibilite', $disponibilite, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        
        header("Location: index.php");
        exit;
    } else {
     
        echo "Error updating record!";
    }
}
?>
