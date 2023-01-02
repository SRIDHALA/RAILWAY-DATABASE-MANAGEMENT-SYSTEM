<center><?php 

$conn = mysqli_connect('localhost','SRIDHALA','Sri@2003','train');

if(isset($_POST['submit'])){
    
    $pnrnum=$_POST['pnrno'];
    
    $pnr_det="SELECT TRAIN_NO,SP,DP,CLASS,JOURNEY_DATE,TICKET_FARE,NO_OF_SEAT FROM RESERVATION WHERE PNR='$pnrnum'";
	
	$date = "SELECT DATEDIFF(JOURNEY_DATE,CURDATE()) FROM RESERVATION WHERE PNR='$pnrnum'";
    
    $result1=mysqli_query($conn,$pnr_det);
    
	$result2=mysqli_query($conn,$date);
	
	while($row1 = mysqli_fetch_array($result1)){
		while($row2 = mysqli_fetch_array($result2)){
			if ($row2['DATEDIFF(JOURNEY_DATE,CURDATE())']>0){
				$cancel="INSERT INTO CANCELLATION (PNR) VALUES ('$pnrnum')";
				if(mysqli_query($conn,$cancel)){
					$update_seat="UPDATE SEATS SET SEATS_LEFT=SEATS_LEFT+'$row1[NO_OF_SEAT]' WHERE TRAIN_NO='$row1[TRAIN_NO]' AND SP='$row1[SP]' AND DP='$row1[DP]' AND CLASS='$row1[CLASS]' AND JOURNEY_DATE='$row1[JOURNEY_DATE]'";
					if(mysqli_query($conn,$update_seat)){
						$update_status="UPDATE RESERVATION SET STATUS='CANCELLED' WHERE PNR='$pnrnum'";
						if(mysqli_query($conn,$update_status)){
							$update_ra="UPDATE CANCELLATION SET RETURN_AMOUNT='$row1[TICKET_FARE]'*0.5 WHERE PNR='$pnrnum'";
							if(mysqli_query($conn,$update_ra)){
								$ra="SELECT RETURN_AMOUNT FROM CANCELLATION WHERE PNR='$pnrnum'";
								$ramount=mysqli_query($conn,$ra);
								while($row3=mysqli_fetch_array($ramount)){
									echo "<br><br><br><br>";
									echo "SUCCESSFULLY CANCELLED!!! <br><br>";
									echo "Rs." .$row3['RETURN_AMOUNT']. " is refunded to your account.";
								}
							}
						}
					}
				}
			}
			else{
				echo "CANCELLATION IS NOT POSSIBLE!!!!";
			}
		}
	}
        
}
?></center>