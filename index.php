<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
include "common.php";
$user=$_REQUEST['user'];
$today =date('Y'.'-'.'m'.'-'.'d');
$time =date('Y'.'-'.'m'.'-'.'d'.' '.'h'.':'.'m'.':'.'s');
$currentTimeinSeconds = time();
if(isset($_REQUEST['p'])){ $self=$_REQUEST['p'];}
$capturedate= date ('Y'.'m'.'d');
extract($_POST);
if(!isset($_GET['p'])){
$_GET['p'] = "vacancies";}	
?>
<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsiive Admin Dashboard | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">Assessment</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="?p=vacancies"</a>
            <i class='bx bx-box' ></i>
            <span class="links_name">Home</span>
          </a>
        </li>
       

  	<?php
	if($_GET['p']=="vacancies") {?>
	<li>
          <a href="?p=login">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Login</span>
          </a>
        </li>  
   	<?php
	}else{?>
	<li class="">
          <a href="?p=vacancies">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
	<?php
	}?>
      </ul>
  </div>
  
  
  
  
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="">
           <?php
	if($_GET['p']=="vacancies") {?>

          <a href="?p=login">
                <span class="btn btn-secondary">Login</span>
          </a>
 
          <a href="?p=register">
                <span class="btn btn-secondary">Register</span>
          </a>
     
   	<?php
	}else{?>
          <a href="?p=vacancies">
               <span class="btn btn-secondary">Logout</span>
          </a>
	<?php
	}?>
      
      </div>
    </nav>



    <div class="home-content">
      <div class="overview-boxes">      
		
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box">
           <div class="sales-details">           
	  <?php
		 if (file_exists($_GET['p'].".php")){
			include_once($_GET['p'].".php");
		    } else 
		   {
		echo "<p class='border'>&nbsp;</p><p class='border'>&nbsp;</p><p class='border'>&nbsp;</p><p class='border'>&nbsp;</p>
			<blockquote class='cancel'>Sorry, this page is under construction...</blockquote>
			<p class='border'>&nbsp;</p><p class='border'>&nbsp;</p><p class='border'>&nbsp;</p><p class='border'>&nbsp;</p>";
		    }
		?>
          </div>
         <div class="button">
            <a href="#"></a>
          </div>
        </div>	
	
	
	
        <div class="top-sales box justify-content-center">
		
        </div>
      </div>
    </div>
  </section>

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

  <script>
	let sidebar = document.querySelector(".sidebar");
	let sidebarBtn = document.querySelector(".sidebarBtn");
	sidebarBtn.onclick = function() {
	sidebar.classList.toggle("active");
	if(sidebar.classList.contains("active")){
		sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
	}else
	  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
	}
 </script>
<script  type="text/javascript">
$(document).ready(function() {
	jQuery('#export-menu li').bind("click", function() {
	var target = $(this).attr('id');
	switch(target) {
		case 'export-to-excel' :
		$('#hidden-type').val(target);
		$('#export-form').submit();
		$('#hidden-type').val('');
		break
		case 'export-to-csv' :
		$('#hidden-type').val(target);
		$('#export-form').submit();
		$('#hidden-type').val('');
		break
	}
	});
    });
</script>
      <script>
	$(document).ready(function () {
		 $('.click-call').on('click', function (e) {
		 var ref = $(this).attr("data-id");
		 $.ajax({
			method: "POST",
			url: "addclick.php",
			 data: {
				ref: $(this).attr("data-id")
			    },success: function(data){
				if(data.statusCode==200){
					console.log('RESPONSE '+data);
				}
			}
		});
		});		
	});
</script>
</body>
</html>
