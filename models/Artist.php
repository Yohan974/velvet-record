<?php
require_once "Database.php";

class Artist extends Database
{

  public function create(array $items): void
  {
    $db = $this->dbconnect();
    // The INSERT request
    $request = "INSERT INTO artist 
                (artist_name) 
                VALUE (:artist_name)";

    // Prepares the statement for execution and returns the statement object
    $insert = $db->prepare($request);

    // Executes the prepared statement
    $insert->execute($items);

    // Closes the cursor
    $insert->closeCursor();
  }

  public function getArtistsList()
  {
    $db = $this->dbconnect();
    // The SELECT query
    $request = "SELECT * FROM artist ORDER BY artist_name";

    // Prepares the statement for execution and returns the statement object
    $query = $db->query($request);

    // Fetches all the discs from the query as an Object
    $artists = $query->fetchALL(PDO::FETCH_OBJ);

    // Closes the cursor
    $query->closeCursor();

    // Returns discs list
    return $artists;
  }

  public function getArtistDiscsList($artist_id)
  {
    $db = $this->dbconnect();
    // The SELECT query
    $request = "SELECT disc.*, artist_name 
                FROM disc 
                INNER JOIN artist a 
                ON disc.artist_id = a.artist_id 
                WHERE disc.artist_id = :artist_id";
 
    // Prepares the statement for execution and returns the statement object
    $stmt = $db->prepare($request);

    // Binds the disc_id value to the disc_id variable
    $stmt->bindValue(':artist_id', $artist_id);

    // Executes the prepared statement
    $stmt->execute(); 

    // Fetches the disc with the given ID
    $artistDiscsList = $stmt->fetchALL(PDO::FETCH_OBJ);

    // Closes the cursor
    $stmt->closeCursor();

    // Returns the artist discs list
    return $artistDiscsList;
  }

  public function getArtistDetails($artist_id)
  {
    $db = $this->dbconnect();
    //The SELECT query
    $request = "SELECT * 
                FROM artist
                WHERE artist_id = :artist_id";

    // Prepares the statement for execution and returns the statement object
    $stmt = $db->prepare($request);

    // Binds the disc_id value to the disc_id variable
    $stmt->bindValue(':artist_id', $artist_id);

    // Executes the prepared statement
    $stmt->execute();

    // Fetches the disc with the given ID
    $artist = $stmt->fetch(PDO::FETCH_OBJ);

    // Closes the cursor
    $stmt->closeCursor();

    // Returns the disc details
    return $artist;
  }

  public function update(array $items): void
  {
    $db = $this->dbconnect();
    // The SELECT query
    $request = "UPDATE artist
                SET artist_name = :artist_name
                WHERE artist_id = :artist_id";

    // Prepares the statement for execution and returns the statement object
    $stmt = $db->prepare($request);

    // Executes the prepared statement
    $stmt->execute($items);

    // Closes the cursor
    $stmt->closeCursor();
  }

  public function delete($artist_id)
  {
    $db = $this->dbconnect();
    // The DELETE request
    $request = "DELETE
                FROM artist
                WHERE artist_id = :artist_id";

    // Prepares the statement for execution and returns the statement object
    $delete = $db->prepare($request);

    // Binds the disc_id value to the disc_id variable
    $delete->bindValue(':artist_id', $artist_id);

    // Executes the prepared statement
    $delete->execute();

    // Closes the cursor
    $delete->closeCursor();
  }
}