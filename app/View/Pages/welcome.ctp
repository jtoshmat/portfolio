<fieldset id="first" class="screen first" name="select">
<div class="page_title"><h2>Request a Quote</h2></div>
<div class="form-container">
<p>We'd like to help you find the right insurance to protect the people and things that make up your dreams.
Please select the type(s) of insurance for which you'd like a quote. An American Family agent will follow up with you.</p>
<div class="my_prospect_id"></div>
<?php
$products = $this->requestAction('products/getProducts');

if(isset($_GET['data']) && $_GET['data'] != ''){
	$data = $_GET['data']; //'{"a":1,"b":2,"c":3,"d":4,"e":5}';//
	$selection = json_decode($data);
}
$lang = 1;
if (isset($_SERVER['HTTP_X_LANGUAGE']) && isset($_SERVER['HTTP_X_FORWARDED_HOST'])){
	$lang=2;
}else{
	$lang = 1;
}
?>

<ul class="input-row-items items">
<?php
//displays these first time only
	$j=0;
	foreach($products as $p){
		echo "<li class=\"".strtolower($p['Product']['short_name'])."\"><label for='".strtolower($p['Product']['short_name']). "'>".$p['Product']['long_name']."</label><input class='".$p['Product']['omniture_name']."' type='checkbox' name='".strtolower($p['Product']['short_name'])."' id='option_".strtolower($p['Product']['short_name'])."' value='".$p['Product']['id']. "' data-product='".$p['Product']['product_name']."' />";
		echo "<span class=\"uncheck-product\"></span>";
		$j++;
	}
?>
<li class="btn-get_started"><a class="next">Get Started</a></li>
</ul>
<div class='warning' id='warning'></div>
</div><!-- end of form-container -->
</fieldset>

<fieldset id="tell-us-about-yourself" class="screen" name="tell-us-about-yourself">
<div class="page_title"><h2>Tell Us About Yourself</h2></div>
<div class="form-container">
<?php
$states = $this->requestAction('states/fetch');
$options = array();
foreach ($states as $state){
	$options[0] = "Select";
	foreach($state as $s){
	$options[$s['id']] = $s['abbreviation'];
	}
}
//Added by Jon Toshmatov 2/26
$langs = $this->requestAction('languages/fetch_lang');
$options_langs = array();
for ($a=0;$a<count($langs);$a++){
	$options_langs[$langs[$a]['Language']['id']] = $langs[$a]['Language']['long_name'];;
}
?>
<div class="my_prospect_id"></div>
<ul>
<?php
for ($p=0;$p<10;$p++){
echo "<li class=\"hidden_li\"><input class='prodid' id=\"prod_$p\" type='hidden' size='3' name='ProspectProduct[$p]' value='' /></li>";
}
echo "<li class=\"hidden_li\">" .$this->Form->input('Prospect.id', array('value'=>'', 'type' => 'hidden','div' =>'')). "</li>";
?>
<li class="required">
<?php
echo "\n";
echo $this->Form->input('Prospect.first_name', array(
		'value'=>'',
		'required' => true,
		'placeholder' => 'First Name',
		'div' =>'',
		'after' => '<!-- mp_trans_disable_end -->',
		'between' => '<!-- mp_trans_disable_start -->'
		));
echo "\n";
?>
</li>

<li class="required">
<?php
echo "\n";
echo $this->Form->input('Prospect.last_name', array(
		'value'=>'',
		'required' => true,
		'placeholder' => 'Last Name',
		'div' =>'',
		'after' => '<!-- mp_trans_disable_end -->',
		'between' => '<!-- mp_trans_disable_start -->'
		));
echo "\n";
?>
</li>

<li>
<?php
echo "\n";
echo $this->Form->input('Prospect.address', array(
		'value'=>'',
		'div' =>'',
		'after' => '<!-- mp_trans_disable_end -->',
		'between' => '<!-- mp_trans_disable_start -->'
		));
echo "\n";
?>
</li>



<li><?php echo $this->Form->input('Prospect.address2', array('label'=>'Address 2','value'=>'','div' =>'')); ?></li>
<li><?php echo $this->Form->input('Prospect.city', array('value'=>'','div' =>'')); ?></li>
<li class="required"><?php
 echo $this->Form->input('Prospect.state_id', array(
    'type'    => 'select',
    'options' => $options,
 	'div' => 'prospect_states',
	'class'=>'required',
    'empty'   => false));
?>
<?php echo $this->Form->input('Prospect.zipcode', array('maxlength'=>5,'label'=>array('text'=>'ZIP Code','class'=>'zipcode'),'value'=>'','required' => true,'div' =>'','class'=>'required zipcode','type'=>'tel')); ?></li>
<li class="required"><?php echo $this->Form->input('Prospect.email_address', array('value'=>'','required' => true,'placeholder' => 'Email Address','div' =>'','type'=>'email')); ?></li>
<li class="callme"><label>Call Me?</label>
	<label class='radio' for="Prospect.callme">
		<input id="callme" type="checkbox" value="Yes" name="data[Prospect][callme]">Yes</label>
		<?php echo $this->Form->input('Prospect.phone_number', array('label'=>array('class' => 'phonenumber'),'value'=>'','div' =>'',"type" =>'tel')); ?></li>
<li id="bestimetocall"><?php echo $this->Form->input('Prospect.bestimetocall', array('value'=>'','placeholder' => '','label'=>'Best time to call','div' =>'' )); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.language_id', array('value'=>1, 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.origin_type_id', array('value'=>1, 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.device_type_id', array('value'=>$lang, 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.agent_facebook', array('value'=>'', 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.global_nick', array('value'=>'hello', 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.agent_email_address', array('value'=>'', 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.agentid', array('value'=>'', 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.agentname', array('value'=>'', 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.status', array('value'=>'0', 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.agent_first_name', array('value'=>'agent first name', 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.agent_last_name', array('value'=>'agent last name', 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.agent_state', array('value'=>'IA', 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('Prospect.ref', array('value'=>'', 'type' => 'hidden','div' =>'')); ?></li>
<li class="hidden_li"><?php echo $this->Form->input('host', array('value'=>''.cakeRequest::host().'', 'type' => 'hidden','div' =>'','id'=>'host')); ?></li>


</ul>
<div class='warning' id='warning'></div>
	<nav class="paging-buttons">
	<a href="#" class="previous"> < Previous</a>
	<a href="#" class="next">Next ></a>
</nav>
</div>
</fieldset>
<fieldset id="findyouragent" class="screen" name="findyouragent"></fieldset>
<fieldset id="meetyouragent" class="screen" name="meetyouragent"></fieldset>
<fieldset id="thankyou" class="screen last" name="thankyou"></fieldset>