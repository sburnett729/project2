<?php
include "account.php";
// Create connection
		mysql_connect($hostname,$username,$password);
		mysql_select_db($project);
$program = new program();
class program
{
    function __construct()
    {
        $page = 'homepage';
        $arg  = NULL;
        if (isset($_REQUEST['page'])) {
            $page = $_REQUEST['page'];
        }
        if (isset($_REQUEST['arg'])) {
            $arg = $_REQUEST['arg'];
        }
        
        //echo $page;
        $page = new $page($arg);
		
    }
    function __destruct()
    {
    }
}

class session {
        
        public function __construct() {
            session_start();
        }
        
        
		public function setUserDetails($username, $password) {
			$_SESSION['Username'] = $username;
			$_SESSION['Password'] = $password;
		}
        
		public function getUsername() {
			return $_SESSION['Username'];
		}
		
    }


abstract class page
{
    public $content;
    
    function menu()
    {
        $menu = '<a href="./college.php">Homepage</a>&nbsp';
        $menu .= '<a href="./college.php?page=q1">Question1</a>&nbsp';
        $menu .= '<a href="./college.php?page=q2">Question2</a>&nbsp';
		$menu .= '<a href="./college.php?page=q3">Question3</a>&nbsp';
		$menu .= '<a href="./college.php?page=q4">Question4</a>&nbsp';
		$menu .= '<a href="./college.php?page=q5">Question5</a>&nbsp';
        $menu .= '<a href="./college.php?page=q6">Question6</a>&nbsp';
		$menu .= '<a href="./college.php?page=q7">Question7</a>&nbsp';
		$menu .= '<a href="./college.php?page=q8">Question8</a>&nbsp';
		$menu .= '<a href="./college.php?page=q9">Question9</a>&nbsp';
		$menu .= '<a href="./college.php?page=q10">Question10</a>&nbsp';
		$menu .= '<a href="./college.php?page=q11">Question11</a>&nbsp';
		$menu .= '<a href="./college.php?page=q12">Question12</a>&nbsp';
        
        return $menu;
    }
	
		
		
    
    function __construct($arg = NULL)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->get();
        } else {
            $this->post();
        }
    }
    function get()
    {
        	
    }
    function post()
    {
    }
    function __destruct()
    {
        
        echo $this->content;
    }
    
}
class homepage extends page
{
    function get()
    {
        $this->content .= $this->menu();
    }
}
class login extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->loginForm();
    }
    function loginForm()
    {
    	
    	
		
        $form = '<form action="index.php?page=login" method="post">
    <P>
    <LABEL for="username">Username: </LABEL>
              <INPUT type="text" name="username" id="username"><BR>
    <LABEL for="password">Password: </LABEL>
              <INPUT type="password" name ="password" id="password"><BR>
    <INPUT type="submit" value="Send"> <INPUT type="reset">
    </P>
    <a href="./index.php?page=forgot">Forgot Password</a>
</form>
'; 
        return $form;
    }
    
    
    function post()
    {
    	
    	if(($_POST["username"] == "Scott") && ($_POST["password"] == "password")){
    		
				$sess = new session();
				$sess->setUserDetails($_POST['username'], $_POST['password']);
				
    			header("Location: http://localhost:8080/index.php?page=history");
			
			
    	}else{
    		
			header("Location: http://localhost:8080/index.php?page=forgot");
    	}
    		
		
			
		
        //print_r($_POST);
	}
    
    
    }

 

class q1 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query1();
    }
    function query1()
    {
		$output = mysql_query("SELECT college.instnm, SUM(enrolltlt) as enrolltlt, year FROM `enrollment` 
		INNER JOIN `college` ON enrollment.unitid = college.unitid 
		WHERE year = '2010' GROUP BY enrollment.unitid ORDER BY enrolltlt DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Total enrolled</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['enrolltlt'] ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		
		$output = mysql_query("SELECT college.instnm, SUM(enrolltlt) as enrolltlt, year FROM `enrollment` 
		INNER JOIN `college` ON enrollment.unitid = college.unitid 
		WHERE year = '2011' GROUP BY enrollment.unitid ORDER BY enrolltlt DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Total enrolled</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['enrolltlt'] ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}

class q2 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query2();
    }
    function query2()
    {
		$output = mysql_query("SELECT college.instnm,liatlt, year FROM `financial` 
		INNER JOIN `college` ON financial.unitid = college.unitid  WHERE year = '2010'
		ORDER BY liatlt DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Liability Total</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['liatlt'] ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		$output = mysql_query("SELECT college.instnm,liatlt, year FROM `financial` 
		INNER JOIN `college` ON financial.unitid = college.unitid  WHERE year = '2011'
		ORDER BY liatlt DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Liability Total</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['liatlt'] ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}



class q3 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query3();
    }
    function query3()
    {
		$output = mysql_query("SELECT college.instnm,netasset, year FROM `financial` 
		INNER JOIN `college` ON financial.unitid = college.unitid  Where year ='2010'
		ORDER BY netasset DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Net Assets</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['netasset'] ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		$output = mysql_query("SELECT college.instnm,netasset, year FROM `financial` 
		INNER JOIN `college` ON financial.unitid = college.unitid  Where year ='2011'
		ORDER BY netasset DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Net Assets</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['netasset'] ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}

class q4 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query4();
    }
    function query4()
    {
		$output = mysql_query("SELECT college.instnm,netasset, year FROM `financial` 
		INNER JOIN `college` ON financial.unitid = college.unitid  Where year ='2010'
		ORDER BY netasset DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Net Assets</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['netasset'] ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		$output = mysql_query("SELECT college.instnm,netasset, year FROM `financial` 
		INNER JOIN `college` ON financial.unitid = college.unitid  Where year ='2011'
		ORDER BY netasset DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Net Assets</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['netasset'] ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}


class q5 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query5();
    }
    function query5()
    {
		$output = mysql_query("SELECT college.instnm,revtlt, year FROM `financial` 
		INNER JOIN `college` ON financial.unitid = college.unitid  WHERE year = '2010'
		ORDER BY revtlt DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Total Revenue</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['revtlt'] ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		$output = mysql_query("SELECT college.instnm,revtlt, year FROM `financial` 
		INNER JOIN `college` ON financial.unitid = college.unitid  WHERE year = '2011'
		ORDER BY revtlt DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Total Revenue</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['revtlt'] ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}


class q6 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query6();
    }
    function query6()
    {
		$output = mysql_query("SELECT college.instnm,financial.revtlt / SUM(enrolltlt) as revperstu, enrollment.year FROM `enrollment` 
		INNER JOIN `college` ON enrollment.unitid = college.unitid
		INNER JOIN `financial` ON enrollment.unitid =financial.unitid
		WHERE enrollment.year = '2010' 
		GROUP BY enrollment.unitid 
		ORDER BY revperstu DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Revenue Per Student</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>$" . number_format($result['revperstu'], 2) ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		$output = mysql_query("SELECT college.instnm,financial.revtlt / SUM(enrolltlt) as revperstu, enrollment.year FROM `enrollment` 
		INNER JOIN `college` ON enrollment.unitid = college.unitid
		INNER JOIN `financial` ON enrollment.unitid =financial.unitid
		WHERE enrollment.year = '2011' 
		GROUP BY enrollment.unitid 
		ORDER BY revperstu DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Revenue Per Student</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>$" . number_format($result['revperstu'], 2) ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}


class q7 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query7();
    }
    function query7()
    {
		$output = mysql_query("SELECT college.instnm,financial.netasset / SUM(enrolltlt) as netperstu, enrollment.year FROM `enrollment` 
		INNER JOIN `college` ON enrollment.unitid = college.unitid
		INNER JOIN `financial` ON enrollment.unitid =financial.unitid
		WHERE enrollment.year = '2010' 
		GROUP BY enrollment.unitid 
		ORDER BY netperstu DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Net Asset per student</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>$" . number_format($result['netperstu'], 2) ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		$output = mysql_query("SELECT college.instnm,financial.netasset / SUM(enrolltlt) as netperstu, enrollment.year FROM `enrollment` 
		INNER JOIN `college` ON enrollment.unitid = college.unitid
		INNER JOIN `financial` ON enrollment.unitid =financial.unitid
		WHERE enrollment.year = '2011' 
		GROUP BY enrollment.unitid 
		ORDER BY netperstu DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Net Asset Per Stuent</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>$" . number_format($result['netperstu'], 2) ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}



class q8 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query8();
    }
    function query8()
    {
		$output = mysql_query("SELECT college.instnm,financial.liatlt / SUM(enrolltlt) as liaperstu, enrollment.year FROM `enrollment` 
		INNER JOIN `college` ON enrollment.unitid = college.unitid
		INNER JOIN `financial` ON enrollment.unitid =financial.unitid
		WHERE enrollment.year = '2010' 
		GROUP BY enrollment.unitid 
		ORDER BY liaperstu DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>total Liability per student</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>$" . number_format($result['liaperstu'], 2) ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		$output = mysql_query("SELECT college.instnm,financial.liatlt / SUM(enrolltlt) as liaperstu, enrollment.year FROM `enrollment` 
		INNER JOIN `college` ON enrollment.unitid = college.unitid
		INNER JOIN `financial` ON enrollment.unitid =financial.unitid
		WHERE enrollment.year = '2011' 
		GROUP BY enrollment.unitid 
		ORDER BY liaperstu DESC LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>Total Liability Per Stuent</th>
						<th>Year</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>$" . number_format($result['liaperstu'], 2) ."</td><td>" . $result['year']. "</td></tr>";
		}
		
		$data .= "</table>";
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}

class q9 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query9();
    }
    function query9()
    {
		$data.= "<h1>Records for 2010</h1>";
		if($_GET['stat'] == ""){
		
			$stat = "enrolltlt";
		
		
		}else{$stat = $_GET['stat'];}
		$output = mysql_query("SELECT college.instnm,financial.liatlt / SUM(enrolltlt) as liaperstu, enrollment.year, 
		SUM(enrolltlt) as enrolltlt,
		financial.liatlt as liatlt,
		financial.netasset as netasset,
		financial.revtlt as revtlt,
		financial.revtlt / SUM(enrolltlt) as revperstu,
		financial.netasset / SUM(enrolltlt) as netperstu
		FROM `enrollment` 
		INNER JOIN `college` ON enrollment.unitid = college.unitid
		INNER JOIN `financial` ON enrollment.unitid =financial.unitid
		WHERE enrollment.year = '2010' 
		GROUP BY enrollment.unitid 
		ORDER BY $stat DESC LIMIT 5");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th><a href=\"college.php?page=q9&stat=enrolltlt\">Total Enrollment</a></th>
						<th><a href=\"college.php?page=q9&stat=liatlt\">Total Liability</a></th>
						<th><a href=\"college.php?page=q9&stat=netasset\">Net Asset</a></th>
						<th><a href=\"college.php?page=q9&stat=revtlt\">Total Revenue</a></th>
						<th><a href=\"college.php?page=q9&stat=revperstu\">Revenue Per Student</a></th>
						<th><a href=\"college.php?page=q9&stat=netperstu\">Net Asset Per Student</a></th>
						<th><a href=\"college.php?page=q9&stat=liaperstu\">Liability Per Student</a></th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['enrolltlt'] ."</td>
			<td>$" . number_format($result['liatlt'],2). "</td>
			<td>$" . number_format($result['netasset'],2). "</td>
			<td>$" . number_format($result['revtlt'],2). "</td>
			<td>$" . number_format($result['revperstu'],2). "</td>
			<td>$" . number_format($result['netperstu'],2). "</td>
			<td>$" . number_format($result['liaperstu'],2). "</td>
			</tr>";
		}
		
		$data .= "</table>";
		
		
		
		$data.= "<h1>Records for 2011</h1>";
		if($_GET['stat'] == ""){
		
			$stat = "enrolltlt";
		
		
		}else{$stat = $_GET['stat'];}
		$output = mysql_query("SELECT college.instnm,financial.liatlt / SUM(enrolltlt) as liaperstu, enrollment.year, 
		SUM(enrolltlt) as enrolltlt,
		financial.liatlt as liatlt,
		financial.netasset as netasset,
		financial.revtlt as revtlt,
		financial.revtlt / SUM(enrolltlt) as revperstu,
		financial.netasset / SUM(enrolltlt) as netperstu
		FROM `enrollment` 
		INNER JOIN `college` ON enrollment.unitid = college.unitid
		INNER JOIN `financial` ON enrollment.unitid =financial.unitid
		WHERE enrollment.year = '2011' 
		GROUP BY enrollment.unitid 
		ORDER BY $stat DESC LIMIT 5");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th><a href=\"college.php?page=q9&stat=enrolltlt\">Total Enrollment</a></th>
						<th><a href=\"college.php?page=q9&stat=liatlt\">Total Liability</a></th>
						<th><a href=\"college.php?page=q9&stat=netasset\">Net Asset</a></th>
						<th><a href=\"college.php?page=q9&stat=revtlt\">Total Revenue</a></th>
						<th><a href=\"college.php?page=q9&stat=revperstu\">Revenue Per Student</a></th>
						<th><a href=\"college.php?page=q9&stat=netperstu\">Net Asset Per Student</a></th>
						<th><a href=\"college.php?page=q9&stat=liaperstu\">Liability Per Student</a></th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['enrolltlt'] ."</td>
			<td>$" . number_format($result['liatlt'],2). "</td>
			<td>$" . number_format($result['netasset'],2). "</td>
			<td>$" . number_format($result['revtlt'],2). "</td>
			<td>$" . number_format($result['revperstu'],2). "</td>
			<td>$" . number_format($result['netperstu'],2). "</td>
			<td>$" . number_format($result['liaperstu'],2). "</td>
			</tr>";
		}
		
		$data .= "</table>";
		
		
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}


class q10 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->q10Form();
    }
    function q10Form()
    {
        $form = '<form action="college.php?page=q10" method="post">
    <P>
    <LABEL for="state">Enter State Abbreviation: </LABEL>
              <INPUT type="text" name="state" id="state"><BR>         
    <INPUT type="submit" value="Send"> <INPUT type="reset">
    </P>
</form>
';
        return $form;
        
    }
    function post()
    {
        $this->content .= $this->menu();
        $this->content .= $this->q10ans();
    }
    function q10ans()
    {
		
		$output = mysql_query("SELECT instnm, stabbr FROM `college` WHERE stabbr ='".$_POST['state'] ."'
		ORDER BY instnm ASC");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>State</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>" . $result['stabbr'] ."</td></tr>";
		}
		
		$data .= "</table>";
		
		return $data;
    }
}

class q11 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query11();
    }
    function query11()
    {
		$output = mysql_query("SELECT unitid, instnm, e10tlt, e11tlt, (((e11tlt - e10tlt) / e10tlt) * 100) as difference FROM (
								SELECT unitid, instnm, 
								(SELECT SUM(liatlt) FROM financial WHERE unitid = college.unitid AND year = '2010' GROUP BY unitid) AS e10tlt, 
								(SELECT SUM(liatlt) FROM financial WHERE unitid = college.unitid AND year = '2011' GROUP BY unitid) AS e11tlt
								FROM college) as test
								ORDER BY difference DESC
								LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>'10 Liability Total</th>
						<th>'11 Liability Total</th>
						<th>Percentage Increase</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>$"  . number_format($result['e10tlt'],2). "</td><td>$"  . number_format($result['e11tlt'],2). "</td><td>". number_format($result['difference'], 2) ."%</td></tr>";
		}
		
		$data .= "</table>";
		
		
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}


class q12 extends page
{
    function get()
    {
        $this->content .= $this->menu();
        $this->content .= $this->query12();
    }
    function query12()
    {
		$output = mysql_query("SELECT unitid, instnm, e10tlt, e11tlt, (((e11tlt - e10tlt) / e10tlt) * 100) as difference FROM (
								SELECT unitid, instnm, 
								(SELECT SUM(enrolltlt) FROM enrollment WHERE unitid = college.unitid AND year = '2010' GROUP BY unitid) AS e10tlt, 
								(SELECT SUM(enrolltlt) FROM enrollment WHERE unitid = college.unitid AND year = '2011' GROUP BY unitid) AS e11tlt
								FROM college) as test
								ORDER BY difference DESC
								LIMIT 10");
		
		$data.="<br>";
		$data.= "<table border = \"1\">
					<tr>
						<th>InstName</th>
						<th>'10 Enrollment Total</th>
						<th>'11 Enrollment Total</th>
						<th>Percentage Increase</th>
					</tr>";	
		
		while($result = mysql_fetch_assoc($output)){
			$data .= "<tr><td>".$result['instnm'] ."</td><td>"  . $result['e10tlt']. "</td><td>"  . $result['e11tlt']. "</td><td>". number_format($result['difference'], 2) ."%</td></tr>";
		}
		
		$data .= "</table>";
		
		
		
		return $data;
        
    }
    function post()
    {
        print_r($_POST);
    }
}

?>















