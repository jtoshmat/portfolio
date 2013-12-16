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
<div class="page_title"><h2>Umbrella Insurance</h2></div>
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
 		}else if ($question_id==61){
			$uid = 61;
			echo "<li class='multiple_products'>";
			$options = array("Personal Liability Umbrella Insurance","Commercial Liabilty Umbrella Insurance","Farm/Ranch Liability Umbrella Insurance");
			echo "<label class='checkbox-label'>$question_text</label>";

?>

          <ul class="product-row-items items">
          <li class="personal_liability">
            <label for=''>Personal Liability Umbrella Insurance</label>
            <input class='' type='checkbox' name='' id='umbrella61_personal' value='Personal Liability Umbrella Insurance' />
            <p>Get an extra layer of protection on top of your primary liability coverage.</p>
            <span class="uncheck-product"></span>
          </li>
          <li class="commercial_liability">
            <label for=''>Commercial Liability Umbrella Insurance</label>
            <input class='' type='checkbox' name='' id='umbrella61_commercial' value='Commercial Liability Umbrella Insurance' />
            <p>Augment your existing business policy with supplementary liability protection.</p>
            <span class="uncheck-product"></span>
          </li>
          <li class="farm_liability">
            <label for=''>Farm/Ranch Liability Umbrella Insurance</label>
            <input class='' type='checkbox' name='' id='umbrella61_farm' value='Farm/Ranch Liability Umbrella Insurance' />
            <p>Pick up where your farm and ranch policy ends with an extra layer of protection.</p>
            <span class="uncheck-product"></span>
          </li>
		 </ul>
<?php

            echo "<li class=\"hidden_li\">". $this->Form->input("$uid][response_value]", array("value" => '', 'type' => 'hidden','id'=>'umbrella61_response')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==62){
			$uid = 62;
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

