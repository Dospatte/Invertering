<?php include 'connection.php' ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css"> -->
<link href="css/bootstrap-3.3.7.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div class="container"></div>

<div class="row">
<div id="header" class="header col-md-12">
  <h1 class="page-header" id="header">Inventering</h1>
</div>
</div>

<!--Input -->
<div class="row">
<div class="col-md-12">
<form method="post" id="input" > 

	<input  type="text" name="namn" id="tasklabel" placeholder="namn"/>
	
    <input  type="text" name="antal" id="tasklabel style="padding:200px;" placeholder="antal"/>
    
    <input  type="text" name="lagerplats" id="tasklabel" placeholder="lagerplats"/>
    
    <br />
	<input id="submit"  type="submit" value="Lägg till">
	<br />
</form>
</div>
</div>


<div class="row">
<div id="table" class="col-md-12">
  <?php
echo "<table style='border: solid 1px black; margin: auto;	width: 50%; padding: 10px; text-align:center;'>";
echo "<tr><th style='text-align:center; border: solid 1px black;'>Namn</th><th style='text-align:center; border: solid 1px black;'>Antal</th><th style='text-align:center; border: solid 1px black;'>Lagerplats</th><th style='text-align:center; border: solid 1px black;'>Ta bort</th></tr>";

/*class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
		if ($this->beginChildren() == "id")
		{
			return "<td style='width:150px; text-align:center; border: solid 1px black;'>" . parent::current(). "m<a href='delete.php?id=".  p . "'>Delete</a></td>";
		} else {
        	return "<td style='width:150px; text-align:center; border: solid 1px black;'>" . parent::current(). "</td>";
		}
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} */


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT namn, antal, lagerplats, id FROM inventory"); 
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
  /*  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v; 
		
    }*/
	
	foreach($stmt->fetchAll() as $k=>$v)
{
	echo "<tr>";
	echo "<td style='width:150px; text-align:center; border: solid 1px black;'>" . $v["namn"]."</td>";
	echo "<td style='width:150px; text-align:center; border: solid 1px black;'>" . $v["antal"]."</td>";
	echo "<td style='width:150px; text-align:center; border: solid 1px black;'>" . $v["lagerplats"]."</td>";
	echo "<td style='width:150px; text-align:center; border: solid 1px black;'>" ."<a href='delete.php?id=".  $v["id"] . "'>Delete</a></td>";
	echo "</tr>";
	
	
	}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
echo "</table>";
?>

</div>
</div>




</body>
</html>