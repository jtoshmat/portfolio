<?php
if(!isset($_GET['data']) || $_GET['data'] == ''){
exit('Product id is missing');
}
/*
 * Every *.ctp files will be fetching the questions by product
 */
$product_id = $_GET['data'];
$question = $this->requestAction('Options/getQuestionsByProduct/'.$product_id);
?>
<div class="page_title"><h2>Business Insurance</h2></div>
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
		if ($question_id==2){
 		}else if ($question_id==43){
			$uid = 43;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',
					"type" => "select",
					"options" => array(
					''=>'Select',
					'Accounting Service' =>'Accounting Service',
					'Auto Service / Repair Shops'=>'Auto Service / Repair Shops',
					'Bakeries / Sweet Shops'=> 'Bakeries / Sweet Shops',
					'Barber / Beauty Shop'=> 'Barber / Beauty Shop',
					'Electrician'=> 'Electrician',
					'Manufacturing'=> 'Manufacturing',
					'Card / Gift Shop'=>'Card / Gift Shop',
					'Condo Association'=>'Condo Association',
					'Construction'=>'Construction',
					'Dental /Medical Office'=>'Dental /Medical Office',
					'Farm'=>'Farm',
					'Hotel / Lodging'=>'Hotel / Lodging',
					'Janitorial Services'=>'Janitorial Services',
					'Landscaping / Lawn care '=>'Landscaping / Lawn care ',
					'Law Office'=>'Law Office',
					'Painters'=>'Painters',
					'Pet Services'=>'Pet Services',
					'Professional Services'=>'Professional Services',
					'Residential Renting'=>'Residential Renting',
					'Restaurant/Food Service'=>'Restaurant/Food Service',
					'Other'=>'Other'
					),
					"div" => "",
			));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==44){
			$uid = 44;
			echo "<li>";
            echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',
                    "type" => "select",
                    "options" => array(
                    ''=>'Select',
				    'Less than 1 Year' =>'Less than 1 Year',
					'1 to 3 Years' => '1 to 3 Years',
					'4 to 7 Years' => '4 to 7 Years',
					'8 or More Years' => '8 or More Years'
                    ),
                    "div" => "", ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==45){
			$uid = 45;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',
					"type" => "select",
					"options" => array(
					''=>'Select',
					'1-10' =>'1-10',
					'11-50'=>'11-50',
					'More than 50'=> 'More than 50'
					),
					"div" => "",
			));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==46){
			$uid = 46;
			echo "<li class='radio havepolicy'>";
			echo "<label>$question_text</label>
			<label class='radio' for=\"$uid][responseValue]N\"><input type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";

			//hidden
			$uid = 65;
			$id= 65;
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
		}else if ($question_id==47){
			$uid = 47;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
			<label class='radio' for=\"$uid][responseValue]N\"><input id=\"question47_n\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"question47_y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==48){
			$uid = 48;
			echo "<li id=\"q48\" class=\"hidden_li\">";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'','class'=>'url' ,'type'=>'url'));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==49){
			$uid = 49;
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
