<?php

  //amener la librairie Mustache qui permet de modifier ....
  include "include/Mustache/Autoloader.php";
  Mustache_Autoloader::register();
  //appeler .init
  include "include/.init.php";

  //on explique à Mustach qu'on va utiliser comme extension le .html
  $options =  array('extension' => '.html');

  $m = new Mustache_Engine(array(
      'loader' => new Mustache_Loader_FilesystemLoader('template/themeA', $options),
  ));
  //affichage du rendu
  $prenom = "marie";
  echo $m->render('header', array("PRENOM" => $prenom));

  //new pdo connexion à la base de donnée avec le.init
  try {
      $dbh = new PDO($dsn, $user, $password);
  } catch (PDOException $e) {
      echo 'Connexion échouée : ' . $e->getMessage();
  }

  //si action == "generate" alors on charge le formulaire de génération (creation.html)
  if (isset($_GET['action']) && $_GET['action'] =="generate"){
    echo $m->render('creation');
  }
  //si action ne vaut rien, ou si on ne connait pas la valeur de action alors on charge le main.html
  else{
    $sth = $dbh->prepare("SELECT * FROM `memeImage`");//prepare SQL request
    $sth->execute();//execute la requette sql
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);// recupère toutes les données

    echo $m->render('main', array("list" => $result));
  }


 ?>
