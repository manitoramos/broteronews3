<?php
$user="root"; // MYSQL USERNAME
$pass=""; // MYSQL PASSWORD
try {
    $dbh = new PDO('mysql:host=localhost;dbname=csgo', $user, $pass); // MYSQL DATABASE
   // foreach($dbh->query('SELECT * from game25') as $row) {
   //    print_r($row);
   // }
    //$dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>