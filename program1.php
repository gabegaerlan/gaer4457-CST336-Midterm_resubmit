<head>
    <!--<link rel="stylesheet" type="text/css" href="./styles.css"> -->
    <style>
        @import url("./styles.css");
    </style>
</head>
<form>
<input type="number" name="rows" min="1" max="4" value="3"/>
<input type="number" name="cols" min="1" max="4" value="3"/>
<input type="checkbox" name="eightball" value="eightball"/> Include 8 ball</br>
<input type="radio" name="ballOrder" value="ascending"/> Ascending
<input type="radio" name="ballOrder" value="descending"/> Descending
<input type="submit" value="Submit"/>
</form>
<table>
        <?php
        $rows = isset($_GET['rows']) ? $_GET['rows'] : 3;
        $columns = isset($_GET['cols']) ? $_GET['cols'] : 3;
        $eightball = $_GET['eightball'] == 'eightball' ? true : false;
        $randNum = 0;
        $numArray = range(0, 15);
        $numUsed = array();
        $evenSum = 0;
        $oddSum = 0;
        
        if(!$eightball)
        {
            array_splice($numArray,8,1);
            
        }
        
        shuffle($numArray);
        $numArray = array_slice($numArray, 0, $rows * $columns + 1);
        
        if(isset($_GET['ballOrder'])) {
            $order = $_GET['ballOrder'];
            
            if($order == 'ascending') {
                rsort($numArray);
            }
            
            if($order == 'descending') {
                sort($numArray);
            }
        }
        
    
        for ($i = 0; $i < $rows; $i++)
        {
			//Outer loop creates the table row <tr>
             echo "<tr>";
			//Inner loop creates the table columns <td>
            for($j = 0; $j < $columns; $j++)
            {
                $randNum = array_pop($numArray);
                //$randNum = array_rand($numArray, 1);
                //$randNum = $numArray[$randNum];
				//Inner loop creates the table columns <td>
                echo "<td>";
                if ($randNum % 2 == 0)
                {
                    echo "<img src='billiards/" . $randNum . ".png' alt='" . $randNum . " ball' id='even'>";
                    $evenSum += $randNum;
                } 
                else
                {
                    echo "<img src='billiards/" . $randNum . ".png' alt='" . $randNum . " ball' id='odd'>";
                    $oddSum += $randNum;
                }
                echo "</td>";
                array_push($numUsed, $numArray[$randNum]);
                //unset($numArray[$randNum]);
            }
            echo "</tr>";
            
        }
        
        ?>
</table>
