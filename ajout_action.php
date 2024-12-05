<?php

try
{
    $con=new PDO("mysql:host=localhost;dbname=gestion des voitures", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   

    if(isset($_POST["marque"],$_POST["modele"],$_POST["annee"],$_POST["immatriculation"],$_POST["disponibilite"]))
    {
        
    $req="INSERT INTO voitures (Marque,Modele,Annee,Immatriculation,Disponibilite) 
    VALUES  (:Marque,:Modele,:Annee,:Immatriculation,:Disponibilite)  ";




    $marque=$_POST["marque"];
    $modele=$_POST["modele"];
    $annee=$_POST["annee"];
    $immatriculation=$_POST["immatriculation"];
    $disponibilite=$_POST["disponibilite"];

    if($disponibilite =="true")
    {
        $disponibilite=true;
    }
    else
    {
        $disponibilite=false;
    }


    
  
    $stmt= $con->prepare($req);

    $stmt->bindValue(":Marque", $marque);
    $stmt->bindValue(":Modele", $modele);
    $stmt->bindValue(":Annee", $annee);
    $stmt->bindValue(":Immatriculation", $immatriculation);
    $stmt->bindValue(":Disponibilite", $disponibilite);
    $stmt->execute();


    header("Location: ajout.php");
    exit;


    }

    


}
catch (Exception $e)
{
    echo "\nErreur !!". $e->getMessage() ."";
}

?>