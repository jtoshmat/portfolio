<?php
$uid = ($this->Session->read('CNA.uid'))?$this->Session->read('CNA.uid'):null;
$comefrom = ($this->Session->read('CNA.comefrom'))?$this->Session->read('CNA.comefrom'):null;
if ($uid!==null){
	$Prospect = $this->requestAction("prospects/edit/".$uid);
}

?>
<script>
//Omniture vars
CNA.page_title = "CNA: Meet Your Agent page";
CNA.products = null;
</script>

<div class="cna_fieldset_div col-lg-12 col-md-12 col-sm-12 left-content" id="tell-us">
	<div class="quote-progress-bar">
		<ul class="steps">

			<li><span class="badge">1</span>You<span class="chevron"></span></li>
			<li><span class="badge">2</span>Questions<span class="chevron"></span></li>
			<li><span class="badge">3</span>Coverage<span class="chevron"></span></li>
			<?php if ($comefrom!='facebook' && $comefrom!='agent'):?>
			<li id="findyouragent"><span class="badge">4</span>Agent<span class="chevron"></span></li>
			<li class="active"><span class="badge">5</span>Meet Agent<span class="chevron"></span></li>
			<li><span class="badge">6</span>Confirmation</li>
			<?php else:?>
			<li class="active"><span class="badge">4</span>Meet Agent<span class="chevron"></span></li>
			<li><span class="badge">5</span>Confirmation</li>
			<?php endif;?>
		</ul>
	</div>




<?php
parse_str($Prospect['Prospect']['agent'], $agent);
echo $agent['agentid_'];
echo "<br />";
echo $agent['fullname_'];
echo "<br />";
echo $agent['address_'];
echo "<br />";
echo $agent['image_'];
echo "<br />";
echo $agent['email_'];
echo "<br />";
echo $agent['phone_'];

?>




		<div class="submit form-group col-xs-12 col-sm-12 col-md-12 control-group">
		<input id="" type="button" value="Previous" class="btn btn-primary back_button">
		<input id="meetagent" alt="<?php echo $this->webroot; ?>/pages/confirmation" type="button"  value="Next" class="btn btn-primary forward_button">
		</div>

</div>


