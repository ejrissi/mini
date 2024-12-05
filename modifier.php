<?php
$con = new PDO("mysql:host=localhost;dbname=gestion des voitures", "root", "");
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = $_GET['id']; 
$stmt = $con->prepare("SELECT * FROM voitures WHERE ID = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$voiture = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$voiture) {
    die("Voiture not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Voiture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #2c3e50;
        }

        .form-container {
            background-color: transparent;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: white;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: white;
        }

        input, select {
            color: white;
            border: 1px solid white;
            background-color: transparent;
        }

        form input, form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: transparent;
            color: white;
            border: 1px solid #02ff12;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #02ff12;
        }

        select {
            color: white;
            border: 1px solid white;
            background-color: transparent;
        }

        option {
            background-color: transparent;
            color: rgb(6, 0, 0);
        }

        option:hover {
            color: white;
        }

        select:focus {
            background-color: transparent;
            color: white;
        }
    </style>
</head>
<body>

<header>
        <a class="a" href="index.php">Gestion des Voitures</a>
        <div class="content">
            <div class="profile">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><a class="dropdown-item" href="#">Se connecter</a></li>
                        <li><a class="dropdown-item" href="#">Déconnexion</a></li>
                    </ul>
                </li>
            </div>
        </div>
    </header>

<section>
        <div class="container">
            <a href="Accueil.php">Accueil</a>
            <a href="index.php">Lister</a>
            <a href="ajout.php">Ajouter</a>
        </div>
</section>






<div class="form-container">
    <form action="modifier_action.php?id=<?php echo $voiture['ID']; ?>" method="POST">
        <h2>Modifier Voiture</h2>

        <label for="marque">Marque</label>
        <input type="text" id="marque" name="marque" value="<?php echo $voiture['Marque']; ?>" placeholder="Entrez la marque" required>

        <label for="modele">Modèle</label>
        <input type="text" id="modele" name="modele" value="<?php echo $voiture['Modele']; ?>" placeholder="Entrez le modèle" required>

        <label for="annee">Année</label>
        <input type="number" id="annee" name="annee" value="<?php echo $voiture['Annee']; ?>" placeholder="Entrez l'année" required>

        <label for="immatriculation">Immatriculation</label>
        <input type="text" id="immatriculation" name="immatriculation" value="<?php echo $voiture['Immatriculation']; ?>" placeholder="Numéro d'immatriculation" required>

        <label for="disponibilite">Disponibilité</label>
        <select id="disponibilite" name="disponibilite" required>
            <option value="1" <?php echo $voiture['Disponibilite'] == 1 ? 'selected' : ''; ?>>Disponible</option>
            <option value="0" <?php echo $voiture['Disponibilite'] == 0 ? 'selected' : ''; ?>>Non disponible</option>
        </select>

        <button type="submit">Modifier</button>
    </form>
</div>

</body>
</html>
