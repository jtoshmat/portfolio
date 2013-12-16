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

if (!isset($question)){
	exit();
}

$is_mobile = 1;
//echo "<fieldset name=\"life\" class=\"screen\" id=\"life\">";
?>
<div class="page_title"><h2>Life Insurance</h2></div>
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
 		}else if ($question_id==41){
			$uid = 41;
			echo "<li class='multiple_products'>";
			echo "<label>$question_text</label>";
?>


		<ul class="product-row-items items">
		          <li class="term_life">
		             <label for='term-life'>Term Life Insurance</label>
					 <input checked="" id="life_insurance" type="checkbox" value="life" name="life_insurance" />
		             <p>Temporary protection to help with a mortgage or other temporary expenses.</p>
		             <span class="uncheck-product"></span></li>
		          <li class="whole_life">
		            <label for='business'>Whole Life Insurance</label>
					<input checked=""  id="whole_life_insurance" type="checkbox" value="wholelife" name="whole_life_insurance" />
		            <p>Long-term protection that builds cash value; premiums never increase.</p>
		            <span class="uncheck-product"></span></li>
		          <li class="universal_life">
		            <label for='business'>Universal Life Insurance</label>
					<input checked="" id="universal_life_insurance" type="checkbox" value="universallife" name="universal_life_insurance" />
		            <p>Flexibility to change your coverage amount and premium; cash value.</p>
		            <span class="uncheck-product"></span></li>
		</ul>



<?php
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][response_value]", array("value" => '','id'=>'life_41', 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==42){
			$uid = 42;
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

