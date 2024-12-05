<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Voitures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background-color: #2c3e50;
        }

        .co {
            width: 80%;
            margin: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 100px;
        }

        h1 {
            color: rgb(255, 255, 255);
            user-select: none;
        }

        p {
            color: gray;
            width: 50%;
            user-select: none;
        }

        .reserver {
            border: 1px solid white;
            border-radius: 5px;
            padding: 4px 9px;
            color: rgb(255, 255, 255);
            box-shadow: 0 0 10px rgb(255, 255, 255);
            width: fit-content;
            display: flex;
            border: none;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        .reserver:hover {
            color: rgb(255, 255, 255);
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

        input {
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
        <form action="ajout_action.php" method="POST">
            <h2>Formulaire Voiture</h2>

            <label for="marque">Marque</label>
            <input type="text" id="marque" name="marque" placeholder="Entrez la marque" required>

            <label for="modele">Modèle</label>
            <input type="text" id="modele" name="modele" placeholder="Entrez le modèle" required>

            <label for="annee">Année</label>
            <input type="number" id="annee" name="annee" placeholder="Entrez l'année" required>

            <label for="immatriculation">Immatriculation</label>
            <input type="text" id="immatriculation" name="immatriculation" placeholder="Numéro d'immatriculation" required>

            <label for="disponibilite">Disponibilité</label>
            <select id="disponibilite" name="disponibilite" required>
                <option value="true">Disponible</option>
                <option value="false">Non disponible</option>
            </select>

            <button type="submit">Enregistrer</button>
        </form>
    </div>

</body>
</html>
