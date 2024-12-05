<?php
  

    if (isset($_POST['delete']) && isset($_POST['id'])) {
        $id = $_POST['id'];

        try {
            $con = new PDO("mysql:host=localhost;dbname=gestion des voitures", "root", "");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            $stmt = $con->prepare("DELETE FROM voitures WHERE ID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Redirect to the same page to refresh the list after deletion
                header("Location: index.php");
                exit();
            } else {
                echo "Erreur lors de la suppression.";
            }
        } catch (Exception $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }
?>