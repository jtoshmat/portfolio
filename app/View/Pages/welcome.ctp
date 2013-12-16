<?php
$uid = ($this->Session->read('CNA.uid'))?$this->Session->read('CNA.uid'):null;
$comefrom = ($this->Session->read('CNA.comefrom'))?$this->Session->read('CNA.comefrom'):null;

$action = "add";

if ($uid!==null){
	$Prospect = $this->requestAction("prospects/edit/".$uid);
	if ($Prospect){
		$action = "edit/".$uid;
	}else{
		$action = "add";

	}
}

?>
<script>
//Omniture vars
CNA.page_title = "CNA: Welcome page";
CNA.products = null;
</script>

<div class="cna_fieldset_div col-lg-12 col-md-12 col-sm-12 left-content" id="tell-us">
	<div class="quote-progress-bar">
		<ul class="steps">

			<li class="active"><span class="badge">1</span>You<span class="chevron"></span></li>
			<li><span class="badge">2</span>Questions<span class="chevron"></span></li>
			<li><span class="badge">3</span>Coverage<span class="chevron"></span></li>
			<?php if ($comefrom!='facebook' && $comefrom!='agent'):?>
			<li id="findyouragent"><span class="badge">4</span>Agent<span class="chevron"></span></li>
			<li id="meetyouragent"><span class="badge">5</span>Meet Agent<span class="chevron"></span></li>
			<li id="confirmation"><span class="badge">6</span>Confirmation</li>
			<?php else:?>
			<li><span class="badge">4</span>Meet Agent<span class="chevron"></span></li>
			<li><span class="badge">5</span>Confirmation</li>
			<?php endif;?>


		</ul>
	</div>
	<div class="container page-header">
		<h1>Business Insurance Needs Assessment</h1>
		<p>Thanks for your interest in American Family Business Insurance. To help us provide an accurate summary of your insurance needs, please take a few minutes to complete this online form. When you're done, we'll recommend some products for consideration. You'll then have the option of sending this information to an American Family agent for a follow-up discussion.</p>
	</div>
<div class="prospects form">
	<?php
		echo $this -> Form -> create('Prospect', array('action' => $action,'id'=>'tell-us'));

		$states = $this -> requestAction("States/get_state");
		echo $this -> Form -> input(
			'business_name', array(
				'div'   => array('class' => 'form-group col-xs-12 col-sm-12 col-md-12 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'Business Name <span class="required">*</span>',
				'class' => 'form-control',
				'value' => isset($Prospect['Prospect']['business_name'])?$Prospect['Prospect']['business_name']:''
				));
		echo $this -> Form -> input(
			'first_name', array(
				'div'   => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'First Name <span class="required">*</span>',
				'class' => 'form-control',
				'value' => isset($Prospect['Prospect']['first_name'])?$Prospect['Prospect']['first_name']:''
				));
		echo $this -> Form -> input(
			'last_name', array(
				'div'   => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'Last Name <span class="required">*</span>',
				'class' => 'form-control',
				'value' => isset($Prospect['Prospect']['last_name'])?$Prospect['Prospect']['last_name']:''
				));
		echo $this -> Form -> input(
			'address', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-12 col-md-12 control-group'),
				'label' => array('class' => 'control-label'),
				'class' => 'form-control',
				'value' => isset($Prospect['Prospect']['address'])?$Prospect['Prospect']['address']:''
				));
		echo $this -> Form -> input(
			'address2', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-12 col-md-12 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'Address 2',
				'class' => 'form-control',
				'value' => isset($Prospect['Prospect']['address2'])?$Prospect['Prospect']['address2']:''
				));
		echo $this -> Form -> input(
			'city', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'class' => 'form-control',
				'value' => isset($Prospect['Prospect']['city'])?$Prospect['Prospect']['city']:''
				));
		foreach($states as $st) { $options[$st['State']['id']] = $st['State']['short_name']; }
		echo $this -> Form -> input(
			'state_id', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-2 col-md-2 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'State <span class="required">*</span>',
				'type' => 'select',
				'options' => $options,
				'empty' => 'Select',
				'class' => 'form-control',
				'selected' =>isset($Prospect['State']['id'])?$Prospect['State']['id']:''
				));
		echo $this -> Form -> input(
			'zip_code', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-4 col-md-4 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'ZIP Code <span class="required">*</span>',
				'class' => 'form-control',
				'value' =>isset($Prospect['Prospect']['zip_code'])?$Prospect['Prospect']['zip_code']:''
				));
		echo $this -> Form -> input(
			'email', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'Email <span class="required">*</span>',
				'class' => 'form-control',
				'value' => isset($Prospect['Prospect']['email'])?$Prospect['Prospect']['email']:''
				));
/*
		echo $this -> Form -> input(
			'website', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'class' => 'form-control',
				'value' => isset($Prospect['Prospect']['website'])?$Prospect['Prospect']['website']:''
				));
*/

		echo $this -> Form -> input(
			'phone', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'class' => 'form-control',
				'value' => isset($Prospect['Prospect']['phone'])?$Prospect['Prospect']['phone']:''
				));
		echo $this -> Form -> input(
			'best_time_to_call', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'class' => 'form-control',
				'value' => isset($Prospect['Prospect']['best_time_to_call'])?$Prospect['Prospect']['best_time_to_call']:''
				));
		echo $this -> Form -> input(
			'ip_address', array(
				'value' => $this -> request -> clientIp(),
				'type' => 'hidden'
				));
		echo $this -> Form -> input(
			'ref', array(
				'value' => $this -> request -> referer(),
				'type' => 'hidden',
				'value' => isset($Prospect['Prospect']['ref'])?$Prospect['Prospect']['ref']:''
				));
		echo $this -> Form -> input(
			'agent', array(
				'id'=>'agent',
				'type' => 'hidden',
				'value' => isset($Prospect['Prospect']['agent'])?$Prospect['Prospect']['agent']:''

				));
		echo $this -> Form -> input(
			'status', array(
				'type' => 'hidden',
				'value' => 0
				));
		echo $this -> Form -> input(
		'id', array(
				'type' => 'hidden',
				'value' => $uid?$uid:''
		));
		echo $this -> Form -> input(
		'comefrom', array(
				'id' => 'comefrom',
				'type' => 'hidden',
				'value' => isset($Prospect['Prospect']['comefrom'])?$Prospect['Prospect']['comefrom']:''
		));

		echo $this -> Form -> input(
		'browser_info', array(
				'id' => 'browser_info',
				'type' => 'hidden',
				'value' => isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'Unknown'
		));

		$businesses = $this -> requestAction("businesses/index");
		$businesses_questions_check = $this -> requestAction("customs/index");

		function check_questions($b,$bid){
			$flag = 0;
			foreach ($b as $bus){
				if ($bus['Custom']['business_id'] == $bid && $bus['Custom']['status']==1){
					$flag = 1;
				}
			}
			return $flag;
		}

		foreach ($businesses as $bus) {
			$cbq = check_questions($businesses_questions_check, $bus['Business']['id']);
			if ($cbq==1 && $bus['Business']['active']==1){
				$bus_options[$bus['Business']['id']] = $bus['Business']['short_name'];
			}
		}
		if (isset($bus_options)){
		natcasesort($bus_options);
		echo $this -> Form -> input(
			'business_id', array(
				'div'     => array('class' => 'form-group col-xs-12 col-sm-12 col-md-12 control-group'),
				'label'   => array('class' => 'control-label'),
				'label'   => 'What type of business is this? <span class="required">*</span>',
				'type'    => 'select',
				'options' => $bus_options,
				'empty'   => 'Select',
				'class'   => 'form-control',
				'selected' =>isset($Prospect['Prospect']['business_id'])?$Prospect['Prospect']['business_id']:''
				));
}
		//echo $this -> Form -> end('Next');
	?>
	<?php
		$btn = (isset($bus_options))?"submit":"button";
	?>
	<div class="submit form-group col-xs-12 col-sm-12 col-md-12 control-group">
	<input type="<?php echo $btn;?>" value="Next" class="btn btn-primary">
	</div>
</div>
