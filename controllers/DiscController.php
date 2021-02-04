<?php
require_once "models/Disc.php";
require_once "models/Artist.php";

function newDisc()
{
  // Sets the page's title
  $title = "Velvet Records - New Disc";

  // Creates a new Artist model instance
  $artist = new Artist();

  // Gets the artists
  $artists = $artist->getArtistsList();

  require "views/discs/new.php";
}

function createDisc()
{
  // Sets the page's title
  $title = "Velvet Records - New Disc";

  // Creates a new Artist model instance
  $artist = new Artist();
  
  // Creates a new Disc model instance
  $disc = new Disc();

  // Gets the artists
  $artists = $artist->getArtistsList();

  // Get the disc list
  $discs = $disc->getDiscsList();

  // Gets the last id
  $discId = $disc->getLastDisc();
  $discId = ($discId->disc_id) + 1;

  // Here lies all the forms variables
  $artistId = $genre = $label = $price = $year = $discTitle = "";

  // An array filled the with the form input errors
  $errors = [];

  // If the request method used is POST
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the is not empty
    if (!empty($_POST["artistName"])) {
      // It filters the input and makes it safe to insert into the database
      $artistId = filter_input(INPUT_POST, "artistName", FILTER_SANITIZE_NUMBER_INT);
    } else {
      $errors["artistName"] = "Vous devez choisir un artiste.";
    }
    
    // If the value is not empty
    if (!empty($_POST["genre"])) {
        // If the value is valid
        if (preg_match("/^[^<>&]+$/i", $_POST["genre"])) {
            // It filters the input and makes it safe to insert into the database
            $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            // If it's not valid it asks the user to give a valid genre
            $errors["genre"] = "Le genre n'est pas valide.";
        }
    } else {
        // If it's empty it asks the user to give a genre
        $errors["genre"] = "Le genre est requis.";
    }

    if (!empty($_POST["label"])) {
        if (preg_match("/^[^<>&]+$/i", $_POST["label"])) {
            $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $errors["label"] = "Le label n'est pas valide.";
        }
    } else {
        $errors["label"] = "Le label est requis.";
    }

    if (!empty($_POST["price"])) {
        if (preg_match("/^(\d{0,4}[.]?)\d{0,2}$/", $_POST["price"])) {
            $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        } else {
            $errors["price"] = "Le prix n'est pas valide.";
        }
    } else {
        $errors["price"] = "Le prix est requis.";
    }

    if (!empty($_POST["year"])) {
        if (preg_match("/^(19|20)\d{2}$/", $_POST["year"])) {
            $year = filter_input(INPUT_POST, "year", FILTER_SANITIZE_NUMBER_INT);
        } else {
            $errors["year"] = "L'année n'est pas valide.";
        }
    } else {
        $errors["year"] = "L'année est requise.";
    }

    if (!empty($_POST["title"])) {
        if (preg_match("/^[^<>&]+$/i", $_POST["title"])) {
            $discTitle = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $errors["title"] = "Le titre n'est pas valide.";
        }
    } else {
        $errors["title"] = "Le titre est requis.";
    }

    // We put all allowed mime type in a array
    $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

    // Returns true is the file exists
    $fileExists = isset($_FILES) ? count($_FILES) : 0;

    // List of error messages
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );

    // Get the file exist
    if ($fileExists && $_FILES["picture"]["size"] > 0) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($_FILES["picture"]["tmp_name"]);
    } else {
        $mimeType = null;
        $errors["picture"] = "The image is required.";
    }

    // If there is any error
    if (!empty($_FILES["picture"]["error"])) {
        // Stores the error message in the formErrors array
        $errors["image"] = $phpFileUploadErrors[$_FILES["picture"]["error"]];
    }

    // If the file don't have an allowed mime type and there's no error
    if (!in_array($mimeType, $aMimeTypes) && empty($_FILES["picture"]["error"])) {
        // Stores the error message in the formErrors array
        $errors["image"] = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION) . " file is not supported.";
    }

    // Checks that there is no error in the form and image and that the mime type is allowed
    if ($_FILES["picture"]["error"] == 0 && in_array($mimeType, $aMimeTypes) && empty($errors)) {
        $extension = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
        $path = realpath("assets\img");
        $name = basename($discId);
        
       // Moves the new uploaded file to the right img folder
       move_uploaded_file($_FILES["picture"]["tmp_name"], "$path/$name.$extension");

       // Creates the disc with the form data given by the user
       $disc->create([
           ":disc_year" => $year,
           ":disc_picture" => "$name.$extension",
           ":disc_label" => $label,
           ":disc_title" => $discTitle,
           ":disc_genre" => $genre,
           ":disc_price" => $price,
           ":artist_id" => $artistId
       ]);

       // Redirects the user to the discs list view
       header("Location: index.php?action=discsList");
    } else {
        require "views/discs/new.php";
    } 
    }
}

function discsList()
{
  // Sets the page's title
  $title = "Velvet Records - Discs Gallery";

  // Creates a new Disc model instance
  $disc = new Disc();

  // Gets the list of all discs
  $discs = $disc->getDiscsList();
  // $data = $discs->fetchALL(PDO::FETCH_OBJ);

  require "views/discs/list.php";
}

function discDetails()
{
  // Sets the page's title
  $title = "Velvet Records - Edit";

  // Creates a new Disc model instance
  $disc = new Disc();

  // Creates a new Artist model instance
  $artists = new Artist();

  // Get the disc details
  $discDetails = $disc->getDiscDetails($_GET["id"]);

  // Gets the artists
  $artists = $artists->getArtistsList();

  require "views/discs/details.php";
}

function updateDisc()
{
  // Sets the page's title
  $title = "Velvet Records - Edit Disc";

  // Creates a new Artist model instance
  $artist = new Artist();
  
  // Creates a new Disc model instance
  $disc = new Disc();

  // Gets the artists
  $artists = $artist->getArtistsList();

  // Grabs the GET input and filters it
  $discId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

  // Get the disc details
  $discDetails = $disc->getDiscDetails($discId);
  $discs = $disc->getDiscsList();
  
  // Here lies all the forms variables
  $artistId = $genre = $label = $price = $year = $discTitle = "";

  // List of error messages
  $phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with success',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk.',
    8 => 'A PHP extension stopped the file upload.',
    );

  // An array filled the with the form input errors
  $errors = [];

  // If the request method used is POST
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the is not empty
    if (!empty($_POST["artistName"])) {
      // It filters the input and makes it safe to insert into the database
      $artistId = filter_input(INPUT_POST, "artistName", FILTER_SANITIZE_NUMBER_INT);
    } else {
      $errors["artistName"] = "Vous devez choisir un artiste.";
    }
    
    // If the value is not empty
    if (!empty($_POST["genre"])) {
        // If the value is valid
        if (preg_match("/^[^<>&]+$/i", $_POST["genre"])) {
            // It filters the input and makes it safe to insert into the database
            $genre = filter_input(INPUT_POST, "genre", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            // If it's not valid it asks the user to give a valid genre
            $errors["genre"] = "The genre is not valid.";
        }
    } else {
        // If it's empty it asks the user to give a genre
        $errors["genre"] = "The genre is required.";
    }

    if (!empty($_POST["label"])) {
        if (preg_match("/^[^<>&]+$/i", $_POST["label"])) {
            $label = filter_input(INPUT_POST, "label", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $errors["label"] = "The label is not valid.";
        }
    } else {
        $errors["label"] = "The label is required.";
    }

    if (!empty($_POST["price"])) {
        if (preg_match("/^(\d{0,4}[.]?)\d{0,2}$/", $_POST["price"])) {
            $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        } else {
            $errors["price"] = "The price is required.";
        }
    } else {
        $errors["price"] = "The price is required.";
    }

    if (!empty($_POST["year"])) {
        if (preg_match("/^(19|20)\d{2}$/", $_POST["year"])) {
            $year = filter_input(INPUT_POST, "year", FILTER_SANITIZE_NUMBER_INT);
        } else {
            $errors["year"] = "The year is not valid.";
        }
    } else {
        $errors["year"] = "The year is required.";
    }

    if (!empty($_POST["title"])) {
        if (preg_match("/^[^<>&]+$/i", $_POST["title"])) {
            $discTitle = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
        } else {
            $errors["title"] = "The title is not valid.";
        }
    } else {
        $errors["title"] = "The title is required.";
    }

    // We put all allowed mime type in a array
    $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

    // Returns true is the file exists
    $fileExists = isset($_FILES) ? count($_FILES) : 0;

    // Get the file type via FILEINFO
    if ($fileExists && $_FILES["picture"]["size"] > 0) {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($_FILES["picture"]["tmp_name"]);
    } else {
        $mimeType = null;
    }

    // If the file don't have an allowed mime type and there's no error
    if (!in_array($mimeType, $aMimeTypes) && empty($_FILES["picture"]["error"])) {
        // Stores the error message in the formErrors array
        $errors["image"] = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION) . " file is not supported.";
    }

    // If the user don't upload an image we keep the old one
    if ($_FILES["picture"]["error"] === 4 && empty($errors)) {
            $disc->update([
                ":disc_year" => $year,
                ":disc_picture" => $discDetails->disc_picture,
                ":disc_label" => $label,
                ":disc_title" => $discTitle,
                ":disc_genre" => $genre,
                ":disc_price" => $price,
                ":artist_id" => $artistId,
                ":disc_id" => $discId
            ]);
            // Redirects the user to the discs list view
            header("Location: index.php?action=discsList");
    }
    

    // If the error is not a UPLOAD_ERR_NO_FILE error or UPLOAD_ERR_OK
    if ($_FILES["picture"]["error"] !== 4 && $_FILES["picture"]["error"] !== 0) {
        // Stores the error message in the formErrors array
        $errors["image"] = $phpFileUploadErrors[$_FILES["picture"]["error"]];
    }

    // Checks that there is no error in the form and image and that the mime type is allowed
    if ($_FILES["picture"]["error"] == 0 && in_array($mimeType, $aMimeTypes) && empty($errors)) {
        $extension = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
        $path = realpath("assets\img");
        $name = basename($discId);
        
       // Moves the new uploaded file to the right img folder
       move_uploaded_file($_FILES["picture"]["tmp_name"], "$path/$name.$extension");

       // Updates the disc with the form data given by the user
       $disc->update([
           ":disc_year" => $year,
           ":disc_picture" => "$name.$extension",
           ":disc_label" => $label,
           ":disc_title" => $discTitle,
           ":disc_genre" => $genre,
           ":disc_price" => $price,
           ":artist_id" => $artistId,
           ":disc_id" => $discId
       ]);

       // Redirects the user to the discs list view
       header("Location: index.php?action=discsList");
    } else {
        require "views/discs/details.php";
    } 
    }
}

function deleteDisc() 
{
    //Create a new disc model instance
    $disc = new Disc();

    //delete the disc
    $disc->delete($_GET["id"]);

    header("Location: index.php?action=discsList");
}

