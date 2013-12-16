<?php
//$_GET['data'] = 1;//<-- this will be deleted once I am done with testing. - JT
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
//echo "<fieldset name=\"renters\" class=\"screen\" id=\"renters\">";
?>
<div class="page_title"><h2>Renters Insurance</h2></div>
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
 		}else if ($question_id==21){
			$uid = 21;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',

					"type" => "select",
					"options" => array(''=>'Select','Single Family' =>'Single Family','2 Units'=>'2 Units','3 Units'=> '3 Units','4 Units'=>'4 Units','5 More Units'=>'5 or More Units'),
					"div" => "",
			));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==22){
			$uid = 22;
			echo "<li>";
            echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',
                    "type" => "select",
                    "options" => array(
                    ''=>'Select',
                    '1' =>'1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7 or more' => '7 or more'
                    ),
                    "div" => "", ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==23){
			$uid = 23;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
						<label class='radio' for=\"$uid][responseValue]N\"><input id=\"$uid][responseValue]N\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"$uid][responseValue]Y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==24){
			$uid = 24;
			echo "<li class='radio havepolicy'>";
			echo "<label>$question_text</label><label class='radio' for=\"$uid][responseValue]N\"><input id=\"$uid][responseValue]N\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>";
			echo "<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"$uid][responseValue]Y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";

			//hidden
			$uid = 63;
			$id= 63;
			$question_text = "When does your policy expire?";
			echo "<li class='havepolicy2' id=\"question_$uid\">";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',
					"type" => "select",
					"id" => "vehicle_expires",
					"options" => array(''=>'Select','Next 30 days'=>'Next 30 days','Next 1 to 3 Months'=>'Next 1 to 3 Months','Next 3 to 6 Months'=>'Next 3 to 6 Months','Next 6 to 12 Months'=>'Next 6 to 12 Months'),
					"div" => ""

			));
					echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
					echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
					echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
		}else if ($question_id==25){
			$uid = 25;
			$lbl =$question_text."<br /><span class='confidential_info'>Please do not include any personal data such as Social Security numbers, credit card numbers or financial account details.</span>";
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('type' => 'textarea','value'=>'','label'=>$lbl,'placeholder' => '','div' =>'' ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}/*else if ($question_id==26){
			$uid = 26;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',

					"type" => "select",
					"options" => array('Condo','Frame','Modular'),
					"div" => "",


			));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==28){
			$uid = 28;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'' ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}*/

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

