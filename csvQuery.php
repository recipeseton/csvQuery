
<?php

//This function reads the csv file and stores it in an array
function initializeTable($fileURL){
  $result = array();
  if(file_exists($fileURL)){
  $file = fopen($fileURL, 'r');
  while(!feof($file)){
    array_push($result,fgetcsv($file));
  }
  fclose($file);
  }
  else{
	  echo $fileURL." not found...<br>";
  }

  return $result;
}


 function displaySelectedColumns($result_column = array()){
   echo '<table border=1 class="table-hover">';
   //echo '<pre>',print_r($result_column),'</pre>';
   for($j = 0; $j < count($result_column[0]); $j++){
     echo '<tr>';
     for($i = 0; $i < count($result_column); $i++){
       echo '<td>'.$result_column[$i][$j].'</td>';
     }
     echo '</tr>';
   }
   echo '</table>';

 }


function processColumns($fileURL, $columns = array()){
  $result  = initializeTable($fileURL);
  $assoc = explode(",", strtolower(implode(",", $result[0])));
  $result_column = array();

  foreach($columns as $col){
    if(in_array($col, $assoc)){
      $value = array_search($col, $assoc);
      $result_col = array_column($result, $value);
      array_push($result_column, $result_col);
    }
    else{
		    echo "column ".$col." not found<br/>";
	     }
  }
  //displaySelectedColumns($result_column);
  return $result_column;
}



function rotateTable($mat){
    $height = count($mat);
    $width = count($mat[0]);
    $mat90 = array();

    for ($i = 0; $i < $width; $i++) {
        for ($j = 0; $j < $height; $j++) {
            $mat90[$height - $i - 1][$j] = strtolower($mat[$height - $j - 1][$i]);
        }
    }

    return $mat90;
}

//Uncomment this function if PHP version < 5.5

// function array_column($arrayName = array(), $key){
// 	$result = array();
// 	foreach($arrayName as $array){
// 		for($i = 0; $i < count($arrayName); $i++){
// 			if($i == $key){
// 				array_push($result,$array[$key]);
// 			}
// 		}
// 	}
// 	return $result;
// }


function inArrayTest($arrayName = array(), $value){
  $result = false;
  if(in_array($value, $arrayName)){
    $result = true;
  }
  return $result;
}



function mainQuery($fileURL, $columns=array(), $conditions=array(), $border = 1, $class="table-hover"){
  $result = processColumns($fileURL, $columns);
  $rotated = rotateTable($result);
  //$condition = false;
  echo '<table border='.$border.' class='.$class.'>';
  echo '<tr>';
    foreach($columns as $col){
      echo '<th>'.strtoupper($col).'</th>';
    }
  echo '</tr>';
  //echo '<pre>',print_r($rotated[1]),'</pre>';
  foreach($rotated as $row){


    if(in_array(strtolower($conditions[0]), $row) && in_array(strtolower($conditions[1]), $row)){
      echo '<tr>';
	  for($i = count($row)-1; $i >= 0; $i--){
        echo '<td>'.strtoupper($row[$i]).'</td>';
      }
	  echo '</tr>';
    }

  }

  echo '</table>';

}

?>
