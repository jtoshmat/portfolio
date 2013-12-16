<?php
$uid = ($this->Session->read('CNA.uid'))?$this->Session->read('CNA.uid'):null;
$comefrom = ($this->Session->read('CNA.comefrom'))?$this->Session->read('CNA.comefrom'):null;
if ($uid!==null){
	$Prospect = $this->requestAction("prospects/edit/".$uid);
	$action = "edit/".$uid;
}else{
	$action = "add";
}
if ($uid==''){
	exit('Prospect is invalid');
}
if (is_numeric($uid) == false) {
	exit("prospect id is blank");
}
?>

<script>
//Omniture vars
CNA.page_title = "CNA: Products page";
CNA.products = null;
//document.location = "../";
</script>

<div class="cna_fieldset_div col-lg-12 col-md-12 col-sm-12 left-content active_fieldset" id="products">
	<div class="quote-progress-bar">
		<ul class="steps">
			<li><span class="badge">1</span>You<span class="chevron"></span></li>
			<li><span class="badge">2</span>Questions<span class="chevron"></span></li>
			<li class="active" ><span class="badge">3</span>Coverage<span class="chevron"></span></li>
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
		<h1>Business Insurance Coverage Options</h1>
		<p>Based on the information you provided, the following products may best meet your business insurance needs.</p>
	</div>
	<?php
		$total_parms = count($_GET);
		$bid = (isset($_GET['bid']))?filter_var($_GET['bid'], FILTER_SANITIZE_NUMBER_INT):null;
		$frontproducts = $this -> requestAction("frontproducts/get_products/".$uid);
		$beendisplayed = [];
		$beensaved = [];
 		foreach($frontproducts as $fp) {
			if ($fp['FrontProduct']['business_id']==$bid){
				$beendisplayed[] = explode(";",$fp['FrontProduct']['products']);
			}
		}

		for ($a=0; $a<count($beendisplayed); $a++){
		$beensaved[] = $beendisplayed[$a];
		}

			echo "<dl class='container'>";
			//$bd = array_unique($beensaved);
			foreach($beensaved as $bd2) {
 			foreach($bd2 as $bd3) {
				$products = $this -> requestAction("products/get_products/".$bd3);
				if ($products) {
					//echo $products[0]['Product']['id'];
					echo "<dt>".$products[0]['Product']['short_name']."</dt>";
					echo "<dd>".$products[0]['Product']['description']."</dd>";
				}
			}

			}
			echo "</dl>";

	?>

		<div class="submit form-group col-xs-12 col-sm-12 col-md-12 control-group">
		<input id="" alt="<?php echo $this->webroot; ?>/pages/questions" type="button" value="Previous" class="btn btn-primary back_button">
		<?php if ($comefrom=='facebook' || $comefrom=='agent'):?>
		<input id="products" alt="<?php echo $this->webroot; ?>pages/meetyouragent" type="button"  value="Next" class="btn btn-primary forward_button">
		<?php else:?>
		<input id="products" alt="<?php echo $this->webroot; ?>pages/findyouragent" type="button"  value="Next" class="btn btn-primary forward_button">
		<?php endif;?>
		</div>
</div>
