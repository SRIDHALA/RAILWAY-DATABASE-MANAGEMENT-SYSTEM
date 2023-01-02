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
<div style="text-align:center">
<center><?php 

$conn = mysqli_connect('localhost','SRIDHALA','Sri@2003','train');

if(isset($_POST['source'])){
    
    $source=$_POST["source"];
    $destination=$_POST["destination"];
	$seat_class=$_POST["seatclass"];
	$jd=$_POST["journeydate"];
    
    $sql="SELECT S.TRAIN_NO,T.TRAIN_NAME,S.SP,S.DP,JOURNEY_DATE,CLASS,FARE,SEATS_LEFT FROM TRAIN T,SEATS S 
				WHERE S.TRAIN_NO=T.TRAIN_NO AND S.SP='".$source."' AND S.DP='".$destination."' AND S.CLASS='".$seat_class."' AND S.JOURNEY_DATE='".$jd."'";
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)>0){
		echo "<table border='1'>";
			echo "<tr>";
				echo "<th>TRAIN NO  </th>";
				echo "<th>TRAIN NAME  </th>";
				echo "<th>STARTING POINT  </th>";
				echo "<th>REACHING POINT  </th>";
				echo "<th>JOURNEY DATE  </th>";
				echo "<th>SEAT CLASS  </th>";
				echo "<th>SEAT FARE  </th>";
				echo "<th>AEATS AVAILABLE  </th>";
			echo "</tr>";
        while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
				echo "<td>".$row['TRAIN_NO']."</td>";
				echo "<td>".$row['TRAIN_NAME']."</td>";
				echo "<td>".$row['SP']."</td>";
				echo "<td>".$row['DP']."</td>";
				echo "<td>".$row['JOURNEY_DATE']."</td>";
				echo "<td>".$row['CLASS']."</td>";
				echo "<td>".$row['FARE']."</td>";
				echo "<td>".$row['SEATS_LEFT']."</td>";
			echo "</tr>";	
		}
		echo "</table>";
		echo '<br> <form method="POST" action="intermediatecities.php">
			  <div class="form-input">
				<p>
				<label>TRAIN NO:</label>
				<input type="text" name="trainno" placeholder="train no"/>	
				</p>
			  </div>
			  <div class="form-input">
				<p>
				<label>SOURCE:</label>
				<input type="text" name="source" placeholder="source"/>	
				</p>
			  </div>
			  <div class="form-input">
				<p>
				<label>DESTINATION:</label>
				<input type="text" name="destination" placeholder="destination"/>	
				</p>
			  </div>
			  <input type="submit"  value="VIEW ROUTE"/>
			  </form>';
		echo '<br> <form method="POST" action="reservation.html">
			  <input type="submit" name="submit" value="RESERVATION"/>
			  </form>';
			  
		echo '<br> <form method="POST" action="cancellation.html">
			  <input type="submit" name="submit" value="CANCELLATION"/>
			  </form>';
			  
		exit();
    }
    else{
        echo " no trains!!!";
        exit();
    }
        
}
?></center>
</div>
</body>

</html>