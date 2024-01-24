
<?php



class JustePrix { // on crée une classe justePrix qui va contenir les méthodes pour le jeu du juste prix

    public $randomItem;
    public $nombre;
    public $nombreChoisi;
    public $resultat;
    public $name;
    public $nombreCoups;
    public $point;
    

    public function __construct($randomItem = null , $name = null) { // on peut mettre des valeurs ou rien du tout pour les paramètres
        $this->randomItem = $randomItem; 
        $this->name = $name;

    }

    public function restart () { // permet de redémarrer le jeu
        ?>
        <button onclick="refreshPage()">Recommencer la partie</button>

<script>
function refreshPage() {
    location.reload();
}
</script>
<?php
    }

    public function HTML () {
        ?> 
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=400, initial-scale=1.0">
            <link  type ="css" rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <title>JustePrix</title>
        </head>
        <body>
        
        <div class="fond-juste-prix">

        <h1>Bienvenue au JustePrix</h1>

        <h2>Le but du jeu est de trouver le juste prix de l'objet</h2>
        <p>Pour gagner le plus de points possible, il faut trouver le juste prix en un minimum de coups</p>
        <p>Le nombre de coups est indiqué </p>

        </div>

        </body>
        </html>

        <?php
    }




    public function displayForm() { // permet d'afficher le formulaire de l'objet justePrix
?>  
        <form id="justePrixForm" method="post">
            <input type ="hidden" name="nombre" value="<?= $this->name; ?>">
            <input type="text" name="guess" placeholder="Entrez votre prix">
            <input type="submit" value="Valider">


        </form>
        <div id="result"></div> <!-- permet d'afficher le résultat de la comparaison -->
        <?php
        
    }

    public function comparaison() { // permet de comparer le prix entré par l'utilisateur avec le prix de l'objet 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            



            if (empty($_POST['guess'])) { // si le champ est vide on affiche un message d'erreur
                echo "Veuillez entrer un prix";

                

            } elseif ($_POST['guess'] < $this->randomItem->price) { // si le prix entré est inférieur au prix de l'objet on affiche un message
                ?> <div class="rouge"> <?php
                echo "C'est plus !";
                $nombreCoups=$_SESSION['nombreCoups']++;
                echo '<br>';
                echo "Vous avez fait " . $_SESSION["nombreCoups"] . " coups ! ";

                ?> </div> <?php
            } elseif ($_POST['guess'] > $this->randomItem->price) { // si le prix entré est supérieur au prix de l'objet on affiche un message
                ?> <div class="rouge"> <?php
                echo "C'est moins !";
                echo '<br>';
                $nombreCoups=$_SESSION['nombreCoups']++;
                
                
                echo "Vous avez fait " . $_SESSION["nombreCoups"] . " coups ! ";
                ?> </div> <?php
            } else { // si le prix entré est égal au prix de l'objet on affiche un message de victoire
               ?> <div class="vert"> <?php

               $nombreCoups=$_SESSION['nombreCoups']++;
              
                echo "Vous avez trouvé le juste prix ! pour " . $this->randomItem->price . "€ ! ";
                echo '<br>';
                echo "Vous avez trouvé le juste prix en " . $_SESSION["nombreCoups"] . " coups ! ";
                echo '<br>';
                echo "Vous avez gagné " . $this->point . " points ! ";
               ?> </div><?php
            }


    }   
}

public function NombreCoups () { 
    
    $this->nombreCoups = $nombreCoups;

    




    if ( $nombreCoups == 1) {
        $point = 10;
    } elseif ( $nombreCoups == 2) {
        $point = 8;
    } elseif ( $nombreCoups == 3) {
        $point = 6;
    } elseif ( $nombreCoups == 4) {
        $point = 4;
    } elseif ( $nombreCoups == 5) {
        $point = 2;
    } elseif ( $nombreCoups == 6) {
        $point = 1;
    } else {
        $point = 0;
    }
}


    public function Ajax() {
?>  
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- on importe jquery -->
        <script>
    $(document).ready(function(){ // on attend que le document soit chargé pour exécuter le code
        $("#justePrixForm").on("submit", function(event) { // on sélectionne le formulaire et on lui applique un évènement submit qui va exécuter une fonction 
            event.preventDefault(); // on empêche le comportement par défaut du formulaire



            var formData = $(this).serialize(); // on récupère les données du formulaire et on les sérialise

            $.ajax({ // on fait une requête ajax qui va envoyer les données du formulaire à la page index.php
                url: 'index.php', // on envoie les données à la page index.php qui va les traiter 
                type: 'post', // on envoie les données en post 
                data: formData, // on envoie les données du formulaire
                success: function(response) { // si la requête est un succès on affiche la réponse dans la div result 
                    $("#result").html(response); // on affiche la réponse dans la div result 
                    console.log(response); // on affiche la réponse dans la console
                }
            });
        });
    });
    </script>
<?php
    }

    
}