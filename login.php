<?php
	//include "common.php";
	if (!empty($_POST)){ 	
	extract($_POST);
	$dbh = Db::db_connect();
	$login= Login::checkLogin($dbh, $username, $password);
	//var_dump($login);
	if(!empty($login)){
		echo "<script language ='javascript' style = 'text/javascript'>window.location ='?p=adverts&user=".$login."'</script>";
	}else{
		echo "<script language ='javascript' style = 'text/javascript'>window.location ='?p=login&validations=Invalid Login Attempt'</script>";
	}
	}
?> 							  
			
	<div class="card-body col-10 offset-1 ">
	<div class="alert alert-danger">
	<?php
		if (!empty($_REQUEST['validations']))
		{
			echo $_REQUEST['validations'];
		}
	?>						
	</div>
	<form method="POST" action="?p=login">
	     <div class="row mb-3">
	    <label for="email" class="col-md-3 col-form-label text-md-end">Email Address</label>
		    <div class="col-md-5">
		  <input type="text" name="username" class="form-control"/>
	    </div>
		</div>
			<div class="row mb-3">
		    <label for="password" class="col-md-3 col-form-label text-md-end">Password</label>
			    <div class="col-md-5">
			<input type="password" name="password" class="form-control"/>
		    </div>
		</div>

		<div class="row mb-0">
		    <div class="col-md-6 offset-md-3">
			<button type="submit" class="btn btn-primary btn-sm">Log in</button>
			   <a class="btn btn-link" href="#">
				Forgot Your Password
			    </a>
		     </div>
		</div>
	    </form>
	</div>
       