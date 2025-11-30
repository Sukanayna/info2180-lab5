<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = isset($_GET['country']) ? $_GET['country'] : '';
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<?php 
echo "
<table>
  <tr>
    <th>Country Name</th>
    <th>Continent</th>
    <th>Independence Year</th>
    <th>Head of State</th>
  </tr>";
foreach ($results as $row):
  echo "<tr><td>" . $row['name'] . "</td><td>". $row['continent'] . "</td><td>" . $row['independence_year'] 
  . "</td><td>" . $row['head_of_state'] . "</td></tr>"; 
 endforeach; 
 echo "</table>";
 ?>


