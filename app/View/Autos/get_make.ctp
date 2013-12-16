<?php
echo "<option selected >Select Make</option>";
for ($i=0; $i<count($make); $i++){
	echo "<option>".$make[$i]['Auto']['model_make_id']."</option>";
}
?>
