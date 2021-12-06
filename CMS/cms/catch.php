<?php
include 'include/functions.php';

//first get the owner ID based on the adress of the sensor
$owner = address2id(mysqli_real_escape_string(connect(),$_GET['API']));

if($owner!=0)   //if ownerID is found
{
    //get current date and data
    $date = date("Y-m-d H:i:s");
    $data = mysqli_real_escape_string(connect(),$_GET['data']);
    
    //insert into DB
    $q ="INSERT INTO `rest_data` (`date`, `owner`, `data`) VALUES ('$date', '$owner', '$data')";
    $res=mysqli_query(connect(), $q);
    echo 'Success!';
}
else    //No ownerID found
{
    echo 'Unknown address';
}

?>