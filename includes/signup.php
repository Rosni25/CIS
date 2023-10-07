<?php
error_reporting(0);
if(isset($_POST['submit']))
{
$fname=$_POST['fname'];
$mnumber=$_POST['mobilenumber'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$ran_id=  rand(time(), 100000000);
$status = "Active now";
$sql="INSERT INTO  tblusers(unique_id,FullName,MobileNumber,EmailId,Password,status) VALUES(:ran_id,:fname,:mnumber,:email,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':ran_id',$ran_id,PDO::PARAM_INT);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="You are Scuccessfully registered. Now you can login ";
header('location:thankyou.php');
}
else 
{
$_SESSION['msg']="Something went wrong. Please try again.";
header('location:thankyou.php');
}
}
?>
<style>
	#uspan,
#aspan,
#rspan,
#pspan,
#cspan,
#espan {
    color: red;
}
</style>
<!--Javascript for check email availabilty-->
<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

function submitForm() {
	console.log("hello");
	
  //form = document.getElementById('form').value;
  username = document.getElementById("username").value;
  console.log(username);
  email = document.getElementById("email").value;
  console.log(email);
  number = document.getElementById("unumber").value;
  console.log(number);
  password = document.getElementById("upassword").value;
  console.log(password);
  password2 = document.getElementById("upassword2").value;
  console.log(password2);
  pattern =
    /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/gm;
  emailpattern =
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var le = email.lastIndexOf("@gmail.com");
  var ce = email.lastIndexOf("@yahoo.com");
  first = number.substring(0, 2);
  console.log(first);

  if (username === "") {
    //setError(username, 'username cannot be blank');
    document.getElementById("uspan").innerHTML = "Username is blank";
    return false;
  } else if (username.length <= 2) {
    // setError(username, 'username should more than 3 word');
    document.getElementById("uspan").innerHTML =
      "Username should be more than 3 word";
    return false;
  } else {
    document.getElementById("uspan").innerHTML = "";
    //setSuccess(username);
  }
  
  if (number == "") {
    document.getElementById("cspan").innerHTML = "It must not be empty";
    return false;
  } else if (first != "98" && first != "97") {
    document.getElementById("cspan").innerHTML = "Must start with 98 or 97";
    return false;
  } else if (number.length == 9) {
    document.getElementById("cspan").innerHTML = "It should contain 10 digit.";
    return false;
  } else if (isNaN(number)) {
    document.getElementById("cspan").innerHTML = "It should be number.";
    return false;
  } else {
    document.getElementById("cspan").innerHTML = "";
  }

  if (!email.match(emailpattern)) {
    document.getElementById("espan").innerHTML = "Email cannot be empty.";
    //setError(email, 'Email is required');
    return false;

    // } else if (!isValidEmail(email)) {
    //     // setError(email, 'Provide a valid email address');
    //     return false;
  } else {
    document.getElementById("espan").innerHTML = "";
  }
  if (!password.match(pattern)) {
    //  setError(password, 'Password is required');
    document.getElementById("pspan").innerHTML =
      "Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character";
    return false;
    // } else if (password.length < 😎 {
    //     // setError(password, 'Password must be at least 8 character.')
    //     document.getElementById('pspan').innerHTML="Password must be at least 8 character. ";
    //     return false;
    // } else {
    //     // setSuccess(password);
  } else {
    document.getElementById("pspan").innerHTML = "";
  }

  if (password2 === "") {
    document.getElementById("rspan").innerHTML = "It must not be empty";
    // setError(password2, 'Please confirm your password');
    return false;
  } else if (password2 !== password) {
    // setError(password2, "Passwords doesn't match");
    // alert("Password does not match.");
    document.getElementById("rspan").innerHTML = "Password does not match.";
    return false;
  } else {
    document.getElementById("rspan").innerHTML = "";
    //  setSuccess(password2);
  }
  // if(!le){
  //     alert("Invalid email.");
  //     return false;
  // }
  return true;
}
</script>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
								<div class="modal-body modal-spa">
									<div class="login-grids">
										<div class="login">
											<div class="login-left">
												<ul>
													<li><a class="fb" href="https://www.facebook.com/" target="_blank"><i></i>Facebook</a></li>
													<li><a class="goog" href="https://www.google.com/" target="_blank"><i></i>Google</a></li>
													
												</ul>
											</div>
											<div class="login-right">
												<form name="signup" method="POST" id="form" onsubmit="return submitForm()" >
													<h3>Create your account </h3>
				<input type="text" value="" placeholder="Full Name" id="username" name="fname" autocomplete="off" required="" onkeyup="return submitForm()"><span id="uspan"></span>
				<input type="text" value="" placeholder="Mobile number" id="unumber" maxlength="10" name="mobilenumber" autocomplete="off" required="" onkeyup="return submitForm()"><span id="cspan"></span>
		<input type="text" value="" placeholder="Email id" name="email" id="email" onBlur="checkAvailability()" autocomplete="off"  required="" onkeyup="return submitForm()"><span id="espan"></span>
		 <span id="user-availability-status" style="font-size:12px;"></span> 
	<input type="password" value="" placeholder="Password" id="upassword" name="password" required="" onkeyup="return submitForm()"><span id="pspan"></span>
	<input type="password" value="" placeholder="Password" id="upassword2" name="password" required="" onkeyup="return submitForm()"><span id="rspan"></span>
	


													<input type="submit" name="submit" id="submit" value="CREATE ACCOUNT" onsubmit="return submitForm()">
												</form>
											</div>
												<div class="clearfix"></div>								
										</div>
											<!-- <p>By logging in you agree to our <a href="page.php?type=terms">Terms and Conditions</a> and <a href="page.php?type=privacy">Privacy Policy</a></p> -->
									</div>
								</div>
							</section>
					</div>
				</div>
			</div>