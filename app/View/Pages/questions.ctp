<?php
$uid = ($this->Session->read('CNA.uid'))?$this->Session->read('CNA.uid'):null;
$qid_updated = ($this->Session->read('CNA.qid'))?$this->Session->read('CNA.qid'):null;
$comefrom = ($this->Session->read('CNA.comefrom'))?$this->Session->read('CNA.comefrom'):null;
$ProspectResponse = null;
if ($uid!==null){
	$Prospect = $this->requestAction("prospects/edit/".$uid);
	$ProspectResponse = $this->requestAction("ProspectResponses/prospect_response_find/".$uid);
	$bid = $Prospect['Prospect']['business_id'];
}
if (isset($bid)==false){
	exit('Business is not selected');
}
if (is_numeric($bid) == false) {
	exit("Business is blank");
}
$businessQuestions = $this -> requestAction("frontquestions/get_questions/".$bid);
if (isset($businessQuestions[0]) == false) {
	exit ('No Question is found');
}

if ($qid_updated!=null){
$qsaved = $qid_updated['question_id'];
}

function update_questions($qid,$qsaved){
	if (!array_key_exists($qid,$qsaved)){return false;}
 	if ($qsaved[$qid]!='' || $qsaved[$qid]!=null){return $qsaved[$qid];}
}

//pr($qid_updated['question_id']);
?>

<script>
//Omniture vars
CNA.page_title = "CNA: Questions page";
CNA.products = "productsaaaaaaaaaaaaaaaa";
</script>

<div class="cna_fieldset_div col-lg-12 col-md-12 col-sm-12 left-content active_fieldset" id="questions">
	<div class="quote-progress-bar">
		<ul class="steps">
			<li><span class="badge">1</span>You<span class="chevron"></span></li>
			<li class="active"><span class="badge">2</span>Questions<span class="chevron"></span></li>
			<li><span class="badge">3</span>Coverage<span class="chevron"></span></li>
			<?php if ($comefrom!='facebook' && $comefrom!='agent'):?>
			<li id="findyouragent"><span class="badge">4</span>Agent<span class="chevron"></span></li>
			<li><span class="badge">5</span>Meet Agent<span class="chevron"></span></li>
			<li><span class="badge">6</span>Confirmation</li>
			<?php else:?>
			<li><span class="badge">4</span>Meet Agent<span class="chevron"></span></li>
			<li><span class="badge">5</span>Confirmation</li>
			<?php endif;?>
		</ul>
	</div>
	<div class="container page-header">
		<h1>
			<?php echo "Questions: ".$businessQuestions[0]['FrontQuestion']['Business'];?>
		</h1>
	</div>
	<?php
		echo $this -> Form -> create('ProspectResponse', array('action' => 'add'));
		function html_inputs($htmltype, $ranswer, $that, $qid, $question,$ans) {
			$options = "";
			if ($htmltype == 'radio') {
				for ($i=0; $i<count($ranswer);$i++) {
						if ($ans==$ranswer[$i]){
							$options .= "<label class=\"btn btn-default-grey radio-btn\" for=\"data[ProspectResponse][$qid][prospect_answer]\"><input checked = \"checked\" type=\"radio\" name=\"data[ProspectResponse][$qid][prospect_answer]\" value=\"{$ranswer[$i]}\" class=\"form-control\">{$ranswer[$i]}</label>";
						}else{
							$options .= "<label class=\"btn btn-default-grey radio-btn\" for=\"data[ProspectResponse][$qid][prospect_answer]\"><input type=\"radio\" name=\"data[ProspectResponse][$qid][prospect_answer]\" value=\"{$ranswer[$i]}\" class=\"form-control\">{$ranswer[$i]}</label>";
						}
					}
				return "<div data-toggle=\"buttons\" style=\"margin-top: 15px;\" class=\"form-group\"><p class=\"control-label\">".$question."</p>".$options."</div>";
				}
				if ($htmltype == 'select') {
					$lists = "";
					for ($i=0; $i<count($ranswer); $i++) {
						if ($ans==$ranswer[$i]){
							$lists .= "<option selected value=\"{$ranswer[$i]}\">{$ranswer[$i]}</option>";
						}else{
							$lists .= "<option value=\"{$ranswer[$i]}\">{$ranswer[$i]}</option>";
						}

					}
					$options .= "<select name=\"data[ProspectResponse][$qid][prospect_answer]]\" class=\"form-control\">$lists;</select>";
					return $question.": ".$options;
					}
				if ($htmltype == 'text') {
					$options = "<input name=\"data[ProspectResponse][$qid][prospect_answer]]\" type='text' value='{$ans}' class=\"form-control\">";
					return $question.": ".$options;
					}
				return "blank";
				}
			foreach ($businessQuestions as $bq) {
				$qid = $bq['Question']['id'];
				$rid = $bq['Response']['id'];
				$business_id = $bq['FrontQuestion']['business_id'];
				//$qupdate = update_questions($qid_updated['question_id'],$qid);
				//echo $qupdate;
				$ans = ($qid_updated!=null)?update_questions($qid,$qsaved):null;
				$responseanswer = explode(";", $bq['FrontQuestion']['responseanswer']);
				echo "<div class='container'>";
				//echo $bq['FrontQuestion']['Question'] ." ".  html_inputs($bq['FrontQuestion']['Html'], $responseanswer, $this, $qid);
				echo html_inputs($bq['FrontQuestion']['Html'], $responseanswer, $this, $qid, $bq['FrontQuestion']['Question'],$ans);
				//echo $this -> Form -> input("$qid][response_id]", array('value' => $qid, 'label' => $bq['FrontQuestion']['Question'], 'placeholder' => '', 'div' =>'' ));
				echo "<div class=\"hidden_div\">". $this -> Form -> input("$qid][prospect_id]", array("value" => $uid, 'type' => 'hidden')) ."</div>";
				echo "<div class=\"hidden_div\">". $this -> Form -> input("$qid][business]", array("value" => $bq['FrontQuestion']['Business'], 'type' => 'hidden', 'class' => 'business')) ."</div>";
				echo "<div class=\"hidden_div\">". $this -> Form -> input("$qid][question]", array("value" => $bq['FrontQuestion']['Question'], 'type' => 'hidden')) ."</div>";
				echo "<div class=\"hidden_div\">". $this -> Form -> input("$qid][responseid]", array("value" => $bq['FrontQuestion']['Response'], 'type' => 'hidden', 'class' => 'response')) ."</div>";
				echo "<div class=\"hidden_div\">". $this -> Form -> input("$qid][products]", array("value" => $bq['FrontQuestion']['products'], 'type' => 'hidden', 'class' => 'products')) ."</div>";
				echo "<div class=\"hidden_div\">". $this -> Form -> input("$qid][business_id]", array("value" => $bid, 'type' => 'hidden', 'class' => 'products')) ."</div>";
				echo "<div class=\"hidden_div\">". $this -> Form -> input("$qid][question_id]", array("value" => $qid, 'type' => 'hidden', 'class' => 'questions')) ."</div>";
				echo "</div>";
				}
		//echo $this -> Form -> end('Next');
	?>
	<div class="submit form-group col-xs-12 col-sm-12 col-md-12 control-group">
		<input id="questions" alt="<?php echo $this->webroot; ?>" type="button" value="Previous" class="btn btn-primary back_button">
		<input type="submit" value="Next" class="btn btn-primary">
	</div>
</div>