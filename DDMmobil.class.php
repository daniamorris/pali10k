<?php
class DDMmobil
{
  /**
   * Instance of database connection class
   * @access protected
   * @var PDO object
   */
  protected $db;
	
  function __construct(PDO $db)
  {
    $this->db       = $db;
  }

   public function scoreboard($myuuid)
  {

    try
    {
      $sql = "SELECT * FROM scoreboard WHERE uuid=:myuuid";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		printf("<p><b>Stars:</b> %s</p><p><b>Total milage:</b> %s</p><p><b>Total time:</b> %s</p><p><b>Goals:</b> %s %s</p>", $row["stars"], $row["milage"], $row["timeframe"], $row["goals"], $row["notes"]);
		}
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

  }

   public function starcount($myuuid)
  {

    try
    {
      $sql = "SELECT SUM(stars) FROM mytraining WHERE uuid=:myuuid";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->execute();
      
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		printf("<p><b><span class='glyphicon glyphicon-star'></span> Stars:</b> %s</p>", $row["SUM(stars)"]);
		}
		
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

  }

   public function milage($myuuid)
  {

    try
    {
      $sql = "SELECT SUM(milage) FROM mytraining WHERE uuid=:myuuid";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->execute();
      
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		printf("<p><b>Total milage:</b> %s</p>", $row["SUM(milage)"]);
		}
		
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

  }

   public function setgoal($myuuid, $goals, $notes)
  {

    try
    {
      $sql = "INSERT INTO mygoals (id,uuid,goals,notes) VALUES (NULL, :myuuid, :goals, :notes)";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->bindParam(':goals', $goals);
      $stmt->bindParam(':notes', $notes);
      $stmt->execute();
		echo '<div class="container"><h3 class="center-block">Your goal has been added!</h3></div>';
		//include 'index.html';
		//return;
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

  }

   public function viewgoals($myuuid)
  {

    try
    {
      $sql = "SELECT * FROM mygoals WHERE uuid=:myuuid";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->execute();
      $b = 1;
      echo '<p><b>GOALS</b></p>';
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		printf("<p><b>Goal $b:</b> %s %s</p>", $row["goals"], $row["notes"]);
		$b++; 
		}
		
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

  }

   public function removegoals($myuuid)
  {

    try
    {
      $sql = "SELECT * FROM mygoals WHERE uuid=:myuuid";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->execute();
      $b = 1;
      echo '<p><b>GOALS</b></p>';
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		printf("<p><input name='id[]' type='checkbox' value='%s'><b>&nbsp; Delete Goal $b:</b> %s %s</p>", $row["id"], $row["goals"], $row["notes"]);
		$b++; 
		}
		
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

    }

   public function removegoals2($id)
  {

    try
    {
      $sql = "DELETE FROM mygoals WHERE id=:id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':id', $id);
      $stmt->execute();
		
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

  }

   public function logtrain($myuuid, $hours, $minutes, $seconds, $milage, $stars)
  {

    try
    {
      $sql = "INSERT INTO mytraining (id,uuid,hours,minutes,seconds,milage,stars) VALUES (NULL, :myuuid, :hours, :minutes, :seconds, :milage, :stars)";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->bindParam(':hours', $hours);
      $stmt->bindParam(':minutes', $minutes);
      $stmt->bindParam(':seconds', $seconds);
      $stmt->bindParam(':milage', $milage);
      $stmt->bindParam(':stars', $stars);
      $stmt->execute();
		echo '<div class="container"><h3 class="center-block">Your training has been added!</h3></div>';
		//include 'index.html';
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

  }

   public function logevent($myuuid, $date, $location, $details, $moreinfo)
  {

    try
    {
      $sql = "INSERT INTO events (id,uuid,date,location,details,moreinfo) VALUES (NULL, :myuuid, :date, :location, :details, :moreinfo)";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->bindParam(':date', $date);
      $stmt->bindParam(':location', $location);
      $stmt->bindParam(':details', $details);
      $stmt->bindParam(':moreinfo', $moreinfo);
      $stmt->execute();
		echo '<div class="container"><h3 class="center-block">Your training event has been added!</h3></div>';
		//echo $myuuid;
		//include 'index.html';
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

  }

   public function getevents($myuuid)
  {

    try
    {
      $sql = "SELECT * FROM  events WHERE uuid=:myuuid";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->execute();
      $b = 1;
      echo '<p><b>Your Events</b></p>';
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$mydate = date_create($row["date"]);
		$datef = date_format($mydate, 'l F jS \a\t g:ia');
		printf("<p><b>Date:</b> $datef<br><b>Location:</b> %s<br><b>Details:</b> %s %s</p>", $row["location"], $row["details"], $row["moreinfo"]);
		$b++; 
		}

    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}

  }

   public function allevents($myuuid)
  {

    try
    {
      $sql = "SELECT * FROM  events WHERE uuid!=:myuuid";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->execute();
      $b = 1;
      echo '<p><b>Other Events</b></p>';
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$mydate = date_create($row["date"]);
		$datef = date_format($mydate, 'l F jS \a\t g:ia');
		printf("<p><b>Date:</b> $datef<br><b>Location:</b> %s<br><b>Details:</b> %s %s</p>", $row["location"], $row["details"], $row["moreinfo"]);
		$b++; 
		}

    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}

  }

   public function removeEvent($myuuid)
  {

    try
    {
      $sql = "SELECT * FROM events WHERE uuid=:myuuid";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':myuuid', $myuuid);
      $stmt->execute();
      $b = 1;
      echo '<p><b>Events</b></p>';
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$mydate = date_create($row["date"]);
		$datef = date_format($mydate, 'm/d/y g:ia');
		printf("<p><input name='id[]' type='checkbox' value='%s'><b>&nbsp; Delete Event $b:</b> $datef <br>%s - %s</p>", $row["id"], $row["location"], $row["details"]);
		$b++; 
		}
		
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

    }

   public function removeEvent2($id)
  {

    try
    {
      $sql = "DELETE FROM events WHERE id=:id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(':id', $id);
      $stmt->execute();
		
    }
    
	catch (PDOException $e)
	{
  	echo 'PDO Exception Caught.  ';
  	echo 'Error with the database: <br />';
  	echo 'SQL Query: ', $sql;
  	echo 'Error: ' . $e->getMessage();
	}
	echo '<div class="clear"> </div>';

  }


}

?>