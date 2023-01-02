<center><?php 

$conn = mysqli_connect('localhost','SRIDHALA','Sri@2003','train');

$sql="SELECT MAX(PNR) FROM RESERVATION";

$result=mysqli_query($conn,$sql);

while($row1=mysqli_fetch_array($result)){
	$sri=$row1['MAX(PNR)'];
}

?></center>



<div style="text-align:center">
			<form method="POST" action="passenger.php">
			<div class="form-input">
			<p>
			<label>PNR:</label>
			<input type="text" name="pnrnum" value="<?php echo $sri ?>" />	
			</p>
			</div>
			<div class="form-input">
			<p>
			<label>NAME:</label>
			<input type="text" name="name"/>	
			</p>
			</div>
			<div class="form-input">
			<p>
			<label>AGE:</label>
			<input type="text" name="age" />	
			</p>
			</div>
			<div class="form-input">
			<p>
			<label>GENDER:</label>
			<input type="text" name="gender" />	
			</p>
			</div>
			<input type="submit" name="submit" value="ADD PASSENGER"/>
			</form>
</div>

<center><?php 

$conn = mysqli_connect('localhost','SRIDHALA','Sri@2003','train');
if(isset($_POST['submit'])){
	$pnrno=$_POST['pnrnum'];
    $pname=$_POST['name'];
	$age=$_POST['age'];
	$gender=$_POST['gender'];	
	
	$ticketcount="SELECT NO_OF_SEAT FROM RESERVATION WHERE PNR='$pnrno'";
	$result1=mysqli_query($conn,$ticketcount);
	$pnrcount="SELECT COUNT(P_NAME) FROM PASSENGER_DETAILS WHERE PNR='$pnrno'";
	$result2=mysqli_query($conn,$pnrcount);
	
	while($row1 = mysqli_fetch_array($result1)){
		while($row2 = mysqli_fetch_array($result2)){
			if ($row1['NO_OF_SEAT'] > $row2['COUNT(P_NAME)']) {
				if ($age >= 5){
					$insert="INSERT INTO PASSENGER_DETAILS(PNR,P_NAME,P_AGE,P_GENDER) VALUES('$pnrno','$pname','$age','$gender')";
					if(mysqli_query($conn,$insert)){
						echo "<br>";
					}
				}
				else{
					echo "no need of ticket";
				}
			}
			else{
				header("Location: ticket.php");
			}
		}	
	}
}
?></center>