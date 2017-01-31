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
  <h1 class="page-header" id="header">Invertering</h1>
</div>
</div>


<div class="row">
<div class="col-md-12">
<form method="post" id="input" > 
	<input  type="text" name="namn" id="tasklabel" placeholder="namn"/>
	
    <input  type="text" name="antal" id="tasklabel" placeholder="antal"/>
    
    <input  type="text" name="lagerplats" id="tasklabel" placeholder="lagerplats"/>
    <br />
	<input id="submit"  type="submit" value="Lägg till skiten">
	<br />
</form>
</div>
</div>


<div class="row">
<div id="table" class="col-md-12">
  <?php
echo "<table style='border: solid 1px black; margin: auto;	width: 50%; padding: 10px; text-align:center;'>";
echo "<tr><th style='text-align:center; border: solid 1px black;'>Namn</th><th style='text-align:center; border: solid 1px black;'>Antal</th><th style='text-align:center; border: solid 1px black;'>Lagerplats</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px; text-align:center; border: solid 1px black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 
/*
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";
*/

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT namn, antal, lagerplats FROM inventory"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
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