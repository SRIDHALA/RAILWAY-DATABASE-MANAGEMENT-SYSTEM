<center><?php 

$conn = mysqli_connect('localhost','SRIDHALA','Sri@2003','train');

if(isset($_POST['username'])){
    
    $uname=$_POST['username'];
    $password=$_POST['password'];
    
    $sql="select gmail,u_password from user_details where gmail='".$uname."' AND u_password='".$password."'";
    
    $result=mysqli_query($conn,$sql);
    
    if(mysqli_num_rows($result)==1){
        echo " You Have Successfully Logged in <br>";
		header("Location: train_det.html");
		exit();
    }
    else{
        echo " You Have Entered Incorrect Username/Password";
		echo '<br> <form method="POST" action="create.php">
			  <input type="submit" name="submit" value="CREATE USER"/>
			  </form>';
        exit();
    }
        
}
?></center>