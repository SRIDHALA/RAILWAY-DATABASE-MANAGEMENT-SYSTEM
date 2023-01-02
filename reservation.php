<center><?php 

$conn = mysqli_connect('localhost','SRIDHALA','Sri@2003','train');

if(isset($_POST['submit'])){
    
    $trainnum=$_POST['trainno'];
    $source=$_POST['source'];
	$destination=$_POST['destination'];
	$sclass=$_POST['seat_class'];
    $seat_count=$_POST['num_seat'];
	$travel_date=$_POST['t_date'];
	
	$seat_left="SELECT SEATS_LEFT FROM SEATS WHERE TRAIN_NO='$trainnum' AND CLASS='$sclass' AND JOURNEY_DATE='$travel_date' AND SP='$source' AND DP='$destination'";
	
	$train_d_fare="SELECT DISTANCE_FARE FROM TRAIN WHERE TRAIN_NO='$trainnum'";
	
	$seats_fare="SELECT FARE FROM SEATS WHERE TRAIN_NO='$trainnum' AND JOURNEY_DATE='$travel_date' AND SP='$source' AND DP='$destination' AND CLASS='$sclass' ";
	
	$t_distance="SELECT DISTANCE FROM SCHEDULE WHERE TRAIN_NO='$trainnum' AND STATION_NAME='$destination'";
	
	$class_fare="SELECT S_FARE FROM SEAT_FARE WHERE SEAT_CLASS='$sclass'";
	
	$result1=(mysqli_query($conn,$seat_left));
	
	$result2=(mysqli_query($conn,$train_d_fare));
	
	$result3=(mysqli_query($conn,$seats_fare));
	
	$result4=(mysqli_query($conn,$t_distance));
	
	$result5=(mysqli_query($conn,$class_fare));
	
	while($row1 = mysqli_fetch_array($result1)){
		while($row2 = mysqli_fetch_array($result2)){
			while($row3 = mysqli_fetch_array($result3)){
				while($row4 = mysqli_fetch_array($result4)){
					while($row5=mysqli_fetch_array($result5)){
						if (($seat_count <= $row1['SEATS_LEFT']) and ($seat_count > 0)){
							$sql="INSERT INTO RESERVATION (TRAIN_NO,JOURNEY_DATE,SP,DP,CLASS,NO_OF_SEAT) VALUES ('$trainnum','$travel_date','$source','$destination','$sclass','$seat_count')";
							if(mysqli_query($conn,$sql)){
								echo "successfully inserted!!!";
								$fare_update="UPDATE RESERVATION SET TICKET_FARE=NO_OF_SEAT*(('$row4[DISTANCE]'*'$row2[DISTANCE_FARE]')+'$row3[FARE]'+'$row5[S_FARE]') WHERE PNR=(SELECT MAX(PNR) FROM RESERVATION)";
								if(mysqli_query($conn,$fare_update)){
									$seat_update="UPDATE SEATS SET SEATS_LEFT=(SEATS_LEFT-'$seat_count') WHERE TRAIN_NO='$trainnum' AND CLASS='$sclass' AND JOURNEY_DATE='$travel_date' AND SP='$source' AND DP='$destination'";
									$status_update="UPDATE RESERVATION SET STATUS='BOOKED' WHERE PNR=(SELECT MAX(PNR) FROM RESERVATION)";
									if(mysqli_query($conn,$seat_update)){
										if(mysqli_query($conn,$status_update)){
												echo "successfully updated ";
												header("Location: passenger.php");
										}
									}
								}
							}
							else{
								echo "not inserted!!!";
							}
						}
						else{
							echo "seats not available";
						}
					}
				}
			}
		}
	}
}
?></center>

