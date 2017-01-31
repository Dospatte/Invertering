<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'root';
$db_name = 'inventory';

if (!isset($_GET['namn']))
{
    echo 'No ID was given...';
    exit;
}

$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($con->connect_error)
{
    die('Connect Error (' . $con->connect_errno . ') ' . $con->connect_error);
}

$sql = "DELETE FROM inventory WHERE namn = ?";
if (!$result = $con->prepare($sql))
{
    die('Query failed: (' . $con->errno . ') ' . $con->error);
}

if (!$result->bind_param('i', $_GET['namn']))
{
    die('Binding parameters failed: (' . $result->errno . ') ' . $result->error);
}

if (!$result->execute())
{
    die('Execute failed: (' . $result->errno . ') ' . $result->error);
}

if ($result->affected_rows > 0)
{
    echo "The ID was deleted with success.";
	echo "<html><meta http-equiv=\"refresh\" content=\"1;URL='http://localhost/invertering/index.php'\"><p>Please wait 1 seconds...</p></html>";
}
else
{
    echo "Couldn't delete the ID.";
}
$result->close();
$con->close();
