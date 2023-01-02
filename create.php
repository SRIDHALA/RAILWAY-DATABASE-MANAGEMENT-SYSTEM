<div style="text-align:center">
			<form method="POST" action="create.php">
			<div class="form-input">
			<p>
			<label>GMAIL:</label>
			<input type="text" name="gmail" />	
			</p>
			</div>
			<div class="form-input">
			<p>
			<label>PASSWORD:</label>
			<input type="text" name="password"/>	
			</p>
			</div>
			<div class="form-input">
			<p>
			<label>DOB:</label>
			<input type="date" name="dob" />	
			</p>
			</div>
			<div class="form-input">
			<p>
			<label>PHONE:</label>
			<input type="text" name="phone" />	
			</p>
			</div>
			<input type="submit" name="submit" value="CREATE" class="btn-login"/>
			</form>
</div>




<center><?php 

$conn = mysqli_connect('localhost','SRIDHALA','Sri@2003','train');
if(isset($_POST['gmail'])){
	$ugmail=$_POST['gmail'];
    $upassword=$_POST['password'];
	$udob=$_POST['dob'];
	$uphone=$_POST['phone'];
    
    $insert="INSERT INTO USER_DETAILS (GMAIL,U_PASSWORD,D_O_B,PHONE) VALUES ('$ugmail','$upassword','$udob','$uphone')";
        
	if(mysqli_query($conn,$insert)){
		header("Location: train_det.html");
	}
	else{
		echo "RETRY!!!!";
	}
}
?></center>