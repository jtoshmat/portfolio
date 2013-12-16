<div class="page_title"><h2>Find An Agent</h2></div>
<div class="form-container">
<script type="text/javascript">
initialize();
var zw_counter=0;
$("#zipcodebtn").live('click', function(e){

    var zipcode = parseInt($("#zipcode").val());
    if ($("#zipcode").val().length<5){QRF.warning("Zip code must be 5 number long"); return false;}
    if (!QRF.is_numeric(zipcode)){QRF.warning("Zip code must be only numbers");return false;}




 /*
    $("#accordion").empty();

    var html;
    html  = '<div class="zip_warning">';
    html +=     '<p>Please Wait<br /> while search is being performed</p>';
    html += '</div>';

    if (zw_counter==0){
        $(html).insertAfter('#accordion');
    }
    zw_counter++;
    */
    QRF.search_agent();
});
</script>
<?php
$zipcode = (isset($_GET['zipcode']))?filter_var($_GET['zipcode'], FILTER_SANITIZE_NUMBER_INT):'';
?>

                        <div id="locator">
						<div class="maindiv" id="main">
							<div class="sidebardiv" id="sidebar" style="visibility: visible;">
								<div id="closeSidebarDiv">
									<!-- input type="image" name="closeSidebar" id="closeSidebar" src="img/bigx.png" -->
								</div>
								<div class="searchdiv" id="searchWindow">
									<h2>Find An Agent</h2>
					                <h4> Enter ZIP Code</h4>
					                <div id="searchSubdiv">
					                    <input type="tel" maxlength="5" size="15" class="zipcode" name="zipcode" id="zipcode" value="<?php echo $zipcode;?>">
					                    <input type="button" name="zipcodebtn" id="zipcodebtn" class="gobutton" value="GO" >
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
										<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
										<div class="viewport">
							 				<div class="overview">
							 					<div id="agentlist"></div>
							 				</div>
										</div>
									</div>
								</div>
							</div>
							<div class="mobilesidebar" id="mobilesidebar">
								<div class="searchdiv" id="searchWindow">
									<h2>Find An Agent</h2>
					                <h4> Enter ZipCode</h4>
					                <div id="searchSubdiv">
					                    <input type="tel" maxlength="5" size="15" class="zipcode" name="zipcode" id="mobilezipcode">
					                    <input type="button" class="gobutton" id="zipcodebtn" name="zipcodebtn" value="GO">
					                </div>
								</div>
							</div>
							<div class="mapdiv" id="map_canvas" style="position: relative; background-color: rgb(229, 227, 223); overflow: hidden;">
							<div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;">
							<div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;">
							<div style="position: absolute; left: 0px; top: 0px; z-index: 1; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default;">
							<div style="position: absolute; left: 0px; top: 0px; z-index: 200;">
							<div style="position: absolute; left: 0px; top: 0px; z-index: 101;"></div></div>
							<div style="position: absolute; left: 0px; top: 0px; z-index: 201;">
							<div style="position: absolute; left: 0px; top: 0px; z-index: 102;"></div>
							<div style="position: absolute; left: 0px; top: 0px; z-index: 103;"></div>
							</div><div style="position: absolute; left: 0px; top: 0px; z-index: 202;">
							<div style="position: absolute; left: 0px; top: 0px; z-index: 104;"></div>
							<div style="position: absolute; left: 0px; top: 0px; z-index: 105;"></div>
							<div style="position: absolute; left: 0px; top: 0px; z-index: 106;"></div></div>
							<div style="position: absolute; left: 0px; top: 0px; z-index: 100;">
							<div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
							<div style="position: absolute; left: 0px; top: 0px; z-index: 1;">
							<div style="width: 256px; height: 256px; position: absolute; left: 39px; top: 191px;"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: -217px; top: 191px;"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: 39px; top: -65px;"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: 39px; top: 447px;"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: 295px; top: 191px;"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: -217px; top: -65px;"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: -217px; top: 447px;"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: 295px; top: -65px;"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: 295px; top: 447px;"></div></div></div></div>
							<div style="position: absolute; z-index: 0; left: 0px; top: 0px;"><div style="overflow: hidden;"></div></div>
							<div style="position: absolute; left: 0px; top: 0px; z-index: 0;"><div style="position: absolute; left: 0px; top: 0px; z-index: 1;">
							<div style="width: 256px; height: 256px; position: absolute; left: 39px; top: -65px; opacity: 1; transition: opacity 200ms ease-out 0s;">
							<img style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://mts1.googleapis.com/vt?lyrs=m@212000000&amp;src=apiv3&amp;hl=en-US&amp;x=3&amp;y=5&amp;z=4&amp;s=Galile&amp;apistyle=s.t%3A2%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=api%7Csmartmaps" draggable="false"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: 295px; top: 447px; opacity: 1; transition: opacity 200ms ease-out 0s;">
							<img style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://mts0.googleapis.com/vt?lyrs=m@212000000&amp;src=apiv3&amp;hl=en-US&amp;x=4&amp;y=7&amp;z=4&amp;s=Gal&amp;apistyle=s.t%3A2%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=api%7Csmartmaps" draggable="false"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: 39px; top: 447px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://mts1.googleapis.com/vt?lyrs=m@212000000&amp;src=apiv3&amp;hl=en-US&amp;x=3&amp;y=7&amp;z=4&amp;s=&amp;apistyle=s.t%3A2%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=api%7Csmartmaps" draggable="false"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: 39px; top: 191px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://mts1.googleapis.com/vt?lyrs=m@212000000&amp;src=apiv3&amp;hl=en-US&amp;x=3&amp;y=6&amp;z=4&amp;s=Galileo&amp;apistyle=s.t%3A2%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=api%7Csmartmaps" draggable="false"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: 295px; top: -65px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://mts0.googleapis.com/vt?lyrs=m@212000000&amp;src=apiv3&amp;hl=en-US&amp;x=4&amp;y=5&amp;z=4&amp;s=G&amp;apistyle=s.t%3A2%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=api%7Csmartmaps" draggable="false"></div><div style="width: 256px; height: 256px; position: absolute; left: -217px; top: 191px;">
							<img style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://mts0.googleapis.com/vt?lyrs=m@212000000&amp;src=apiv3&amp;hl=en-US&amp;x=2&amp;y=6&amp;z=4&amp;s=Gali&amp;apistyle=s.t%3A2%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=api%7Csmartmaps" draggable="false"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: -217px; top: -65px;"><img style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://mts0.googleapis.com/vt?lyrs=m@212000000&amp;src=apiv3&amp;hl=en-US&amp;x=2&amp;y=5&amp;z=4&amp;s=Gal&amp;apistyle=s.t%3A2%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=api%7Csmartmaps" draggable="false"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: -217px; top: 447px;"><img style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://mts0.googleapis.com/vt?lyrs=m@212000000&amp;src=apiv3&amp;hl=en-US&amp;x=2&amp;y=7&amp;z=4&amp;s=Galil&amp;apistyle=s.t%3A2%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=api%7Csmartmaps" draggable="false"></div>
							<div style="width: 256px; height: 256px; position: absolute; left: 295px; top: 191px; opacity: 1; transition: opacity 200ms ease-out 0s;"><img style="width: 256px; height: 256px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://mts0.googleapis.com/vt?lyrs=m@212000000&amp;src=apiv3&amp;hl=en-US&amp;x=4&amp;y=6&amp;z=4&amp;s=Ga&amp;apistyle=s.t%3A2%7Cs.e%3Al%7Cp.v%3Aoff&amp;style=api%7Csmartmaps" draggable="false"></div></div></div></div></div>

							<div style="margin: 2px 5px 2px 2px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;">
							<a style="position: static; overflow: visible; float: none; display: inline;" target="_blank" href="http://maps.google.com/maps?ll=38.476,-96.416&amp;z=4&amp;t=m&amp;hl=en-US" title="Click to see this area on Google Maps"><div style="width: 62px; height: 24px; cursor: pointer;">

							<img style="position: absolute; left: 0px; top: 0px; width: 62px; height: 24px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://maps.gstatic.com/mapfiles/google_white.png" draggable="false"></div></a></div>
							<div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 95px; bottom: 0px;">

							<div style="height: 19px; -moz-user-select: none; line-height: 19px; padding-right: 2px; padding-left: 50px; background: -moz-linear-gradient(left center , rgba(255, 255, 255, 0) 0px, rgba(255, 255, 255, 0.5) 50px) repeat scroll 0% 0% transparent; font-family: Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right;"><a style="color: rgb(68, 68, 68); text-decoration: underline; cursor: pointer; display: none;">Map Data</a>
							<span style="">Map data &copy;2013 Google, INEGI, MapLink</span>
							<span style=""> - </span><a style="color: rgb(68, 68, 68); text-decoration: underline; cursor: pointer;" href="http://www.google.com/intl/en-US_US/help/terms_maps.html" target="_blank">Terms of Use</a></div></div><div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Arial,sans-serif; color: rgb(34, 34, 34); box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.2); z-index: 10000002; display: none; width: 256px; height: 148px; position: absolute; left: 73px; top: 138px;"><div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div>
							<div style="font-size: 13px;">Map data &copy;2013 Google, INEGI, MapLink</div>
							<div style="width: 10px; height: 10px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img style="position: absolute; left: -18px; top: -44px; width: 68px; height: 67px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px;" src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false"></div></div>
							<div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;"><div style="font-family: Arial,sans-serif; font-size: 10px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);">Map data &copy;2013 Google, INEGI, MapLink</div></div>
							<div style="position: absolute; padding-top: 25px; padding-bottom: 25px; z-index: 0; top: 0px; left: 0px;">
							<div style="height: 78px; cursor: pointer;" title="Click to view agent locator side bar">
							<input width="33" type="image" height="78" style="display:none" src="img/view-list.png" id="viewlist"></div></div>
							<div class="gmnoprint" style="font-size: 10px; height: 17px; background-color: rgb(245, 245, 245); border: 1px solid rgb(220, 220, 220); line-height: 19px; position: absolute; right: 0px; bottom: 0px;">
							<a id="findyouragent_google_map"   target="_new" title="Report errors in the road map or imagery to Google" style="font-family: Arial,sans-serif; font-size: 85%; font-weight: bold; padding: 1px 3px; color: rgb(68, 68, 68); text-decoration: none; position: relative; bottom: 1px;" href="http://maps.google.com/maps?ll=38.476,-96.416&amp;z=4&amp;t=m&amp;hl=en-US&amp;skstate=action:mps_dialog$apiref:1">Report a map error</a></div>
							<div class="gmnoprint" style="margin: 5px; -moz-user-select: none; position: absolute; top: 128px; left: 0px;" controlwidth="25" controlheight="226">
							<div class="gmnoprint" style="position: absolute; left: 0px; top: 0px;" controlwidth="25" controlheight="226">
							<div style="width: 23px; height: 24px; overflow: hidden; position: relative; cursor: pointer; z-index: 1;" title="Zoom in">
							<img style="position: absolute; left: -17px; top: -400px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 59px; height: 492px;" src="https://maps.gstatic.com/mapfiles/mapcontrols3d7.png" draggable="false"></div>
							<div style="width: 25px; height: 178px; overflow: hidden; position: relative; cursor: pointer; top: -4px;" title="Click to zoom">
							<img style="position: absolute; left: -17px; top: -87px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 59px; height: 492px;" src="https://maps.gstatic.com/mapfiles/mapcontrols3d7.png" draggable="false"></div>
							<div style="width: 21px; height: 14px; overflow: hidden; position: absolute; transition: top 0.25s ease 0s; z-index: 2; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; left: 2px; top: 156px;" title="Drag to zoom">
							<img style="position: absolute; left: 0px; top: -384px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 59px; height: 492px;" src="https://maps.gstatic.com/mapfiles/mapcontrols3d7.png" draggable="false"></div>
							<div style="width: 23px; height: 23px; overflow: hidden; position: relative; cursor: pointer; top: -4px; z-index: 3;" title="Zoom out">
							<img style="position: absolute; left: -17px; top: -361px; -moz-user-select: none; border: 0px none; padding: 0px; margin: 0px; width: 59px; height: 492px;" src="https://maps.gstatic.com/mapfiles/mapcontrols3d7.png" draggable="false"></div></div></div></div></div>
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
					 <div class="warning"></div>
					<nav class="paging-buttons">
					<a class="previous " href="#"> < Previous</a>
					<a class="next" href="#">Next > </a>
					</nav>
		</div>