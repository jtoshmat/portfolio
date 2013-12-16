<?php
for ($i=0; $i<count($trim); $i++){
	if ($i==0){
		echo "<option>None</option>";
	}else{
		echo "<option>".$trim[$i]['Auto']['model_trim']."</option>";
	}
}
?>
