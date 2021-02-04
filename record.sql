DROP DATABASE IF EXISTS record;
CREATE DATABASE record;
USE record;

CREATE TABLE `artist`
(
  `artist_id` INT PRIMARY KEY AUTO_INCREMENT,
  `artist_name` VARCHAR(255)
)
ENGINE=INNODB;

INSERT INTO `artist`
	(`artist_id`, `artist_name`)
VALUES
	(1, 'Neil Young'),
	(2, 'YES'),
	(3, 'Rolling Stones'),
	(4, 'Queens of the Stone Age'),
	(5, 'Serge Gainsbourg'),
	(6, 'AC/DC'),
	(7, 'Marillion'),
	(8, 'Bob Dylan'),
	(9, 'Fleshtones'),
	(10, 'The Clash');


CREATE TABLE `disc`
(
  `disc_id` INT PRIMARY KEY AUTO_INCREMENT,
  `disc_title` VARCHAR(255),
  `disc_year` SMALLINT,
  `disc_picture` VARCHAR(255),
  `disc_label` VARCHAR(255),
  `disc_genre` VARCHAR(255),
  `disc_price` DECIMAL(6, 2),
  `artist_id` INT NULL,
  FOREIGN KEY(artist_id) REFERENCES artist(artist_id)
)
ENGINE=INNODB;


INSERT INTO `disc`
	(`disc_id`, `disc_title`, `disc_year`, `disc_picture`, `disc_label`, `disc_genre`, `disc_price`, `artist_id`)
VALUES
	(1, 'Fugazi', 1984, 'Fugazi.jpeg', 'EMI', 'Prog', 14.99, 7),
	(2, 'Songs for the Deaf', 2002, 'Songs_for_the_Deaf.jpeg', 'Interscope Records', 'Rock/Stoner', 12.99, 4),
	(3, 'Harvest Moon', 1992, 'Harvest_Moon.jpeg', 'Reprise Records', 'Rock', 4.20, 1),
	(4, 'Initials BB', 1968, 'Initials_BB.jpeg', 'Philips', ' Chanson, Pop Rock', 12.99, 5),
	(5, 'After the Gold Rush', 1970, 'After_the_Gold_Rush.jpeg', ' Reprise Records', 'Country Rock', 20.00, 1),
	(6, 'Broken Arrow', 1996, 'Broken_Arrow.jpeg', 'Reprise Records', ' Country Rock, Classic Rock', 15.00, 1),
	(7, 'Highway To Hell', 1979, 'Highway_To_Hell.jpeg', 'Atlantic', 'Hard Rock', 15.00, 6),
	(8, 'Drama', 1980, 'Drama.jpeg', 'Atlantic', 'Prog', 15.00, 2),
	(9, 'Year of the Horse', 1997, 'Year_of_the_Horse.jpeg', 'Reprise Records', 'Country Rock, Classic Rock', 7.50, 1),
	(10, 'Ragged Glory', 1990, 'Ragged_Glory.jpeg', 'Reprise Records', 'Country Rock, Grunge', 11.00, 1),
	(11, 'Rust Never Sleeps', 1979, 'Rust_Never_Sleeps.jpeg', 'Reprise Records', 'Classic Rock, Arena Rock', 15.00, 1),
	(12, 'Exile on main street', 1972, 'Exile_on_main_street.jpeg', 'Rolling Stones Records', 'Blues Rock, Classic Rock', 33.00, 1),
	(13, 'London Calling', 1971, 'London_Calling.jpeg', 'CBS', 'Punk, New Wave', 33.00, 10),
	(14, 'Beggars Banquet', 1968, 'Beggars_Banquet.jpeg', 'Rolling Stones Records', 'Blues Rock, Classic Rock', 33.00, 1),
	(15, 'Laboratory of sound', 1995, 'Laboratory_of_sound.jpeg', 'Rebel Rec.', 'Rock', 33.00, 9);


