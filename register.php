			<?php	
			//include "common.php";
			if (!empty($_POST))
			{ 	extract($_POST);
				$dbh = Db::db_connect();
				$validate= Register::userValidate($dbh, $name,$email,$password,$password_confirmation);
				if($validate=="passed"){
					$register= Register::userRegister($dbh, $name,$email,$password);
					//var_dump($register);
					?>
						<script language = "javascript" style = "text/javascript"> 
							window.location = "?p=adverts&user=<?php echo $name?>";	
						</script>
					<?php
				}else{
					//var_dump($validate);
					echo "<script language ='javascript' style = 'text/javascript'>window.location ='?p=register&validations=".json_encode($validate)."'</script>";
				}
			}
			?>
		
			<div class="col-10 offset-1">
			    <div class="card ">
				<div class="card-header">Register</div>	
				<div class="">
					<?php
					if (!empty($_REQUEST['validations']))
					{
						$data=  json_decode($_REQUEST['validations']);
						foreach($data as $error){
						      echo "<li class='alert alert-danger'> ".$error."</li>";
						}
					}
					?>						
				</div>
				<div class="card-body">
				    <form method="POST" action="?p=register">			      
					<div class="row mb-3">
					    <label for="name" class="col-md-4 col-form-label text-md-end">Company Name</label>
						    <div class="col-md-6">
						<input id="name" type="text" class="form-control" name="name"  required autocomplete="name" autofocus>
					    </div>
					</div>
						<div class="row mb-3">
					    <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
						    <div class="col-md-6">
						<input id="email" type="email" class="form-control " name="email"  required autocomplete="email">
					    </div>
					</div>
						<div class="row mb-3">
					    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
						    <div class="col-md-6">
						<input id="password" type="password" class="form-control " name="password" required autocomplete="new-password">
					    </div>
					</div>
					<div class="row mb-3">
					    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>
					    <div class="col-md-6">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					    </div>
					</div>
						<div class="row mb-0">
					    <div class="col-md-6 offset-md-4">
						<button type="submit" class="btn btn-primary">
						    Register
						</button>
					    </div>
					</div>
				    </form>
				</div>
			    </div>
			</div>
		    </div>

                                 </div>
                       </div>
                        
