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
//echo "<fieldset name=\"auto\" class=\"screen\" id=\"auto\">";
?>
<div class="page_title"><h2>Auto Insurance</h2></div>
<div class="form-container">

<ul>
<?php
$autos = $this->requestAction('Autos/getAutos');
function display_car_year(){
$year = date('Y');
$year2 = date('Y') - 30;
$options = "<option selected>Select Year</option>";
for($y=$year; $y>=$year2; $y--){
	$options .= "<option>".$y."</option>";
}
return $options;
}

$tq =0; //total questions counter
		$uid =0;
		foreach($question as $q){
		include ('formfields.ctp');	//<-- this file has all the form type settings, $field_type
		//all active input fields
		if ($question_id==1){
 		}else if ($question_id==2){
			$uid = 2;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'' ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==3){
			$uid = 3;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'' ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==5){
			$uid = 5;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'' ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==11){
			$uid = 11;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',
 					"type" => "select",
					"id" => "auto11_options",
					"options" => array('Select',1,2,3,4,5,'6'=>'6 or more'),
					"div" => "",
					"name" => ""
			));
			echo "<input id=\"autoresponse11\" name=\"data[$uid][response_value]]\" type=\"hidden\">";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
			echo $response_11;

		} else if ($question_id==12){
			$uid = 12;
			echo "<li class=\"hidden_li\">";
			echo "<input id=\"autooptions\" name=\"data[$uid][response_value]]\" type=\"hidden\">";
			//echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'' ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==13){
			$uid = 13;
			echo "<li>";
            echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',
                    "type" => "select",
                    "id" => "auto13_drivers",
                    "options" => array(0=>'Select',1,2,3,4,5,'6'=>'6 or more'),
                    "div" => "",
                    "name" => ""
            ));
            echo "<input id=\"autoresponse13\" name=\"data[$uid][response_value]]\" type=\"hidden\">";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==14){
			$uid = 14;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
			<label class='radio' for=\"$uid][responseValue]N\"><input class=\"autoquestion14\" id=\"question14_n\" type=\"radio\" value=\"No\" name=\"autoresponse14options\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input class=\"autoquestion14\" id=\"question14_y\" type=\"radio\" value=\"Yes\" name=\"autoresponse14options\">Yes</label>";
			echo "<div id='teenssavedriver'>
				Our teen safe driver program is proven to reduce risky driving behavior by over 70%. <a target='blank' title='Learn More About Teen Safe Driver Program' href='http://www.amfam.com/microsites/teen-safe-driver/?tid=ap96'>Learn more</a>
			</div>";
			echo "<input id=\"autoresponse14\" value=\"\" name=\"data[$uid][response_value]]\" type=\"hidden\">";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==15){
			$uid = 15;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
			<label class='radio' for=\"$uid][responseValue]N\"><input class=\"autoquestion15\" name=\"autoresponse15options\"  id=\"question15_n\" type=\"radio\" value=\"No\" >No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input class=\"autoquestion15\" name=\"autoresponse15options\"  id=\"question15_y\" type=\"radio\" value=\"Yes\" >Yes</label>";
			echo "<input id=\"autoresponse15\" value=\"\" name=\"data[$uid][response_value]]\" type=\"hidden\">";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==16){
			$uid = 16;
			echo "<li id=\"question_$uid\">";
		 	echo $this->Form->input("$uid][response_value]", array('value'=>' ','label'=>$question_text,'placeholder' => '','div' =>'',
 					"type" => "select",
					"id" => "vehicle_expires",
					"options" => array(''=>'Select','Next 30 days'=>'Next 30 days','Next 1 to 3 Months'=>'Next 1 to 3 Months','Next 3 to 6 Months'=>'Next 3 to 6 Months','Next 6 to 12 Months'=>'Next 6 to 12 Months'),
					"div" => ""

			));
		 	echo "<input id=\"autoresponse16\" name=\"data[$uid][response_value]]\" type=\"hidden\">";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==17){
			$uid = 17;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
			<label class='radio' for=\"$uid][responseValue]N\"><input id=\"$uid][responseValue]N\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"$uid][responseValue]Y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";

		}else if ($question_id==18){
			$uid = 18;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"$uid][responseValue]Y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>
			<label class='radio' for=\"$uid][responseValue]N\"><input id=\"$uid][responseValue]N\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==19){
			$uid = 19;
			$lbl =$question_text."<br /><span class='confidential_info'>Please do not include any personal data such as Social Security numbers, credit card numbers or financial account details.</span>";
			echo "<li>";
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

