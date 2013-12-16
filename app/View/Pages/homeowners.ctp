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
//echo "<fieldset name=\"homeowners\" class=\"screen\" id=\"homeowners\">";
?>
<div class="page_title"><h2>Homeowners Insurance</h2></div>
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


/*		echo "<li>";
		echo $this->Form->input("$uid][response_value]", array("label" =>'',"type" => "text", "value" => 'tetsing', "div" => ""));
		echo "</li>";*/

		if ($question_id==1){
 		}else if ($question_id==26){
			$uid = 26;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',

					"type" => "select",
					"options" => array(''=>'Select','Condo' =>'Condo','Frame'=>'Frame','Modular'=> 'Modular','Other'=> 'Other'),
					"div" => "",
			));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==27){
			$uid = 27;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',

					"type" => "select",
					"options" => array(''=>'Select','Primary Residence' =>'Primary Residence','Secondary Residence'=>'Secondary Residence','Seasonal Residence'=> 'Seasonal Residence','Other'=> 'Other'),
					"div" => "",
			));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==29){
			$uid = 29;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'class'=>'yearonly','placeholder' => 'YYYY','div' =>'','length'=>4 ,'type'=>'tel'));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==30){
			$uid = 30;
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',

					"type" => "select",
					"options" => array(
					''=>'Select',
					'Asphalt/Fiberglass Shingles' => 'Asphalt/Fiberglass Shingles',
					'Wood Shakes/Shingles' => 'Wood Shakes/Shingles',
					'Metal' => 'Metal',
					'Slate' => 'Slate',
					'Clay Tile' => 'Clay Tile',
					'Other' =>'Other',
					),
					"div" => "",
			));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		} else if ($question_id==31){
			$uid = 31;
			echo "<li>";
            echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',
                    "type" => "select",
                    "id" => "vehicle_expires",
                    "options" => array(
                    ''=>'Select',
                    '1 year or less'=>'1 year or less',
                    '2 years'=> '2 years',
                    '3 years'=> '3 years',
                    '4 years'=> '4 years',
                    '5 years'=> '5 years',
                    '6 years'=> '6 years',
                    '7 years'=> '7 years',
                    '8 years or more'=> '8 years or more'),
                    "div" => ""
            ));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==32){
            $uid = 32;
            echo "<li class='radio'>";
            echo "<label>$question_text</label>
                        <label class='radio' for=\"$uid][responseValue]N\"><input id=\"$uid][responseValue]N\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
            <label class='radio' for=\"$uid][responseValue]Y\"><input id=\"$uid][responseValue]Y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
            echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
            echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
            echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
            echo "</li>";
        }else if ($question_id==33){
			$uid = 33;
			echo "<li class='radio havepolicy'>";
			echo "<label>$question_text</label>
			<label class='radio' for=\"$uid][responseValue]N\"><input id=\"$uid][responseValue]N\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"$uid][responseValue]Y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";

			//hidden
			$uid = 64;
			$id= 64;
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
		}else if ($question_id==34){
			$uid = 34;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
						<label class='radio' for=\"$uid][responseValue]N\"><input id=\"$uid][responseValue]N\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"$uid][responseValue]Y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==35){
			$uid = 35;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
						<label class='radio' for=\"$uid][responseValue]N\"><input id=\"$uid][responseValue]N\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"$uid][responseValue]Y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==36){
			$uid = 36;
			$lbl =$question_text."<br /><span class='confidential_info'>Please do not include any personal data such as Social Security numbers, credit card numbers or financial account details.</span>";
			echo "<li>";
			echo $this->Form->input("$uid][response_value]", array('type' => 'textarea', 'value'=>'','label'=>$lbl,'placeholder' => '','div' =>'' ));
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
