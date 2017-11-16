<?php
include'database.php';
// Prints tables
function print_table($conn, $sql) {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $rows = $stmt->fetchAll();
    $keys = array_keys($rows[0]);
    
    foreach ($keys as $name) {
        echo $name.' ';

    }
    echo "<br/>";
    foreach ($rows as $row) {
        foreach($row as $attribute) {
            echo $attribute . " ";
        }
        echo "<br/>";
    }
    echo "<br/>";
}

$conn = getDatabaseConnection();
$sqlone = "SELECT firstName, lastName, country_of_birth 
           FROM celebrity 
           WHERE gender = 'F' 
           AND NOT (country_of_birth = 'USA') 
           ORDER BY lastName";
/*echo'
<table>
    <tr>
        <th>firstName</th>
        <th>lastName</th>
        <th>country_of_birth</th>
    </tr>
';
foreach($record as $records)
{
    echo'<tr>';
    echo'<td>'.$records['firstName'].'</td>';
    echo'</tr>';
}
echo'</table>';*/
$sqltwo = "SELECT movie_category, count( movie_title ) 
           AS Number_of_Movies, avg( duration ) 
           AS Average_Duration
           FROM movie
           GROUP BY movie_category";
           
$sqlthree = "SELECT movie_title, movie_category, duration, company, release_year 
             FROM movie \n"
          . "WHERE release_year > 2000\n"
          . "ORDER BY duration DESC \n"
          . "LIMIT 3\n"
          . "";
          
$sqlfour = "SELECT firstName, lastName FROM celebrity c
            LEFT JOIN oscar o
            ON c.celebrityId = o.celebrity_id
            WHERE o.celebrity_id is NULL
            ORDER BY c.lastName";

$sqlfive = "SELECT firstName, lastName, movie_title, award_category, award_year FROM movie m
            JOIN oscar o
            ON m.movieId = o.movieId
            JOIN celebrity c
            ON o.celebrity_id = c.celebrityId
            JOIN award_category a
            ON o.award_cat_id = a.award_cat_id
            ORDER BY o.award_year";

print_table($conn, $sqlone);
print_table($conn, $sqltwo);
print_table($conn, $sqlthree);
print_table($conn, $sqlfour);
print_table($conn, $sqlfive);
?>
 