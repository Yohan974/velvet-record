<?php
require 'controllers\ArtistController.php';
require 'controllers\DiscController.php';
require 'controllers\HomeController.php';

try {
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'newDisc') {
      newDisc();
    }
    elseif ($_GET['action'] == 'discsList') {
      discsList();
    }
    elseif ($_GET['action'] == 'createDisc') {
      createDisc();
    }
    elseif ($_GET['action'] == 'discDetails') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        discDetails();
      }
      else {
        throw new Exception('Erreur d\'identifiant');
      }
    }
    elseif ($_GET['action'] == 'updateDisc') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        updateDisc();
      }
      else {
        throw new Exception('Erreur d\'identifiant');
      }
    }
    elseif ($_GET['action'] == 'deleteDisc') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        deleteDisc();
      }
      else {
        throw new Exception('Erreur d\'identifiant');
      }
    }
    elseif ($_GET['action'] == 'newArtist') {
      newArtist();
    }
    elseif ($_GET['action'] == 'artistsList') {
      artistsList();
    }
    elseif ($_GET['action'] == 'createArtist') {
      createArtist();
    }
    elseif ($_GET['action'] == 'artistDetails') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        artistDetails();
      }
      else {
        throw new Exception('Erreur d\'identifiant');
      }
    }
    elseif ($_GET['action'] == 'artistDiscsList') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        artistDiscsList();
      }
      else {
        throw new Exception('Erreur d\'identifiant');
      }
    }
    elseif ($_GET['action'] == 'updateArtist') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        updateArtist();
      }
      else {
        throw new Exception('Erreur d\'identifiant');
      }
    }
    elseif ($_GET['action'] == 'deleteArtist') {
      if (isset($_GET['id']) && $_GET['id'] > 0) {
        deleteArtist();
      }
      else {
        throw new Exception('Erreur d\'identifiant');
      }
    }
  }
  else {
    home();
  }
} catch (Exception $e) {
  echo 'Erreur : ' . $e->getMessage();
}

