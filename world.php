<?php
header ('Access-Control-Allow-Origin: *');
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$context = filter_input(INPUT_GET, 'context', FILTER_SANITIZE_STRING);

$country = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING);
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");

if ($context == 'cities') {
  $stmt = $conn->query("SELECT cities.name AS name, cities.district AS district, cities.population AS population
  FROM cities
  JOIN countries ON cities.country_code = countries.code
  WHERE countries.name LIKE '%$country%';");
  $stmt->execute();
}
else{
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%';");
  $stmt->execute();
}
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);




?>
<?php
if ($context == 'cities') {
  echo "
  <table>
    <tr>
      <th>City Name</th>
      <th>District</th>
      <th>Population</th>
    </tr>";
  foreach ($results as $row):
    echo "<tr><td>" . $row['name'] . "</td><td>". $row['district'] . "</td><td>" . $row['population'] 
    . "</td></tr>"; 
   endforeach; 
   echo "</table>";
   exit;
}
?>

<?php 
if ($context != 'cities')
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


