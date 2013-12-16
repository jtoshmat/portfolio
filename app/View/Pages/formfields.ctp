<?php
		$id = $q['questions']['id'];
		$question_text = trim($q['questions']['question_text']);
		$question_id = $q['questions']['id'];
		$product_id = $q['questions']['product_id'];
		$answer_type = $q['AnswerType']['type'];
		$answer_type_id = $q['questions']['answer_type_id'];
		$active = $q['questions']['active'];
		$response_text = isset($q['QuestionForm'][$tq]['response_text'])?$q['QuestionForm'][$tq]['response_text']:'';
		$tr = sizeof($q['QuestionForm']); //total responses for each question
		$additional_options = "";



		$response_11 = "";
		$response_11b = "";




		for ($i=1;$i<7;$i++){

			if ($i<6){
			$response_11 .= "<li class='auto11' id=\"answer_$i\">
			<label>Vehicle $i</label>
			<select class=\"carquery_year\" name=\"year_$i\" id=\"year_$i\">".display_car_year()."</select>
			<select class=\"carquery_make\" name=\"make_$i\" id=\"make_$i\"></select>
			<select class=\"carquery_model\" name=\"model_$i\" id=\"model_$i\"></select>

			<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>
			<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>
			</li>";
			}

			if ($i==6){
				$response_11b="<li id='autooptions6'><label>Vehicle $i or more <br />Please list the Year, Make and Model of any additional vehicles.</label><textarea id='autooptions6_value' rows='4' cols='30'></textarea></li>";
			}else{
				$response_11b="";
			}

			$response_11.=$response_11b;
		}



?>