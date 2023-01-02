<center><?php 

$conn = mysqli_connect('localhost','SRIDHALA','Sri@2003','train');

	$sql="SELECT PNR,TRAIN_NO,SP,DP,JOURNEY_DATE,TICKET_FARE,NO_OF_SEAT,CLASS,STATUS FROM RESERVATION WHERE PNR=(SELECT MAX(PNR) FROM RESERVATION)";
	$result1=mysqli_query($conn,$sql);
	
	
	
	while($row = mysqli_fetch_array($result1)){
		$sri=$row['TRAIN_NO'];
		$source=$row['SP'];
		$des=$row['DP'];
		$pnrno=$row['PNR'];
		$jd=$row['JOURNEY_DATE'];
		$tf=$row['TICKET_FARE'];
		$class=$row['CLASS'];
		$seat_count=$row['NO_OF_SEAT'];
		$status=$row['STATUS'];
	}
	//echo $sri;
	
	$sql1="SELECT TRAIN_NAME FROM TRAIN WHERE TRAIN_NO='$sri'";   
	$result2=mysqli_query($conn,$sql1);
	
	$start_time="SELECT DEPARTURE_TIME FROM SCHEDULE WHERE STATION_NAME='".$source."' AND TRAIN_NO='".$sri."'";
	$depart_time="SELECT DEPARTURE_TIME FROM SCHEDULE WHERE STATION_NAME='".$des."' AND TRAIN_NO='".$sri."'";
	
	$start=mysqli_query($conn,$start_time);
	$end=mysqli_query($conn,$depart_time);
	
	$pass="SELECT P_NAME,P_AGE,P_GENDER,SEAT_NO FROM PASSENGER_DETAILS WHERE PNR='".$pnrno."'";
	$passenger=mysqli_query($conn,$pass);
	
	echo "<br><br><br><br>";
	
		if(mysqli_num_rows($result2)>0){
			if(mysqli_num_rows($start)>0){
				if(mysqli_num_rows($end)>0){
					echo "<table border='1'>";
					echo "<tr>";
						echo "<th>PNR </th>";
						echo "<th>TRAIN NAME  </th>";
						echo "<th>TRAIN NO </th>";
						echo "<th>STARTING POINT  </th>";
						echo "<th>REACHING POINT  </th>";
						echo "<th>STARTS AT</th>";
						echo "<th>REACH AT</th>";
						echo "<th>SEAT CLASS</th>";
						echo "<th>JOURNEY DATE</th>";
						echo "<th>NUMBER OF TICKET</th>";
						echo "<th>TICKET FARE</th>";
						
					echo "</tr>";
					
						while($row2=mysqli_fetch_array($result2)){
							while($row3=mysqli_fetch_array($start)){
								while($row4=mysqli_fetch_array($end)){
									echo "<tr>";
										echo "<td>".$pnrno."</td>";
										echo "<td>".$row2['TRAIN_NAME']."</td>";
										echo "<td>".$sri."</td>";
										echo "<td>".$source."</td>";
										echo "<td>".$des."</td>";
										echo "<td>".$row3['DEPARTURE_TIME']."</td>";
										echo "<td>".$row4['DEPARTURE_TIME']."</td>";
										echo "<td>".$class."</td>";
										echo "<td>".$jd."</td>";
										echo "<td>".$seat_count."</td>";
										echo "<td>".$tf."</td>";
									echo "</tr>";		
								}
							}
						}
					
					echo "</table>";
					
				}
			}
		}
		
		echo "<br><br><br><br>";
		
		if(mysqli_num_rows($passenger)>0){
			echo "<table border='1'>";
					echo "<tr>";
						echo "<th>PASSENGER NAME </th>";
						echo "<th>AGE </th>";
						echo "<th>GENDER </th>";
						echo "<th>SEAT NUMBER </th>";
					echo "</tr>";
						
					while($row5=mysqli_fetch_array($passenger)){
						echo "<tr>";
						echo "<td>".$row5['P_NAME']."</td>";
						echo "<td>".$row5['P_AGE']."</td>";
						echo "<td>".$row5['P_GENDER']."</td>";
						echo "<td>".$row5['SEAT_NO']."</td>";
						echo "</tr>";
					}
			echo "</table>";
		}
		echo "<br><br><br><br>";
		echo "STATUS : ";
		echo $status;
	

					
	
?></center>