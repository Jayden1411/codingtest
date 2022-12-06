<html lang="en"style="font-size: 12px;">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vacancies</title>
 </head>
  <body>
	    
		<div class="card-body col-12">	
				<?php
				    $dbh = Db::db_connect();
				    $vacancies= ApiData::getData('getAdverts', "");
				     if($vacancies=='error found')
				    {
				      echo'<div class="card col-12 justify-content-center">
					  <div class="card-body">An error has occured Please cleck your connection and refresh page
					  </div>
					  </div>
					  ';
				    }else{
				     for($x = 0; $x < count($vacancies); $x++){
				     ?>				 
				 <div class="card justify-content-center">
					  <div class="card-body">
					    <h5 class="card-title"><a href="#"class="click-call"data-id="<?php echo $vacancies[$x]->company_ref; ?>"><?php echo ucwords($vacancies[$x]->company_ref); ?></a></h5>
					    <h6 class="card-title">Ref:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $vacancies[$x]->vacancy_ref ?></h6>
					    <h6 class="card-title">Title:&nbsp;&nbsp;&nbsp;&nbsp;
					    <a href="#"data-id="<?php echo $vacancies[$x]->vacancy_ref; ?>"class="click-call">
					    <?php echo $vacancies[$x]->job_title;  ?></a></h6>
					    <h6 class="card-title">Expiry:&nbsp;&nbsp;<?php echo $vacancies[$x]->expiry_date;  ?></h6>
					    <p class="card-text">
						<?php echo substr(html_entity_decode($vacancies[$x]->brief_description),0,100);?>
						<span id="dots"></span><span id="<?php echo $x;?>">
						<?php echo substr(html_entity_decode($vacancies[$x]->brief_description),101,10000);?></span>
					     
						     <?php if(strlen($vacancies[$x]->brief_description) > 50){?>
							<button onclick="myFunction(<?php echo $x; ?>)" id="myBtn"class="btn btn-link">............</button></p>
						     <?php } ?>
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
  var btnText = document.getElementById("myBtn");
  var moreX = document.getElementById("more");
  console.log(dots.style.display);
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
