<html>
<head>
<style>
table
{

border-style:solid;

border-width:3px;

border-color:black;

}
</style>
</head>
<body>
<center><?php 

$conn = mysqli_connect('localhost','SRIDHALA','Sri@2003','train');

if(isset($_POST['trainno'])){
    
    $trainnum=$_POST["trainno"];
	$sou=$_POST["source"];
	$des=$_POST["destination"];
    $sql="select * from schedule where s_id between (select s_id from schedule where station_name='".$sou."' and train_no='".$trainnum."') and (select s_id from schedule where station_name='".$des."' and train_no='".$trainnum."')";
   
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)>0){
		echo "<table border='1'>";
			echo "<tr>";
				echo "<th>STATION NAME  </th>";
				echo "<th>ARRIVAL TIME  </th>";
				echo "<th>DEPARTING TIME  </th>";
				echo "<th>PLATFORM  </th>";
				echo "<th>DAY  </th>";
				echo "<th>DISTANCE </th>";
			echo "</tr>";
        while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
				echo "<td>".$row['STATION_NAME']."</td>";
				echo "<td>".$row['ARRIVAL_TIME']."</td>";
				echo "<td>".$row['DEPARTURE_TIME']."</td>";
				echo "<td>".$row['PLATFORM']."</td>";
				echo "<td>".$row['DAY']."</td>";
				echo "<td>".$row['DISTANCE']."</td>";
			echo "</tr>";	
		}
		echo "</table>";
		exit();
    }
    else{
        echo " no routes!!!!";
        exit();
    }
        
}
?></center>
</body>

</html>