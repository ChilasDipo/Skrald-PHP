<?php
$number;
session_start();

function connect()
{
	return mysqli_connect('localhost', 'root', '', 'dbopgave');
}


function newGame()
{
	$q = "TRUNCATE TABLE game";
	$res = mysqli_query(connect(), $q);
	insertNewRandomNumberTODB();
}

?>
<!DOCTYPE html>
<html>

<body>
	<form action="" method="POST">
		Gæt et tal mellem 0 og 1000: <input type="number" name="guessingGame"><br>
		<input type="submit">
	</form>



</body>

</html>

<?php


function insertNewRandomNumberTODB()
{
	$newNumber = rand(0, 1000);
	$q = "INSERT INTO `game`( `number`, `guessed`) VALUES ('$newNumber','0')";
	$res = mysqli_query(connect(), $q);
}

$q = "SELECT * FROM game ORDER BY guessed";
$res = mysqli_query(connect(), $q);
$row = mysqli_fetch_array($res);
$number = $row["number"];
echo $number;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// collect value of input field
	$guessedNumber = $_POST['guessingGame'];
	if (!empty($guessedNumber)) {
		$_SESSION[$guessedNumber]
		if ($number < $guessedNumber) {
			echo "Du har gættet for højt";
		} elseif ($number > $guessedNumber) {
			echo "Du har gættet for lavt";
		} elseif ($number == $guessedNumber) {
			echo "Du har gættet rigtigt";

			$q = "UPDATE game
			SET guessed='1'
			WHERE number='$number'";
			$res = mysqli_query(connect(), $q);

			insertNewRandomNumberTODB();

			$q = "SELECT * FROM game ORDER BY guessed";
			$res = mysqli_query(connect(), $q);
			$row = mysqli_fetch_array($res);
			$number = $row["number"];
			echo $number;
		}
	} else {
		echo "No number has been input in the numberField";
	}
}
echo $_SESSION[];
echo "<br>";

$q = "SELECT * FROM game Where guessed = '1'";
$res = mysqli_query(connect(), $q);

echo "<br> Tidligere gættede tal er <br>";
while ($row = $res->fetch_assoc()) {
	printf("%s <br>\n", $row["number"]);
}

?>
<!DOCTYPE html>
<html>


</html>