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
<div class="page_title"><h2>Farm & Ranch Insurance</h2></div>
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
 		}else if ($question_id==56){
			$uid = 56;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
						<label class='radio' for=\"$uid][responseValue]N\"><input id=\"question".$uid."_n\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"question".$uid."_y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==57){
			$uid = 57;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
						<label class='radio' for=\"$uid][responseValue]N\"><input id=\"question".$uid."_n\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"question".$uid."_y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==58){
			$uid = 58;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
						<label class='radio' for=\"$uid][responseValue]N\"><input id=\"question".$uid."_n\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"question".$uid."_y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";

			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==59){
			$uid = 59;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
						<label class='radio' for=\"$uid][responseValue]N\"><input id=\"question".$uid."_n\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"question".$uid."_y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";

			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==60){
			$uid = 60;
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

