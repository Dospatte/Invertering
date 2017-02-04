<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "inventory";


$namn=$_POST['namn'];
$antal=$_POST['antal'];
$lagerplats=$_POST['lagerplats'];


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
?>	
	
<?php
if ($namn == null) {


} 
else {

    $sql = "INSERT INTO inventory (namn, antal, lagerplats)
    VALUES ('$namn', '$antal', '$lagerplats')";	
	$conn->exec($sql);
}
?>



<?php
$conn = null;
?>