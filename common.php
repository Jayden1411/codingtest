<?php

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
/*
class Pdf extends Dompdf{

 public function __construct(){
	parent::__construct();
 }
}
*/
class Db
{
	public static function db_connect()
	{
		$host="localhost";
		$db="parallel";
		$username="root";
		$pass="";
                $dbh = null;
		$dbh = new PDO("mysql:host=$host;dbname=$db", $username, $pass, array(
		PDO::ATTR_PERSISTENT => true
		));
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $dbh;
	}
	public static function db_conn()
	{
		  $DBServer = "localhost";
		  $DBUser = "root";     
		   $DBPass = "";      
		   $DBName = "parallel"; 
		  $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);

			if ($conn->connect_error) {
				trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
			}	
                return $conn;
	}	
}	
	
class ApiData
{
	public static function getData($method, $filter)
	{
		try
		{
			$wsdl = "https://webapp.placementpartner.com/ws/clients/?wsdl";
			$username = 'parallel';
			$password = 'parallel';
			$client = new SoapClient($wsdl, array('cache_wsdl' => WSDL_CACHE_NONE) );
			$session_id = $client->login($username, $password);
			$php_filter = array(
				//echo $filter;
			);
			return $client->$method($session_id, $php_filter);
		}
		catch(Exception $e)
		{
			//echo $message = $e->getMessage();
			//echo 'Error getting data, check your connection';
			return 'error found';
		}
	}
	public static function getSearch($method, $filter)
	{
		try
		{
			$wsdl = "https://webapp.placementpartner.com/ws/clients/?wsdl";
			$username = 'parallel';
			$password = 'parallel';
			$client = new SoapClient($wsdl, array('cache_wsdl' => WSDL_CACHE_NONE) );
			$session_id = $client->login($username, $password);
			$php_filter = array(
				array('field' => 'job_description', 'value' => $filter, 'operator' => 'exact')
				//array('field' => 'job_title', 'value' => 'SALES', 'operator' => 'exact')
			);
			return $client->$method($session_id, $php_filter);
		}
		catch(Exception $e)
		{
			//echo $message = $e->getMessage();
			//echo 'Error getting data, check your connection';
			return 'error found';
		}
	}
	public static function updateApiData($dbh, $vacancies)
	{
		try
		{
			for($x = 0; $x < count($vacancies); $x++){
			if(empty(DB::select('select * from vacancies where vacancy_ref = :id', ['id' => $vacancies[$x]->vacancy_ref]))){
					DB::insert('insert into vacancies (company_ref,vacancy_ref,job_title,salary_max,start_date,expiry_date) 
					values (?, ?,?, ?,?, ?)', 
					[$vacancies[$x]->company_ref,$vacancies[$x]->vacancy_ref,$vacancies[$x]->job_title,$vacancies[$x]->salary_max,$vacancies[$x]->start_date,$vacancies[$x]->expiry_date]);
				}
			}
			return True;
		}
		catch(Exception $e)
		{
			//echo $message = $e->getMessage();
			echo 'Error updating vacancy data, check your connection';
			return 'error found';
		}
	}
	
 }
class Clicks
{	
	public static function addClicks($dbh,$vacancy_ref)
	{
		try
		{
			$v=preg_split("#/#", $vacancy_ref);
			$query = "insert into click_records(vacancy_ref) values(:VACANCY_REF)";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':VACANCY_REF', $v[0], PDO::PARAM_STR);
			$sth->execute();
			return True;
		}
		catch(PDOException $e)
		{
			//echo $message = $e->getMessage();
			echo 'Error adding click data, check your connection';
			return 'error found';
		}
	}
	public static function getClick($dbh, $ref)
	{
		try
		{
			$v=preg_split("#/#", $ref);
			//$query = "SELECT click_date,count(vacancy_ref) as clicks FROM click_records where company_ref=:USR_ID group by click_date";
			$query = "SELECT click_date,count(vacancy_ref) as clicks FROM click_records where company_ref=:USR_ID group by click_date";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':USR_ID', $userid, PDO::PARAM_STR);
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		catch(PDOException $e)
		{
			//echo $message = $e->getMessage();
			echo 'Error getting click data, check your connection';
			return 'error found';
		}
	}
	public static function getClicks2($dbh, $ref)
	{
		try
		{
			$v=preg_split("#/#", $ref);
			$query = "SELECT count(vacancy_ref) as clicks FROM click_records where vacancy_ref=:USR_ID";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':USR_ID', $v[0], PDO::PARAM_STR);
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		catch(PDOException $e)
		{
			echo 'Error getting data click2 , check your connection';
			return 'error found';
		}
	}
}
class ExportData
{	
	public static function makePdf($dbh, $userid)
	{
		try
		{
			//$query = "SELECT click_date,count(vacancy_ref) as clicks FROM click_records where company_ref=:USR_ID group by click_date";
			$query = "SELECT click_date,count(vacancy_ref) as clicks FROM click_records  GROUP BY click_date";
			$sth = $dbh->prepare($query);
			//$sth->bindParam(':USR_ID', $userid, PDO::PARAM_STR);
			$sth->execute();
			return $sth->fetchAll();
		}
		catch(PDOException $e)
		{
			echo 'Error in make pdf, check your connection';
			return 'error found';
		}
	}
	public static function makeExcel($dbh, $userid)
	{
		try
		{
			$data=[];
			$select =$dbh->query("SELECT company_ref,vacancy_ref,job_title,salary_max,start_date,expiry_date FROM vacancies");
			while ( $aRow = $select->fetch_assoc() )
			{
				foreach($aRow as $fieldname => $fieldvalue) {
				     $row[$fieldname] = $fieldvalue; 	
				}
				array_push($data,$row);
			}
			return $data;		
		}
		catch(PDOException $e)
		{
			echo 'Error in make excel, check your connection';
			return 'error found';
		}
	}
}	
class Register
{
	public static function userValidate($dbh, $name,$email,$password,$password_confirmation)
	{
		try
		{	$errors=[];
			$flag=true;
			$query = "select email from users where email='$email'";	
			$sth = $dbh->prepare($query);
			$sth->execute();
			$result = $sth->fetch();
			if(!empty($result['email'])){
				array_push($errors,'User email '.$result['email'].' already exist');
				$flag=false;
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors,'$email is not a valid email address');
				$flag=false;
			}
			if($password !=$password_confirmation){
				array_push($errors,'Passwords not the same');
				$flag=false;
			}
			if($flag==true){
				return "passed";	
			}else{
				return $errors;
			}
		}
		catch(Exception $e)
		{
			echo 'Error in validate, check your connection';
			return 'error found';
		}
	}
	public static function userRegister($dbh, $name,$email,$password)
	{
		try
		{
			$password=password_hash($password, PASSWORD_DEFAULT);	
			$query="insert into users(name,email, password) values(:NAME, :EMAIL, :PASSWORD)";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':NAME', $name, PDO::PARAM_STR);
			$sth->bindParam(':EMAIL', $email, PDO::PARAM_STR);
			$sth->bindParam(':PASSWORD', $password, PDO::PARAM_STR);
			$sth->execute();			
			return true;
		}
		catch(Exception $e)
		{
			echo 'Error in register, check your connection';
			return 'error found';
		}
	}

}

class Login
{
	public static function checkLogin($dbh, $username, $password)
	{
		try
		{
			$query = "SELECT * from users WHERE email =:EMAIL";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':EMAIL', $username, PDO::PARAM_STR);
			$sth->execute();
			$row = $sth->fetch();
			//return $row;
			if (password_verify($password, $row['password']))
			{
				return $row['name'];
			}else{	
				return false;
			}
		}
		catch(PDOException $e)
		{
			echo 'Error in login check your connection';
			return 'error found';
		}
	}
	
	public static function checkLogin1($dbh, $username, $password)
	{
		$password = md5($password);
		try
		{
			$query = "SELECT * FROM user WHERE (EMAIL=:EMAIL OR PHONE=:EMAIL) AND PASSWORD=:PASSWORD";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':EMAIL', $username, PDO::PARAM_STR);
			$sth->bindParam(':PASSWORD', $password, PDO::PARAM_STR);
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		catch(PDOException $e)
		{
			echo 'Error in login1, check your connection';
			return 'error found';
		}
	}
	
	public static function updatePassword($dbh, $username, $password)
	{
		$password = md5($password);
		try
		{
			$query = "update user set password=:PASSWORD WHERE (EMAIL=:EMAIL) AND STATUS = 1";
			$sth = $dbh->prepare($query);
			$sth->bindParam(':EMAIL', $username, PDO::PARAM_STR);
			$sth->bindParam(':PASSWORD', $password, PDO::PARAM_STR);
			$sth->execute();
			return True;
		}
		catch(PDOException $e)
		{
			echo 'Error in update password, check your connection';
			return 'error found';
		}
	}
}

?>

