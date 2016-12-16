<?php

  //amener la librairie Mustache qui permet de modifier ....
  include "include/Mustache/Autoloader.php";
  Mustache_Autoloader::register();
  //appeler .init
  include "include/.init.php";
  include "include/fonction.php";

  
  $sql = new SQLpdo();
  

  //on explique à Mustach qu'on va utiliser comme extension le .html
  $options =  array('extension' => '.html');

  $m = new Mustache_Engine(array(
      'loader' => new Mustache_Loader_FilesystemLoader('template/themeA', $options),
  ));
  //affichage du rendu

  echo $m->render('header');

  //si action == "generate" alors on charge le formulaire de génération (creation.html)
  if (isset($_GET['action']) && $_GET['action'] =="generate"){
  $result = $sql->fetch("SELECT * FROM `memeImage` WHERE ID= :id ", array(':id' => $_GET['id']));//prepare SQL request
    
    //récupérer l'ID et le Type afin d'afficher l'image
    echo $m->render('creation',
      array(
        "ID" => $result['ID'],
        "type" => $result['type']
      )
    );
  }
  elseif  (isset($_GET['action']) && $_GET['action'] =="vue") {
  if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = intval($_GET['id']);
    $result = $sql->fetch("SELECT * FROM `memeGenerate` LEFT JOIN memeImage ON memeImage.ID = memeGenerate.ID_memeImage WHERE memeGenerate.ID = :id ", array(':id' => $_GET['id']));//prepare SQL request
    
    echo $m->render('vue', array('ID' => $result['url'], 'TYPE' => $result['type']));
  }
  }
  //si action ne vaut rien, ou si on ne connait pas la valeur de action alors on charge le main.html
  else{
    $result = $sql->fetchAll("SELECT * FROM `memeImage`");//prepare SQL request
    echo $m->render('main', array("list" => $result));
  }


 ?>
