<?php
$today = getdate();
print_r("<h1>Datoen</h1>");
print_r($today);
print_r("<br>");
print_r("I dag er det $today[mday] den $today[month] $today[year]");
echo "<br>";

print_r("<h1>Time</h1>");
$time = time();
print_r("Time is $today[hours]-$today[minutes]-$today[seconds] .<br>");

$browserAgent = $_SERVER['HTTP_USER_AGENT'];
echo "your shitty broser is $browserAgent";

print_r("<h1> Substring </h1>");
$words = "This is not a sentence";
$lenghtOfString = strlen($words);
print_r("$words <br>");
print_r("Not sentence is $lenghtOfString charecters long <br>");

$wordsarray = str_split($words);

for ($x = 0; $x <= 10; $x++) {
	echo "The [$x] charecter is: $wordsarray[$x] <br>";
}
print_r("<br>");
for ($x = $lenghtOfString - 1; $x >= 7; $x--) {
	echo "The [$x] charecter is: $wordsarray[$x] <br>";
}

echo "<br>";
$explotion = explode(' ', $words);
$countExplotion = count($explotion) - 1;
echo $explotion[$countExplotion];
echo "<br>";
echo $explotion[($countExplotion - 1)];
echo "<br>";
echo $explotion[($countExplotion - 2)];
echo "<br>";


?>
<!DOCTYPE html>
<html>

<form action="" method="POST">
	Name: <input type="text" name="name"><br>
	<input type="submit">
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// collect value of input field
	$name = $_POST['name'];
	if (empty($name)) {
		echo "Name is empty";
	} else {
		echo $name;
	}
}
?>

</html>

<?php
echo "<br>";
print_r(rand());
echo "<br>";
print_r(rand(100, 99999));


echo "<h1> The Fizzbuzz test</h1>";

for ($i = 1; $i < 100; $i++) {
	if (($i % 3 == 0)) {
		echo "fizz";
	}
	if (($i % 5 == 0)) {
		echo "buzz";
	} else if ($i % 5 != 0 && $i % 3 != 0) {
		echo $i;
	}
	echo ", ";
}


echo "<br> <h1> Tables </h1>"






?>


<!DOCTYPE html>
<html>

<style>
	table,
	th,
	td {
		border: 1px solid black;
	}

	.gray {
		background-color: gray;
		font-weight: bolder;
	}
</style>


<table>
	<tr>
		<?php
		for ($rownumber = 1; $rownumber <= 10; $rownumber++) {
			echo "<tr>";
			for ($i = 1; $i <= 10; $i++) {
				if ($i == $rownumber) {
					echo "<td class='gray'>";
				} else {
					echo "<td>";
				}
				echo $i * $rownumber;
				echo "</td>";
			}
			echo "</tr>";
		}
		?>
	</tr>
</table>

</html>

<?php

$modstandsListe = [1.0, 1.1, 1.2, 1.3, 1.5, 1.6, 1.8, 2.0, 2.2, 2.4, 2.6, 2.9, 3.2, 3.5, 3.8, 4.2, 4.6, 5.1, 5.6, 6.2, 6.8, 7.5, 8.3, 9.1];
$arrayForCalculatedModstande = [];
$listOfCombinationsOfOM = [];
echo "<h1> Modstandsrækker </h1>";
for ($i = 0; $i < count($modstandsListe); $i++) {

	for ($dekander = 0; $dekander < 6; $dekander++) {
		$calculatedResistences = ($modstandsListe[$i]) * pow(10.0, $dekander);
		array_push($arrayForCalculatedModstande, $calculatedResistences);
		echo $calculatedResistences;
		echo ", ";
	}
}
echo "<br> <h1> Kombination </h1>";
for ($i = 0; $i < count($arrayForCalculatedModstande); $i++) {


	for ($j = 0; $j < count($arrayForCalculatedModstande); $j++) {
		if ($j != $i) {
			$sum = $arrayForCalculatedModstande[$i] + $arrayForCalculatedModstande[$j];
			if (!in_array($sum, $listOfCombinationsOfOM)) {
				array_push($listOfCombinationsOfOM, $arrayForCalculatedModstande[$i] + $arrayForCalculatedModstande[$j]);
				echo $arrayForCalculatedModstande[$i] + $arrayForCalculatedModstande[$j];
				echo ", ";
			}
		}
	}
}
echo "<br> Count is ";
echo count($listOfCombinationsOfOM);




?>