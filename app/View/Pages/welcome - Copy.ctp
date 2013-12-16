<?php
	$zipcode = 52001;
?>
<div class="cna_fieldset_div col-lg-12 col-md-12 col-sm-12 left-content" id="tell-us">
	<div class="quote-progress-bar">
		<ul class="steps">
			<li class="active"><span class="badge">1</span>You<span class="chevron"></span></li>
			<li><span class="badge">2</span>Questions<span class="chevron"></span></li>
			<li><span class="badge">3</span>Coverage<span class="chevron"></span></li>
			<li><span class="badge">4</span>Agent<span class="chevron"></span></li>
			<li><span class="badge">5</span>Confirmation</li>
		</ul>
	</div>
	<div class="container page-header">
		<h1>Business Insurance Needs Assessment</h1>
		<p>Thanks for your interest in American Family Business Insurance. To help us provide an accurate summary of your insurance needs, please take a few minutes to complete this online form. When you're done, we'll recommend some products for consideration. You'll then have the option of sending this information to an American Family agent for a follow-up discussion.</p>
	</div>
	<?php
		echo $this -> Form -> create('Prospect',         array('action' => 'add'));
		$states = $this -> requestAction("States/get_state");
		echo $this -> Form -> input(
			'business_name', array(
				'div'   => array('class' => 'form-group col-xs-12 col-sm-12 col-md-12 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'Business Name <span class="required">*</span>',
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'first_name', array(
				'div'   => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'First Name <span class="required">*</span>',
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'last_name', array(
				'div'   => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'Last Name <span class="required">*</span>',
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'address', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-12 col-md-12 control-group'),
				'label' => array('class' => 'control-label'),
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'address2', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-12 col-md-12 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'Address 2',
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'city', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'class' => 'form-control'
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
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'zip_code', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-4 col-md-4 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'ZIP Code <span class="required">*</span>',
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'email', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'label' => 'Email <span class="required">*</span>',
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'website', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'phone', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'best_time_to_call', array(
				'div' => array('class' => 'form-group col-xs-12 col-sm-6 col-md-6 control-group'),
				'label' => array('class' => 'control-label'),
				'class' => 'form-control'
				));
		echo $this -> Form -> input(
			'ip_address', array(
				'value' => $this -> request -> clientIp(),
				'type' => 'hidden'
				));
		echo $this -> Form -> input(
			'ref', array(
				'value' => $this -> request -> referer(),
				'type' => 'hidden'
				));
		echo $this -> Form -> input(
			'agent', array(
				'type' => 'hidden'
				));
		echo $this -> Form -> input(
			'status', array(
				'type' => 'hidden',
				'value' => 0
				));
		$businesses = $this -> requestAction("businesses/index");
		foreach ($businesses as $bus) { $bus_options[$bus['Business']['id']] = $bus['Business']['short_name']; }
		echo $this -> Form -> input(
			'business_id', array(
				'div'     => array('class' => 'form-group col-xs-12 col-sm-12 col-md-12 control-group'),
				'label'   => array('class' => 'control-label'),
				'label'   => 'What type of business is this? <span class="required">*</span>',
				'type'    => 'select',
				'options' => $bus_options,
				'empty'   => 'Select',
				'class'   => 'form-control'
				));
		//echo $this -> Form -> end('Next');
	?>
	<div class="submit form-group col-xs-12 col-sm-12 col-md-12 control-group">
		<input type="submit" value="Next" class="btn btn-primary">
	</div>
</div>
<div class="cna_fieldset_div col-lg-12 col-md-12 col-sm-12 left-content active_fieldset" id="questions">
	<div class="quote-progress-bar">
		<ul class="steps">
			<li><span class="badge">1</span>You<span class="chevron"></span></li>
			<li class="active"><span class="badge">2</span>Questions<span class="chevron"></span></li>
			<li><span class="badge">3</span>Coverage<span class="chevron"></span></li>
			<li><span class="badge">4</span>Agent<span class="chevron"></span></li>
			<li><span class="badge">5</span>Confirmation</li>
		</ul>
	</div>
	<div class="container page-header">
		<h1>
			Questions:
			<?php
				$prospect_id = 1;
				$bid = 1;
				$total_parms = count($this -> request['pass']);
				//$bid = (isset($this -> request['pass'][0]))?filter_var($this -> request['pass'][0], FILTER_SANITIZE_NUMBER_INT):null;
				if (is_numeric($bid) == false) {
					exit("business id is blank");
					}
				$businessQuestions = $this -> requestAction("frontquestions/get_questions/".$bid);
				if (isset($businessQuestions[0]) == false) {
					exit('No Question is found');
					}
				echo $businessQuestions[0]['FrontQuestion']['Business'];
			?>
		</h1>
	</div>
	<?php
		echo $this -> Form -> create('ProspectResponse', array('action' => 'add'));
		function html_inputs($htmltype, $ranswer, $that, $qid, $question) {
			$options = "";
			if ($htmltype == 'radio') {
				for ($i=0; $i<count($ranswer);$i++) {
					$options .= "<label class=\"btn btn-default-grey radio-btn\" for=\"data[ProspectResponse][$qid][prospect_answer]\"><input type=\"radio\" name=\"data[ProspectResponse][$qid][prospect_answer]\" value=\"{$ranswer[$i]}\" class=\"form-control\">{$ranswer[$i]}</label>";
					}
				return "<div data-toggle=\"buttons\" style=\"margin-top: 15px;\" class=\"form-group\"><p class=\"control-label\">".$question."</p>".$options."</div>";
				}
				if ($htmltype == 'select') {
					$lists = "";
					for ($i=0; $i<count($ranswer); $i++) {
						$lists .= "<option value=\"{$ranswer[$i]}\">{$ranswer[$i]}</option>";
						}
					$options .= "<select name=\"data[ProspectResponse][$qid][prospect_answer]]\" class=\"form-control\">\$lists;</select>";
					return $question.": ".$options;
					}
				if ($htmltype == 'text') {
					$options = "<input name=\"data[ProspectResponse][$qid][prospect_answer]]\" type='text' class=\"form-control\">";
					return $question.": ".$options;
					}
				return "blank";
				}
			foreach ($businessQuestions as $bq) {
				$qid = $bq['Question']['id'];
				$rid = $bq['Response']['id'];
				$responseanswer = explode(";", $bq['FrontQuestion']['responseanswer']);
				echo "<div class='container'>";
				//echo $bq['FrontQuestion']['Question'] ." ".  html_inputs($bq['FrontQuestion']['Html'], $responseanswer, $this, $qid);
				echo html_inputs($bq['FrontQuestion']['Html'], $responseanswer, $this, $qid, $bq['FrontQuestion']['Question']);
				//echo $this -> Form -> input("$qid][response_id]", array('value' => $qid, 'label' => $bq['FrontQuestion']['Question'], 'placeholder' => '', 'div' =>'' ));
				echo "<div class=\"hidden_div\">". $this -> Form -> input("$qid][prospect_id]", array("value" => $prospect_id, 'type' => 'hidden')) ."</div>";
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
		<input type="submit" value="Next" class="btn btn-primary">
	</div>
</div>
<div class="cna_fieldset_div col-lg-12 col-md-12 col-sm-12 left-content active_fieldset" id="products">
	<div class="quote-progress-bar">
		<ul class="steps">
			<li><span class="badge">1</span>You<span class="chevron"></span></li>
			<li><span class="badge">2</span>Questions<span class="chevron"></span></li>
			<li class="active"><span class="badge">3</span>Coverage<span class="chevron"></span></li>
			<li><span class="badge">4</span>Agent<span class="chevron"></span></li>
			<li><span class="badge">5</span>Confirmation</li>
		</ul>
	</div>
	<div class="container page-header">
		<h1>Business Insurance Coverage Options</h1>
		<p>Based on the information you provided, the following products may best meet your business insurance needs.</p>
	</div>
	<?php
		$prospect_id = 1;
		$total_parms = count($this -> request['pass']);
		//$bid = (isset($this->request['pass'][0]))?filter_var($this->request['pass'][0], FILTER_SANITIZE_NUMBER_INT):null;
		if (is_numeric($prospect_id) == false) {
			exit("prospect id is blank");
			}
		$frontproducts = $this -> requestAction("frontproducts/get_products/".$prospect_id);
		foreach($frontproducts as $fp) {
			$prod = explode(";",$fp['FrontProduct']['products']);
			echo "<dl class='container'>";
			for ($i = 0; $i < count($prod); $i++) {
				if ($prod[$i] != '') {
					$products = $this -> requestAction("products/get_products/".$prod[$i]);
					}
				if ($products) {
					echo "<dt>".$products[0]['Product']['short_name']."</dt>";
					echo "<dd>".$products[0]['Product']['description']."</dd>";
					}
				}
			echo "</dl>";
			}
	?>
</div>
<div class="cna_fieldset_div col-lg-12 col-md-12 col-sm-12 left-content active_fieldset" id="findagent">
	<div class="quote-progress-bar">
		<ul class="steps">
			<li><span class="badge">1</span>You<span class="chevron"></span></li>
			<li><span class="badge">2</span>Questions<span class="chevron"></span></li>
			<li><span class="badge">3</span>Coverage<span class="chevron"></span></li>
			<li class="active"><span class="badge">4</span>Agent<span class="chevron"></span></li>
			<li><span class="badge">5</span>Confirmation</li>
		</ul>
	</div>
	<div class="container page-header">
		<h1>Find An Agent</h1>
	</div>
	<div id="locator">
		<div class="maindiv" id="main">
			<div class="sidebardiv" id="sidebar" style="visibility: visible;">
				<div id="closeSidebarDiv">
					<!-- input type="image" name="closeSidebar" id="closeSidebar" src="img/bigx.png" -->
				</div>
				<div class="searchdiv" id="searchWindow">
	                <h4> Enter ZIP Code</h4>
	                <div id="searchSubdiv">
		                    <input type="tel" maxlength="5" size="15" class="zipcode" name="zipcode" id="zipcode" value="<?php echo $zipcode;?>">
		                    <input type="button" name="zipcodebtn" id="zipcodebtn" class="gobutton">
		                </div>
                    <div id="mapView" class="mapView selected" onclick="switchAgentView('map');return false;">
	                    	<h4>View in a map</h4>
	                    </div>
                    <div id="listView" class="listView" onclick="switchAgentView('list');return false;">
	                    	<h4>View in a List</h4>
	                    </div>
				</div>
				<div class="resultsdiv selected" id="results">
						<div id="scrollbar1">
							<div class="scrollbar">
								<div class="track">
									<div class="thumb">
										<div class="end">
										</div>
									</div>
								</div>
							</div>
							<div class="viewport">
				 				<div class="overview">
				 					<div id="agentlist">
				 					</div>
				 				</div>
							</div>
						</div>
					</div>
			</div>
			<div class="mobilesidebar" id="mobilesidebar">
				<div class="searchdiv" id="searchWindow">
					<h2>Find An Agent</h2>
	                <h4>Enter ZipCode</h4>
	                <div id="searchSubdiv">
	                    <input type="tel" maxlength="5" size="15" class="zipcode" name="zipcode" id="mobilezipcode">
	                    <input type="button" name="zipcodebtn" id="mobilezipcodebtn" class="gobutton">
	                </div>
				</div>
			</div>
			<div class="mapdiv" id="map_canvas" style="position: relative; background-color: rgb(229, 227, 223); overflow: hidden;">
			<div id="legend">
				<div class="icondiv">
		        	<img src="img/location_bubble.png" class="legendicon">
		        	<h2> &nbsp;&nbsp;- Agent</h2>
		        </div>
				<div class="icondiv">
		        	<img src="img/marker-cluster.png" id="clustererImg" class="legendicon">
		        	<h2> &nbsp;&nbsp;- Multiple Agents</h2>
		        </div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="cna_fieldset_div col-lg-12 col-md-12 col-sm-12 left-content active_fieldset" id="confirmation">
	<div class="quote-progress-bar">
		<ul class="steps">
			<li><span class="badge">1</span>You<span class="chevron"></span></li>
			<li><span class="badge">2</span>Questions<span class="chevron"></span></li>
			<li><span class="badge">3</span>Coverage<span class="chevron"></span></li>
			<li><span class="badge">4</span>Agent<span class="chevron"></span></li>
			<li class="active"><span class="badge">5</span>Confirmation</li>
		</ul>
	</div>
	<div class="container page-header">
		<h1>Confirmation</h1>
	</div>
	<div class="container">
		<?php
			$settings = $this -> requestAction("sitesettings/view/1");
			if ($settings['SiteSetting']['short_name'] == 'responsys') {
				$cred = explode(";", $settings['SiteSetting']['value1']);
				$responsys_user = $cred[0];
				$responsys_pwd = $cred[1];
				}
			//$email = $this -> requestAction("emaillive/index/1");
			echo $this -> Form -> postLink(__('Email Test'), array('controller' => 'emaillive', 'action' => 'index', 1));
		?>
	</div>
</div>
<?php
	//echo $this -> Html -> link('Questions', '/form/questions', array('class' => 'button', 'target' => '_self'));
?>