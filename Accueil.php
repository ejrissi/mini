


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

    <div class="co">
  <h1>Bienvenue sur notre site de gestion des voitures</h1>
  <p>Nous vous proposons un service simple et rapide pour réserver des voitures adaptées à vos besoins. Que ce soit pour un trajet court ou un voyage longue distance, nous avons une large gamme de véhicules disponibles. Choisissez votre voiture, réservez-la en quelques clics et partez sereinement!</p>
  <a  class="reserver" href="index.php" id="loadContentLink">Réservez une voiture</a>
   </div>


   

</body>
</html>