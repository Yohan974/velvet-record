<?php
require_once "Database.php";

class Disc extends Database
{

  public function create(array $items): void
  {
    $db = $this->dbconnect();
    // The INSERT request
    $request = "INSERT INTO disc 
                (disc_title, disc_year, disc_picture, disc_label, disc_genre, disc_price, artist_id) 
                VALUE (:disc_title, :disc_year, :disc_picture, :disc_label, :disc_genre, :disc_price, :artist_id)";

    // Prepares the statement for execution and returns the statement object
    $insert = $db->prepare($request);

    // Executes the prepared statement
    $insert->execute($items);

    // Closes the cursor
    $insert->closeCursor();
  }

  public function getDiscsList()
  {
    $db = $this->dbconnect();
    // The SELECT query
    $request = "SELECT disc.*, artist_name 
                FROM disc 
                INNER JOIN artist a 
                ON disc.artist_id = a.artist_id 
                ORDER BY disc_id DESC";

    // Prepares the statement for execution and returns the statement object
    $query = $db->query($request);

    // Fetches all the discs from the query as an Object
    $discs = $query->fetchALL(PDO::FETCH_OBJ);

    // Closes the cursor
    $query->closeCursor();

    // Returns discs list
    return $discs;
  }

  public function getDiscDetails($disc_id) 
  {
    $db = $this->dbconnect();
    // The SELECT query
    $request = "SELECT disc.*, artist_name 
                FROM disc 
                INNER JOIN artist a 
                ON disc.artist_id = a.artist_id 
                WHERE disc_id = :disc_id";

    // Prepares the statement for execution and returns the statement object
    $stmt = $db->prepare($request);

    // Binds the disc_id value to the disc_id variable
    $stmt->bindValue(':disc_id', $disc_id);

    // Executes the prepared statement
    $stmt->execute(); 

    // Fetches the disc with the given ID
    $disc = $stmt->fetch(PDO::FETCH_OBJ);

    // Closes the cursor
    $stmt->closeCursor();

    // Returns the disc details
    return $disc;
  }

  public function update(array $items): void
  {
    $db = $this->dbconnect();
    // The SELECT query
    $request = "UPDATE disc
                SET disc_title = :disc_title,
                    disc_year = :disc_year,
                    disc_picture = :disc_picture,
                    disc_label = :disc_label,
                    disc_genre = :disc_genre,
                    disc_price = :disc_price,
                    artist_id = :artist_id
                WHERE disc_id = :disc_id";

    // Prepares the statement for execution and returns the statement object
    $stmt = $db->prepare($request);

    // Executes the prepared statement
    $stmt->execute($items);

    // Closes the cursor
    $stmt->closeCursor();
  }

  public function delete($disc_id)
  {
    $db = $this->dbconnect();
    // The DELETE request
    $request = "DELETE
                FROM disc
                WHERE disc_id = :disc_id";

    // Prepares the statement for execution and returns the statement object
    $delete = $db->prepare($request);

    // Binds the disc_id value to the disc_id variable
    $delete->bindValue(':disc_id', $disc_id);

    // Executes the prepared statement
    $delete->execute();

    // Closes the cursor
    $delete->closeCursor();
  }

  public function getLastDisc()
  {
    $db = $this->dbconnect();
    // The SELECT request
    $request = "SELECT disc_id
                FROM disc
                ORDER BY disc_id DESC LIMIT 0,1";

    // Prepares the statement for execution and returns the statement object
    $query = $db->query($request);

    // Fetches all the discs from the query as an Object
    $lastDisc = $query->fetch(PDO::FETCH_OBJ);

    // Closes the cursor
    $query->closeCursor();

    // Returns the last disc
    return $lastDisc;
  }
}