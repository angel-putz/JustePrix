



<?php

session_start(); // on démarre la session




include 'objet.php'; // on importe la classe objet

include 'justeprix.php'; // on importe la classe justePrix


$item = [
    "objet1"=>new Objet('objet1.png', 50),

    "objet2"=>new Objet('objet2.png', 100),

    "objet3"=>new Objet('objet3.png', 150),

    "objet4"=>new Objet('objet4.png', 200),

    "objet5"=>new Objet('objet5.png', 250),

    "objet6"=>new Objet('objet6.png', 300),

    
]; // on crée un tableau qui contient les objets du jeu



 

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        // C'est une requête AJAX
        //var_dump($_POST);
        $justePrix = new JustePrix($item[$_POST['nombre']], $_POST['nombre']);
        $justePrix->comparaison();
        $justePrix->NombrePoint();

        
        

        exit; // Termine l'exécution du script après avoir renvoyé la réponse AJAX
    } else {
        // C'est une requête normale
      //  $randomItem = $item[array_rand($item)];
      $randomItem = array_rand($item);
       //var_dump($randomItem);
       
        $justePrix = new JustePrix($item[$randomItem], $randomItem);
        $justePrix->displayForm();
        $justePrix->Ajax();
        $item[$randomItem]->display();
        ?>
        <br>
        <?php
        $justePrix->restart();

        $justePrix->HTML();

        $_SESSION['nombreCoups']=0;

        
        
    }



?>