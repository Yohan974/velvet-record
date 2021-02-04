<?php
class Database
{
  protected function dbconnect()
  {
    //Paramètre de connexion serveur
    $host = "localhost";
    $login = "root"; //login d'accès au serveur de BDD
    $password =""; //Le password pour s'identifier auprès du serveur
    $base = "record"; // La bdd avec laquelle nous allons travailler

    $db = new PDO('mysql:host='.$host.';charset=utf8;dbname='.$base, $login, $password);
    return $db;
  }
}