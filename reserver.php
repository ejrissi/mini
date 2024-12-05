
<?php
// Start session
session_start();

try {
    // Connect to the database
    $con = new PDO("mysql:host=localhost;dbname=gestion des voitures", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        // Get the car details based on the ID passed in the URL
        $carId = $_GET['id'];
        $stmt = $con->prepare("SELECT * FROM voitures WHERE ID = :id");
        $stmt->bindParam(':id', $carId, PDO::PARAM_INT);
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$car) {
            // If no car is found, redirect back to index.php
            header("Location: index.php");
            exit();
        }
    } else {
        // If no car ID is provided in the URL, redirect back to index.php
        header("Location: index.php");
        exit();
    }

    // Check if the form has been submitted
    if (isset($_POST['reserve'])) {
        // Get the form data
        $dateDebut = $_POST['date_debut'];
        $dateFin = $_POST['date_fin'];
        $userId = $_SESSION['user_id']; // Assuming you have user session set up

        // Insert the reservation into the database
        $stmt = $con->prepare("INSERT INTO reservations (user_id, car_id, date_debut, date_fin) 
                               VALUES (:user_id, :car_id, :date_debut, :date_fin)");

        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':car_id', $carId, PDO::PARAM_INT);
        $stmt->bindParam(':date_debut', $dateDebut);
        $stmt->bindParam(':date_fin', $dateFin);

        // Execute and redirect to index.php after successful reservation
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Erreur lors de la réservation.";
        }
    }
} catch (PDOException $e) {
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
    .co {
    width: 80%;
    margin: auto;
    display: flex;
    flex-direction: column;
    justify-content: center; 
    align-items: center; 
    height: fit-content; 
    margin-top: 100px;
}
h1
{
    color: rgb(255, 255, 255);
    user-select: none;
}
p
{
    color: gray;
    width: 50%;
    user-select: none;
    
}
.reserver {
    border: 1px solid white;
    border-radius: 5px;
    padding: 4px 9px;
    color: rgb(255, 255, 255);
    box-shadow: 0 0 10px  rgb(255, 255, 255);
    width: fit-content;
    display: flex;
    border: none;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    user-select: none;
}

.reserver:hover {
    color:  rgb(255, 255, 255);
}
.form-container
{
    width:80%;
    padding-top: 100px;
    margin:auto;

}
h1,p
{
    text-align: center;
    color:white;
}
label
{
    color:white;
}

.ff {
    width:50%;
    margin: auto;
    
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
        <h1>Réserver la voiture: <?php echo $car['Marque'] . " " . $car['Modele']; ?></h1>
        <p>Choisissez la date de début et la date de fin de la réservation.</p>

        <form class="ff" action="reserver.php?id=<?php echo $car['ID']; ?>" method="POST">
            <div class="form-group">
                <label for="date_debut">Date de début :</label>
                <input type="date" name="date_debut" id="date_debut" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date_fin">Date de fin :</label>
                <input type="date" name="date_fin" id="date_fin" class="form-control" required>
            </div>

            <input type="hidden" name="car_id" value="<?php echo $car['ID']; ?>">

            <button type="submit" name="reserve" class="btn btn-primary mt-3">Réserver</button>
        </form>
    </div>

   


   

</body>
</html>