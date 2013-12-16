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
//echo "<fieldset name=\"medical\" class=\"screen\" id=\"medical\">";
?>
<div class="page_title"><h2>Medical/Dental Insurance</h2></div>
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
 		}else if ($question_id==54){
			$uid = 54;
			echo "<li class='multiple_products'>";
	        echo "<label class='checkbox-label'>$question_text</label>";
			$options = array("Health","Dental","Medicare Supplement Plus");
			?>

          <ul class="product-row-items items">
          <li class="health">
            <label for=''>Health Insurance<p class="disclaimer">&dagger;</p></label>
			<input id="medical54_health" class="medical54" type="checkbox" name="medical54" value="Health Insurance" />
            <p>Choose doctors and hospitals from an extensive provider network; get fast, accurate claims service.</p>
            <span class="uncheck-product"></span>
          </li>
          <li class="dental">
            <label for=''>Dental Insurance<p class="disclaimer">&dagger;&dagger;</p></label>
			<input  id="medical54_dental" class="medical54" type="checkbox" name="medical54" value="Dental Insurance" />
            <p>Select from three dental insurance plans and choose the one that best fits your budget.</p>
            <span class="uncheck-product"></span>
          </li>
          <li class="medicare_supplement">
            <label for=''>Medicare Supplement Plus<p class="disclaimer">&dagger;&dagger;&dagger;</p></label>
			<input id="medical54_medicare" class="medical54" type="checkbox" name="medical54" value="Medicare Supplement Plus" />
            <p>Get coverage for hospital benefits and outpatient services not fully covered by Medicare.</p>
            <span class="uncheck-product"></span>
          </li>
		 </ul>

            <?php
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][response_value]", array("value" => '', 'type' => 'hidden','id'=>'medical54_response')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][question_id]", array("value" => $id, 'type' => 'hidden')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][prospect_id]", array("value" =>'', 'type' => 'hidden','class'=>'prospect_id')) ."</li>";
			echo "<li class=\"hidden_li\">". $this->Form->input("$uid][uid]", array("value" =>$uid, 'type' => 'hidden')) ."</li>";
			echo "</li>";
		}else if ($question_id==55){
			$uid = 55;
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
<div class="footnote">
<p>&dagger;Health insurance offered through American Family Brokerage, Inc.</p>
<p>&dagger;&dagger;Dental insurance underwritten by Assurant Health.</p>
<p>&dagger;&dagger;&dagger;Medicare Supplement Insurance underwritten by American Republic Corp Insurance Company.</p>
</div>
</ul>

<div class="warning"></div>

              		<nav class="paging-buttons">
                        <a href="#" class="previous"> < Previous</a>
                        <a href="#" class="next">Next ></a>
                    </nav>
</div>


            	</div>

