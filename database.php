<?php

function connect()
{
	return mysqli_connect('localhost','root','', 'dbopgave');
}


function insert(){
    for ($i=0; $i < 11 ; $i++) { 
        $form = "kasse";
        $color = ["gul","grøn","rød","blå","sort","brun","lilla"];
        $weight = rand(10,50);
        $randomcolor = $color[rand(0,count($color)-1)];
        
        $q = "INSERT INTO `data`( `Form`, `Color`, `Weight`) VALUES ('$form','$randomcolor','$weight')";
        $res=mysqli_query(connect(), $q);
        echo $res;
    }   

    for ($i=0; $i < 6 ; $i++) { 
        $form = "cylindre";
        $color = ["grøn","blå"];
        $weight = 20;
        $randomcolor = rand(0,count($color)-1);
        
        $q = "INSERT INTO `data`(`Form`, `Color`, `Weight`) VALUES ('$form','$color[$randomcolor]','$weight')";
        $res=mysqli_query(connect(), $q);
    }

    for ($i=0; $i < 9; $i++) { 
        $form = "pyramider";
        $color = "rød";
        $weight = rand(0,5);
        
        
        $q = "INSERT INTO `data`( `Form`, `Color`, `Weight`) VALUES ('$form','$color','$weight')";
        $res=mysqli_query(connect(), $q);  
    }

}




function select(){

    $q = "SELECT * FROM data ORDER BY ID";
    $res=mysqli_query(connect(), $q);
    
    while ($row = $res->fetch_assoc()) {
        printf("ID = %s %s %s %s kg <br>\n", $row["ID"],$row["Form"], $row["Color"],$row["Weight"]);
    }
    

    echo "<br> <h1> Form </h1>";

    $q = "SELECT * FROM data ORDER BY Form";
    $res=mysqli_query(connect(), $q);
    
    while ($row = $res->fetch_assoc()) {
        printf("ID = %s %s %s %s kg <br>\n", $row["ID"], $row["Form"], $row["Color"],$row["Weight"]);
    }
    
    echo "<br> <h1> by color and Weight </h1>";

    $q = "SELECT * FROM data ORDER BY Color,Weight";
    $res=mysqli_query(connect(), $q);

    

    while ($row = $res->fetch_assoc()) {
        printf("ID = %s %s %s %s kg <br>\n", $row["ID"], $row["Form"], $row["Color"],$row["Weight"]);
    }

    

}
select()
?>