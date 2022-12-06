<html lang="en"style="font-size: 12px;">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vacancies</title>
    <style>
	#more {display: none;}
</style>
 </head>
  <body>
	    
		<div class="card-body col-12">	
				<?php
				    $string=$_POST['search'];
				    $dbh = Db::db_connect();
				    $vacancies= ApiData::getSearch('getAdverts', $string);
				
				     if($vacancies=='error found' or $vacancies==null)
				    {
				      echo'<div class="card col-12 justify-content-center">
					  <div class="card-body">Search yielded empty results
					  </div>
					  </div>
					  ';
				    }else{
				     for($x = 0; $x < count($vacancies); $x++){
					$date1 = DateTime::createFromFormat('Y-m-d', $vacancies[$x]->start_date);
					$date2 = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
					$diff=date_diff($date2,$date1);
					$days= (abs($diff->format("%R%a")) > 1) ?  abs($diff->format("%R%a"))." days ago" :  abs($diff->format("%R%a"))." day";
				     ?>				 
				 <div class="card justify-content-center col-12">
					  <div class="card-body">
					    <div class="card-header row">
					    <p style="font-size:16px;color:red;"><?php echo $vacancies[$x]->job_title; ?></p>
					    </div>
					     <div class="row"style="background: #e8e6d2;">
						      <div class="card-title  col-6">
							<a href="https://webapp.placementpartner.com/wi/application_form.php?id=<?php echo$vacancies[$x]->company_ref ?>&vacancy_ref=<?php echo $vacancies[$x]->vacancy_ref ?>&source=assessment"target="blank"data-id="<?php echo $vacancies[$x]->vacancy_ref; ?>"class="click-call">
								<strong><?php echo ucwords($vacancies[$x]->company_ref); ?></strong></a>
						     </div>
						      <div class="card-title  col-6"><strong>Reference:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $vacancies[$x]->vacancy_ref ?></div>
						</div>
						<div class="row"style="background: #e8e6d2;">
						      <div class="card-title  col-6"><strong>Salary:</strong>&nbsp;&nbsp;&nbsp;&nbsp;
							<?php echo $vacancies[$x]->salary_min." - ". $vacancies[$x]->salary_max;?>
						     </div>
						      <div class="card-title  col-6"><strong>Expiry Date:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $vacancies[$x]->expiry_date ?></div>
						</div>
					   	<p class="card-text">
							<strong>Location:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $vacancies[$x]->town ?> &nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $vacancies[$x]->region ?>
						</p>		    
					    
						 <p class="card-text"><strong>Brief Description</strong><br>
						<?php echo substr(html_entity_decode($vacancies[$x]->brief_description),0,108);?>
						<span id="dots"></span>
						<span id="<?php echo $vacancies[$x]->vacancy_ref;?>"style="display:none;">
						<?php echo substr(html_entity_decode($vacancies[$x]->brief_description),109,10000);?></span>

						<?php if(strlen($vacancies[$x]->brief_description) > 110){?>
							<?php echo '<button class="btn btn-link btn-sm" id="myBtn'.$vacancies[$x]->vacancy_ref.'" onClick=myFunction("' .$vacancies[$x]->vacancy_ref. '");return false;>more</button>';
						 }?>
						 <p class="card-text">
						   <?php echo $days; ?>
						</p>
						     
						<p class="card-text">
						<a href="https://webapp.placementpartner.com/wi/application_form.php?id=<?php echo $vacancies[$x]->company_ref ?>&vacancy_ref=<?php echo $vacancies[$x]->vacancy_ref ?>&source=assessment"target="blank"data-id="<?php echo $vacancies[$x]->vacancy_ref; ?>"class="click-call btn btn-info btn-sm">
						   Apply Here
						</a>
						</p>
						
						
					  </div>
				</div>
				   <?php 
				   } 
				  } 
				  ?>
	   
		</div>



<script>
function myFunction(id) {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById(id);
  var btnText = document.getElementById("myBtn"+id);

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }

}
</script>
 </body>
</html>
