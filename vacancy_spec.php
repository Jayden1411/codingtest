<html lang="en"style="font-size: 12px;">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Specification</title>
    <style>
	#more {display: none;}
</style>
 </head>
  <body>
	<div class="card-body col-12">	
		<?php
		    $dbh = Db::db_connect();
		    $reference= $_REQUEST['vacancy_ref'];
		    $company= $_REQUEST['company_ref'];
		    //$vacancy= json_decode($_REQUEST->vacancy;);
		    $jobs= ApiData::getData('getAdverts', $reference);
		    //$vacancies= ApiData::getDatav($dbh,$company, $reference);
		   // var_dump($jobs);
		     if($jobs=='error found')
		    {
		      echo'<div class="card col-12 justify-content-center">
				<div class="card-body">An error getting vacancy,Please cleck your connection and refresh page or Contact Support </div>
			  </div>';
		    }else{
			for($x = 0; $x < count($jobs); $x++){
				if($jobs[$x]->vacancy_ref==$reference){
					$vacancies=$jobs[$x];
				}
			}
			//var_dump($vacancies->start_date);
			$date1 = DateTime::createFromFormat('Y-m-d', $vacancies->start_date);
			$date2 = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
			$diff=date_diff($date2,$date1);
			$days= (abs($diff->format("%R%a")) > 1) ?  abs($diff->format("%R%a"))." days ago" :  abs($diff->format("%R%a"))." day";
			?>
	     
		<div class="card justify-content-center col-12">
		<div class="card-body">
	
		<div class="row col-sm-12 p-0"style="border:"><!--row start -->
		    <div class="col-2" style="background: white;float:left;"><!--col1 start -->
			<p style="float:left;clear:both;overflow:auto;"><img src="images/jjs.png" alt="Logo"style="width:100px;height:auto;"/></p>
		    </div>
	    <!--col end -->		
		 <div class="col-10"><!--col2 start -->
		   <div class="card-header row"style="background: #af2b0f;">
			<p style="font-size:16px;color:white;"><strong><?php echo ucwords($vacancies->company_ref); ?></strong></p>
		   </div>
		     <div class="card-header row"style="background:">
				<p style="font-size:18px;color:blue;"><strong><?php echo ucwords($vacancies->job_title); ?></strong></p>
		    </div>
		     <div class="row"style=";background: ">
			 <div class="card-title  col-6">	
				<strong>Location:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $vacancies->town; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $vacancies->region; ?>
			 </div>
			 <div class="card-title  col-6"><strong>Reference:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $vacancies->vacancy_ref;?></div>
			</div>
			<div class="row"style="background: #e8e6d2;">
			      <div class="card-title  col-6"><strong>Salary:</strong>&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $vacancies->salary_min." - ". $vacancies->salary_max;?>
			     </div>
			      <div class="card-title  col-6"><strong>Expiry Date:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $vacancies->expiry_date; ?></div>
			</div>
			</div>
		    <!--col end -->			   				
		</div>
		<!--row end --> 
		<hr>
		<p class="card-text">
			   <?php echo $days; ?>
		</p>
			
		      
		<p class="card-text"><strong>Brief Description</strong><br>
		<?php echo html_entity_decode($vacancies->brief_description);?>
		</p>
		 <p class="card-text"><strong>Detail Description</strong><br>
		<?php echo html_entity_decode($vacancies->detail_description);?>
		</p>				     
		<p class="card-text">
		<a href="https://webapp.placementpartner.com/wi/application_form.php?id=<?php echo $vacancies->company_ref; ?>&vacancy_ref=<?php echo $vacancies->vacancy_ref; ?>&source=assessment"target="blank"data-id="<?php echo $vacancies->vacancy_ref;; ?>"class="btn btn-info btn-sm">
		   Apply Here
		</a>
		</p>
			
		<?php } ?>	
		  </div>
	</div>
	</div>

 </body>
</html>
