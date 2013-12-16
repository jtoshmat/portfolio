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
//echo "<fieldset name=\"travel\" class=\"screen\" id=\"travel\">";
?>
<div class="page_title"><h2>Travel Insurance</h2></div>
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
 		}else if ($question_id==50){
			$uid = 50;
			echo "<li class='radio'>";
			echo "<label>$question_text</label>
			<label class='radio' for=\"$uid][responseValue]N\"><input id=\"question50_n\" type=\"radio\" value=\"No\" name=\"data[$uid][response_value]]\">No</label>
			<label class='radio' for=\"$uid][responseValue]Y\"><input id=\"question50_y\" type=\"radio\" value=\"Yes\" name=\"data[$uid][response_value]]\">Yes</label>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==51){
			$uid = 51;
			echo "<li id=\"q51\" class=\"havepolicy2\">";
			echo $this->Form->input("$uid][response_value]", array('value'=>'','label'=>$question_text,'placeholder' => '','div' =>'',

					"type" => "select",
					"options" => array(
					''=>'Select',
					'Within the next month' =>'Within the next month',
					'In 2-3 months' =>'In 2-3 months',
					'In 4-6 months' =>'In 4-6 months',
                    'In 7-12 months' =>'In 7-12 months',
					'A year or more from now' =>'A year or more from now'),
					"div" => "",
			));
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==52){
			$uid = 52;
			echo "<li class='multiple_products'>";
			$options = array("Trip Cancellation Insurance","Global Medical Insurance","Mexico Auto Insurance");
			echo "<label class='checkbox-label'>$question_text</label>";
			?>

        <ul class="product-row-items items">
          <li class="trip_cancellation">
            <label for=''>Trip Cancellation Insurance</label>
            <input class='' type='checkbox' name='' id='travel52_cancel' value='Trip Cancellation Insurance' />
            <p>Don't lose money because of a sudden illness or other trip-canceling circumstance.</p>
            <span class="uncheck-product"></span>
          </li>
          <li class="global_medical">
            <label for=''>Global Medical Insurance</label>
            <input  class='' type='checkbox' name='' id='travel52_medical' value='Global Medical Insurance' />
            <p>Be covered if you suddenly became ill while traveling in another country.</p>
            <span class="uncheck-product"></span>
          </li>
          <li class="mexico_auto">
            <label for=''>Mexico Auto Insurance</label>
            <input  class='' type='checkbox' name='' id='travel52_mexico' value='Mexico Auto Insurance' />
            <p>Stay covered when traveling with your vehicle across the U.S./Mexico border.</p>
            <span class="uncheck-product"></span>
          </li>
		 </ul>


            <?php
            echo "<li class=\"hidden_li\">". $this->Form->input("$uid][response_value]", array("value" => '', 'type' => 'hidden','id'=>'travel52_response')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==53){
			$uid = 53;
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

