<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inscription'])) {
   
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $motdepasse = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);

    try {
       
        $con = new PDO("mysql:host=localhost;dbname=gestion des voitures", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

      
        $stmt = $con->prepare("SELECT * FROM clients WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($client) {
            $error = "L'email est déjà utilisé.";
        } else {
            
            $stmt = $con->prepare("INSERT INTO clients (Nom, Adresse, Telephone, Email, MotDePasse) VALUES (:nom, :adresse, :telephone, :email, :motdepasse)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':motdepasse', $motdepasse);
            $stmt->execute();

           
            header("Location: connexion_inscription.php?inscription_success=true");
            exit();
        }
    } catch (PDOException $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connexion'])) {
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    try {
        $con = new PDO("mysql:host=localhost;dbname=gestion des voitures", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     
        $stmt = $con->prepare("SELECT * FROM clients WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($client && password_verify($motdepasse, $client['MotDePasse'])) {
           
            $_SESSION['client_id'] = $client['ID'];
            $_SESSION['role'] = $client['role'];  
            
            header("Location: index.php"); 
            exit();
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion et Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .inscription-section {
            display: none; 
            margin-top: 20px;
        }
        .connexion-section {
            display: block; 
        }
    </style>
    <script>
        
        function toggleInscription() {
            document.getElementById('connexion-section').style.display = 'none'; 
            document.getElementById('inscription-section').style.display = 'block';
        }

       
        function toggleConnexion() {
            document.getElementById('inscription-section').style.display = 'none'; 
            document.getElementById('connexion-section').style.display = 'block'; 
        }
    </script>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Connexion ou Inscription</h2>

        
        <?php if (isset($_GET['inscription_success'])): ?>
            <div class="alert alert-success">Inscription réussie ! Vous pouvez maintenant vous connecter.</div>
        <?php endif; ?>

        <div class="card mt-4 connexion-section" id="connexion-section">
            <div class="card-header">Connexion</div>
            <div class="card-body">
                <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                <form action="connexion_inscription.php" method="POST">
                    <div class="mb-3">
                        <label for="email_connexion" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_connexion" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="motdepasse_connexion" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="motdepasse_connexion" name="motdepasse" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="connexion">Se connecter</button>
                </form>
                <p class="mt-3">Pas encore inscrit ? <a href="javascript:void(0);" onclick="toggleInscription()">Inscrivez-vous ici</a></p>
            </div>
        </div>

       
        <div class="card mt-4 inscription-section" id="inscription-section">
            <div class="card-header">Inscription</div>
            <div class="card-body">
                <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
                <form action="connexion_inscription.php" method="POST">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Numéro de téléphone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="motdepasse" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
                    </div>
                    <button type="submit" class="btn btn-success" name="inscription">S'inscrire</button>
                </form>
                <p class="mt-3">Déjà inscrit ? <a href="javascript:void(0);" onclick="toggleConnexion()">Connectez-vous ici</a></p>
            </div>
        </div>
    </div>
</body>
</html>
