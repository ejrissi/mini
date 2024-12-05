<?php
session_start();

try {
    $con = new PDO("mysql:host=localhost;dbname=gestion des voitures", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 'client';



    if ($userRole == 'admin') {

        $stmt = $con->query("SELECT * FROM voitures");
    } else {

        $stmt = $con->query("SELECT * FROM voitures WHERE Disponibilite = 1");
    }
    $voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];

        try {
            $stmt = $con->prepare("DELETE FROM voitures WHERE ID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                echo "Erreur lors de la suppression.";
            }
        } catch (Exception $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }
} catch (Exception $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

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
        .reserve {
            background: transparent;
            outline: none;

            border-radius: 4px;
            color: rgb(0, 250, 50);
            border: 1px solid rgb(20, 252, 4);
            padding: 4px 4px;
            transition: all 0.4s ease;
            text-transform: uppercase;
            margin-left: 5px;
            text-decoration: none;
        }

        .reserve:hover {
            background-color: rgb(0, 250, 50);
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

    <div class="containerr">
        <div class="search">
            <input type="text" name="search" placeholder="Rechercher">
            <button class="sea"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>

        <form class="cont" action="index.php" method="post">
            <table>
                <tr>
                    <th>Marque</th>
                    <th>Modele</th>
                    <th>Annee</th>
                    <th>Immatriculation</th>
                    <th>Disponibilite</th>
                    <th></th>
                    <th></th>
                </tr>

                <?php foreach ($voitures as $voiture) { ?>
                    <tr>
                        <td><?php echo $voiture['Marque']; ?></td>
                        <td><?php echo $voiture['Modele']; ?></td>
                        <td><?php echo $voiture['Annee']; ?></td>
                        <td><?php echo $voiture['Immatriculation']; ?></td>
                        <td><?php echo $voiture['Disponibilite'] == 1 ? "Oui" : "Non"; ?></td>
                        <td>
                            <?php if ($userRole == 'admin') { ?>
                                <a type="button" class="modifier" href="modifier.php?id=<?php echo $voiture['ID']; ?>">Modifier</a>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($userRole == 'admin') { ?>
                                <button type="submit" name="delete" value="<?php echo $voiture['ID']; ?>" class="Supprimer">
                                    Supprimer
                                </button>

                            <?php } else if ($userRole == 'client' && $voiture['Disponibilite'] == 1) { ?>
                                <a type="button" name="reserve" class="reserve" href="reserver.php?id=<?php echo $voiture['ID']; ?>">Réserver</a>
                            <?php } ?>

                        </td>
                    </tr>
                <?php } ?>
            </table>
        </form>

    </div>
</body>

</html>