<?php
if (check_login($_SESSION['ID'],$_SESSION['user'])) {
    $sensorID = mysqli_real_escape_string(connect(),$_GET['sensorID']);
    
    //we should REALLY check if the person logged in owns this sensor!!!!
    
    //get the sensor type:
    $sensorType = id2type($sensorID);
    
    echo '<h1>Details for sensor:'.$sensorID.'</h1>';
    
    echo "
	<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>
	<script type=\"text/javascript\">
	google.load('visualization', '1.1', {packages: ['corechart','line']});
	google.setOnLoadCallback(drawChart);";
	
    if($sensorType==0)
    {
    	echo "
        function drawChart() 
        {
          var data = new google.visualization.DataTable();
          data.addColumn('datetime', 'Day');
          data.addColumn('number', 'Temp');
          data.addColumn('number', 'Humidity');
    
        ";
    		$q="SELECT * FROM `rest_data` WHERE `owner`='$sensorID' ORDER BY `date` DESC ";    
    
            $r=mysqli_query(connect(), $q);
        	while ($row= mysqli_fetch_assoc($r))
        	{
        	    $tempPos = strpos($row['data'],"temp");
        	    $humidityPos = strpos($row['data'],"humidity");
        	    
        	    $temp = substr($row['data'],$tempPos+4,2);
        	    $humidity = substr($row['data'],$humidityPos+8,2);
        	    
        	    $dE = explode('-',explode(' ',$row['date'])[0]); //date elements
        	    $tE = explode(':',explode(' ',$row['date'])[1]); //time elements
        	    echo 'data.addRow([ new Date('.$dE[0].','.($dE[1]-1).','.$dE[2].','.($tE[0]).','.$tE[1].','.$tE[2].',0), '.($temp).', '.($humidity).']);';
        	}
        
        echo "
          var options = 
          {
            hAxis: 
            {
              title: 'Time'
            },
            vAxis: 
            {
              title: 'Temp, Humidity'
            },
            backgroundColor: '#f1f8e9'
          };
    	  var chart = new google.visualization.LineChart(document.getElementById('linechart_material'));
          chart.draw(data, options);
        }
        </script>";
    }
    else if ($sensorType==1)
    {
        echo "
        function drawChart() 
        {
          var data = new google.visualization.DataTable();
          data.addColumn('datetime', 'Day');
          data.addColumn('number', 'Uniqiue visitors');
          data.addColumn('number', 'recurring visitors');
          data.addColumn('number', 'Total visitors');
        ";
            $uniqueVisitors=0;
            $visitors=0;
    		$q="SELECT * FROM `rest_data` WHERE `owner`='$sensorID' ORDER BY `date` ASC ";    
            $r=mysqli_query(connect(), $q);
        	while ($row= mysqli_fetch_assoc($r))
        	{
        	    if($row['data']=='0')   //add unique visitor
        	        $uniqueVisitors++;
        	    if($row['data']=='1')   //add recurring visitor
        	        $visitors++;
        	        
        	    $dE = explode('-',explode(' ',$row['date'])[0]); //date elements
        	    $tE = explode(':',explode(' ',$row['date'])[1]); //time elements
        	    echo 'data.addRow([ new Date('.$dE[0].','.($dE[1]-1).','.$dE[2].','.($tE[0]).','.$tE[1].','.$tE[2].',0), '.($uniqueVisitors).', '.($visitors).', '.($uniqueVisitors+$visitors).']);';
        	}
        
        echo "
          var options = 
          {
            hAxis: 
            {
              title: 'Time'
            },
            vAxis: 
            {
              title: 'Temp, Humidity'
            },
            backgroundColor: '#f1f8e9'
          };
    	  var chart = new google.visualization.LineChart(document.getElementById('linechart_material'));
          chart.draw(data, options);
        }
        </script>";
    }
    else if ($sensorType==6)
    {
        echo "
        function drawChart() 
        {
          var data = new google.visualization.DataTable();
          data.addColumn('datetime', 'Day');
          data.addColumn('number', 'PPM');
        ";
            $uniqueVisitors=0;
            $visitors=0;
    		$q="SELECT * FROM `rest_data` WHERE `owner`='$sensorID' ORDER BY `date` ASC ";    
            $r=mysqli_query(connect(), $q);
        	while ($row= mysqli_fetch_assoc($r))
        	{
        	    $dE = explode('-',explode(' ',$row['date'])[0]); //date elements
        	    $tE = explode(':',explode(' ',$row['date'])[1]); //time elements
        	    echo 'data.addRow([ new Date('.$dE[0].','.($dE[1]-1).','.$dE[2].','.($tE[0]).','.$tE[1].','.$tE[2].',0), '.($row['data']).']);';
        	}
        
        echo "
          var options = 
          {
            hAxis: 
            {
              title: 'Time'
            },
            vAxis: 
            {
              title: 'Temp, Humidity'
            },
            backgroundColor: '#f1f8e9'
          };
    	  var chart = new google.visualization.LineChart(document.getElementById('linechart_material'));
          chart.draw(data, options);
        }
        </script>";
    }
    else
    {
        echo "
        function drawChart() 
        {
          var data = new google.visualization.DataTable();
          data.addColumn('datetime', 'Day');
          data.addColumn('number', 'signal');
        ";
            $uniqueVisitors=0;
            $visitors=0;
    		$q="SELECT * FROM `rest_data` WHERE `owner`='$sensorID' ORDER BY `date` ASC ";    
            $r=mysqli_query(connect(), $q);
        	while ($row= mysqli_fetch_assoc($r))
        	{
        	    if($row['data']=='1')   //add unique visitor
        	        $uniqueVisitors++;
        	        
        	    $dE = explode('-',explode(' ',$row['date'])[0]); //date elements
        	    $tE = explode(':',explode(' ',$row['date'])[1]); //time elements
        	    echo 'data.addRow([ new Date('.$dE[0].','.($dE[1]-1).','.$dE[2].','.($tE[0]).','.$tE[1].','.$tE[2].',0), '.($uniqueVisitors).']);';
        	}
        
        echo "
          var options = 
          {
            hAxis: 
            {
              title: 'Time'
            },
            vAxis: 
            {
              title: 'Temp, Humidity'
            },
            backgroundColor: '#f1f8e9'
          };
    	  var chart = new google.visualization.LineChart(document.getElementById('linechart_material'));
          chart.draw(data, options);
        }
        </script>";
    }
    
    
    //show data graph
	echo '<div id="linechart_material" style="width: 100%; height: 400px"></div><br />';
	
	//Show clear button and raw sensor data:
	echo 'Clear sensor data - WARNING: THIS CANNOT BE UNDONE!';
	echo '<form action="include/sensorTruncate.php" method="GET"><input type="hidden" name="sensorID" value="'.$sensorID.'"><input type="submit" value="clear"></form>';
	
	$q="SELECT * FROM `rest_data` WHERE `owner`='$sensorID' ORDER BY `date` DESC ";    

    $r=mysqli_query(connect(), $q);
	//Show the raw data
	echo '<table border="1">';
	echo '<tr><td width="250">Time</td><td>Data</td></tr>';
    while ($row= mysqli_fetch_assoc($r))
	{
	    echo '<tr>';
	    echo '<td>'.$row['date'].'</td>';
	    echo '<td>'.$row['data'].'</td>';
	    echo '</tr>';
	}
	echo '</table>';
	
} 
else
{echo 'Du har ikke adgang til denne side. ';}
?>