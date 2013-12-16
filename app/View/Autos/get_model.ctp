<?php
echo "<option selected >Select Model</option>";
for ($i=0; $i<count($model); $i++){
	echo "<option>".$model[$i]['Auto']['model_name']."</option>";
}
?>
