<?php

session_start();

include 'objet.php';

include 'justeprix.php';


$item = [
    "objet1"=>new Objet('objet1.png', 50),

    "objet2"=>new Objet('objet2.png', 100),

    "objet3"=>new Objet('objet3.png', 150),

    "objet4"=>new Objet('objet4.png', 200),

    "objet5"=>new Objet('objet5.png', 250),

    "objet6"=>new Objet('objet6.png', 300),

    
];





 

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
        $justePrix->HTML();
        $justePrix->displayForm();
        $justePrix->Ajax();
        $item[$randomItem]->display();

        $justePrix->restart();

        $_SESSION['nombreCoups'] = 0;
        
    }

?>