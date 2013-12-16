<?php
if(!isset($_GET['data']) || $_GET['data'] == ''){
exit('Product id is missing');
}
/*
 * Every *.ctp files will be fetching the questions by product
 */
$product_id = $_GET['data'];
$question = $this->requestAction('Options/getQuestionsByProduct/'.$product_id);
//$promotions = $this->requestAction('promotions/getPromotion/'.$product_id);
$is_mobile = 1;
//echo "<fieldset name=\"power\" class=\"screen\" id=\"power\">";
?>
<div class="page_title"><h2>Recreational Vehicle Insurance</h2></div>
<div class="form-container">


<ul>

<?php
		$tq =0; //total questions counter
		$uid =0;
		foreach($question as $q){
		$id = $q['questions']['id'];
		$question_text = trim($q['questions']['question_text']);
		$question_id = $q['questions']['id'];
		//all active input fields
		if ($question_id==1){
 		}else if ($question_id==37){
			$uid = 37;
			echo "<li id=\"vehicle_1\" class=\"powervehicles\">";
			echo "<label>$question_text</label>";
            echo "<select class=\"select_vehicle\">
				  <option value=\"Select\">Select</option>
				  <option value=\"Boat\">Boat</option>
				  <option value=\"Personal Watercraft\">Personal Watercraft</option>
				  <option value=\"Motorcycle\">Motorcycle</option>
				  <option value=\"Camping RV\">Camping RV</option>
				  <option value=\"Other\">Other</option>
				  </select>";
			echo "<a style='display:none' href='#' class='del_vehicle' id=\"delete_vehicle_1\">Del</a>";
			echo "<label class='description'>Please provide description of vehicle, including the year, make model and number of CCs.</label>";
			echo "<textarea class='vehicle_input' type='text' rows='2' cols='30' placeholder=''></textarea>";
			echo "</li>";

			echo "<li class=\"hidden_li\">" .$this->Form->input("$uid][response_value]", array('value'=>'','id'=>'power_q_'.$uid.'','label'=>false,'placeholder' => '','div' =>'' ))."</li>";
			//echo "<li>". $this->Form->input("$uid][response_value]", array('id'=>'question38_input','type' => 'text','value'=>'','label'=>'','placeholder' => '','div' =>'' ))."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
            echo "<span><a href='#' id=\"add_vehicle\">Add Vehicle</a></span>";









		}else if ($question_id==38999){
			$uid = 38999;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('id'=>'question38_input','type' => 'textarea','value'=>'','label'=>$question_text,'placeholder' => '','div' =>'' ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
			echo "<li>Please provide description of vehicle, including the year, make model and number of CCs.</li>";
			echo "<li><a href='#' id=\"add_vehicle\">Add Vehicle</a> | <a href='#' id=\"delete_vehicle\">- Delete Vehicle</a> | <a href='#' id=\"submit\">Submit</a></li>";
		}
/*		else if ($question_id==39){
			$uid = 39;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'' ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}*/
		else if ($question_id==40){
			$uid = 40;
			$lbl =$question_text."<br /><span class='confidential_info'>Please do not include any personal data such as Social Security numbers, credit card numbers or financial account details.</span>";
			echo "<li class='power_comments'>";
			echo $this->Form->input("$uid][response_value]", array('type' => 'textarea','value'=>'','label'=>$lbl,'placeholder' => '','div' =>'' ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}

	}//end of foreach
?>
</ul>
<div class="warning"></div>
              		<nav class="paging-buttons">
                        <a href="#" class="previous"> < Previous</a>
                        <a href="#" class="next">Next ></a>
                    </nav>
</div>



            	</div>

