<?php
$uid = ($this->Session->read('CNA.uid'))?$this->Session->read('CNA.uid'):null;
$comefrom = ($this->Session->read('CNA.comefrom'))?$this->Session->read('CNA.comefrom'):null;
$Prospect = null; $zipcode = null;$action = "add";
if ($uid!==null){
	$Prospect = $this->requestAction("prospects/edit/".$uid);
	$zipcode =(isset($Prospect['Prospect']['zip_code']))?$Prospect['Prospect']['zip_code']:null;
	if ($Prospect){
		$action = "edit/".$uid;
	}else{
		$action = "add";
	}
}

?>
<script>
//Omniture vars
CNA.page_title = "CNA: Find Your Agent page";
CNA.products = null;
//initialize();

</script>

<div class="cna_fieldset_div col-lg-12 col-md-12 col-sm-12 left-content" id="tell-us">
	<div class="quote-progress-bar">
		<ul class="steps">

			<li><span class="badge">1</span>You<span class="chevron"></span></li>
			<li><span class="badge">2</span>Questions<span class="chevron"></span></li>
			<li><span class="badge">3</span>Coverage<span class="chevron"></span></li>
			<?php if ($comefrom!='facebook' && $comefrom!='agent'):?>
			<li class="active" id="findyouragent"><span class="badge">4</span>Agent<span class="chevron"></span></li>
			<li><span class="badge">5</span>Meet Agent<span class="chevron"></span></li>
			<li><span class="badge">6</span>Confirmation</li>
			<?php else:?>
			<li><span class="badge">4</span>Meet Agent<span class="chevron"></span></li>
			<li><span class="badge">5</span>Confirmation</li>
			<?php endif;?>
		</ul>
	</div>



<div class="cna_fieldset_div" id="findagent">
<legend class="fieldset_label">Find an Agent</legend>
<fieldset class="cna_fieldsets">

  <div id="locator">
						<div class="maindiv" id="main">
							<div class="sidebardiv" id="sidebar" style="visibility: visible;">
								<div id="closeSidebarDiv">
									<!-- input type="image" name="closeSidebar" id="closeSidebar" src="../img/bigx.png" -->
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
										<div id="agentlist"></div>
									</div>
								</div>
							</div>
							<div class="mapdiv" id="map_canvas" style="position: relative; height:500px; background-color: rgb(229, 227, 223); overflow: hidden;">
							<div id="legend">
								<div class="icondiv">
						        	<img src="../img/location_bubble.png" class="legendicon">
						        	<h2> &nbsp;&nbsp;- Agent</h2>
						        </div>
								<div class="icondiv">
						        	<img src="../img/marker-cluster.png" id="clustererImg" class="legendicon">
						        	<h2> &nbsp;&nbsp;- Multiple Agents</h2>
						        </div>
							</div>
						</div>
					</div>
</div>
</fieldset>
</div>
<?php
echo $this -> Form -> create('Prospect', array('action' => $action,'id'=>'tell-us'));

echo $this -> Form -> input(
		'agent', array(
				'id'=>'agent',
				'type' => 'text',
				'value' => isset($Prospect['Prospect']['agent'])?$Prospect['Prospect']['agent']:''

		));
echo $this -> Form -> input(
		'id', array(
				'type' => 'hidden',
				'value' => $uid?$uid:''
		));
echo $this -> Form -> input(
		'url', array(
				'type' => 'text',
				'value' => 'meetyouragent'
		));
?>



		<div class="submit form-group col-xs-12 col-sm-12 col-md-12 control-group">
		<input id="" type="button" value="Previous" class="btn btn-primary back_button">
		<input type="submit" value="Next" class="btn btn-primary">
		</div>

</div>


