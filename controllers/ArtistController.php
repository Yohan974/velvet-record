<?php 
require_once "models/Artist.php";

function newArtist()
{
  // Sets the page's title
  $title = "Velvet Records - New Artist";

  require "views/artists/new.php";
}

function createArtist()
{
  // Sets the page's title
  $title = "Velvet Records - New Artist";

  // Creates a new Artist model instance
  $artist = new Artist();

  // Gets the artists
  $artists = $artist->getArtistsList();

  $name="";

  // An array filled the with the form input errors
  $errors = [];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the value is not empty
    if (!empty($_POST["name"])) {
      // If the value is valid
      if (preg_match("/^[^<>&]+$/i", $_POST["name"])) {
          // It filters the input and makes it safe to insert into the database
          $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
      } else {
          // If it's not valid it asks the user to give a valid name
          $errors["name"] = "The name is not valid.";
      }
    } else {
      // If it's empty it asks the user to give a name
      $errors["name"] = "The name is required.";
    }

    if (empty($errors)) {

      $artist->create([
          ":artist_name" => $name
      ]);

      header("Location: index.php?action=artistsList");
    } else {
      require "views/artists/new.php";
    }
  }
}

function artistDiscsList()
{
  // Sets the page's title
  $title = "Velvet Records - Discography";

  // Creates a new Artist model instance
  $artist = new Artist;

  // Get the artist details
  $artistDiscsList = $artist->getArtistDiscsList($_GET["id"]);

  require "views/artists/discsList.php";
}

function artistsList()
{
  // Sets the page's title
  $title="Velvet Records - Artists Gallery";
  
  // Creates a new Artist model instance
  $artist = new Artist;

  // Gets the list of all artists
  $artists = $artist->getArtistsList();

  require "views/artists/list.php";
}

function artistDetails()
{
  // Sets the page's title
  $title = "Velvet Records - Edit Artist";

  // Creates a new Disc model instance
  $artist = new Artist();

  // Get the disc details
  $artistDetails = $artist->getArtistDetails($_GET["id"]);

  require "views/artists/details.php";
}

function updateArtist()
{
  // Sets the page's title
  $title = "Velvet Records - Edit Artist";

  // Creates a new Disc model instance
  $artist = new Artist();

  // Grabs the GET input and filters it
  $artistId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

  // Get the disc details
  $artistDetails = $artist->getArtistDetails($artistId);

  // Here lies all the forms variables
  $name = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the value is not empty
    if (!empty($_POST["name"])) {
      // If the value is valid
      if (preg_match("/^[^<>&]+$/i", $_POST["name"])) {
          // It filters the input and makes it safe to insert into the database
          $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
      } else {
          // If it's not valid it asks the user to give a valid name
          $errors["name"] = "Le name n'est pas valide.";
      }
    } else {
      // If it's empty it asks the user to give a name
      $errors["name"] = "Le name est requis.";
    }

    if (empty($errors)) {

      $artist->update([
          ":artist_id" => $artistId,
          ":artist_name" => $name
      ]);

      header("Location: index.php?action=artistsList");
    } else {
      require "views/artists/details.php";
    }
  }
}

function deleteArtist() 
{
    //Create a new artist model instance
    $artist = new Artist();

    //delete the artist
    $artist->delete($_GET["id"]);

    header("Location: index.php?action=artistsList");
}