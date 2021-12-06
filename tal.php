<?php

function connect()
{
	return mysqli_connect('localhost','root','', 'dbopgave');
}

function insert(){
    for ($i=0; $i < 300 ; $i++) { 
       
        $randomTal = rand(1,1000);
        
        $q = "INSERT INTO `number`( `tal`) VALUES ('$randomTal')";
        $res=mysqli_query(connect(), $q);
    }   

    function writeNumbers(){

        $q = "SELECT * FROM number ORDER BY tal";
    $res=mysqli_query(connect(), $q);
    }

    
    }
function select(){

        $q = "SELECT * FROM number ORDER BY tal";
        $res=mysqli_query(connect(), $q);
        
        while ($row = $res->fetch_assoc()) {
            printf("tal = %s<br>\n", $row["tal"]);
        }
    }

    select();