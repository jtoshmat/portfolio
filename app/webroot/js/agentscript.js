
var map;
var markerCluster;
var places = [];
var markers = [];
var markersListeners = [];
var agentList = [];
var numOfAgents = 0;
var markerlabels = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

var bounds = new google.maps.LatLngBounds();
var geocoder = new google.maps.Geocoder;
var msielt7;

/**
 * The HomeControl adds a control to the map that simply
 * returns the user to Chicago. This constructor takes
 * the control DIV as an argument.
 */
function HomeControl(controlDiv, map) {

  // Set CSS for the control border
  var controlUI = document.createElement('div');
  //controlUI.id = "viewlist";
  controlUI.innerHTML = '<input type="image" id="viewlist" src="../img/view-list.png" style="display:none" width="33" height="78" >';

  controlDiv.style.position = "absolute";
  controlDiv.style.paddingTop = "25px";
  controlDiv.style.paddingBottom = "25px";

  controlUI.style.height = "78px";
  controlUI.style.cursor = 'pointer';
  controlUI.title = 'Click to view agent locator side bar';

  controlDiv.appendChild(controlUI);

  // Setup the click event listeners:
  google.maps.event.addDomListener(controlUI, 'click', function() {
    if(document.getElementById("sidebar").style.visibility == "block"){
    	document.getElementById("sidebar").style.width = "0px";
    	document.getElementById("sidebar").style.marginLeft = "-10px";
    	document.getElementById("map_canvas").style.width = "auto";
    	document.getElementById("map_canvas").style.borderRadius = "16px";
    	document.getElementById("map_canvas").style.MozBorderRadius = "16px";
        $('#sidebar').hide();
        $('#viewlist').show();

    } else{
    	document.getElementById("sidebar").style.width = "270px";
    	document.getElementById("sidebar").style.marginLeft = "0px";
    	document.getElementById("map_canvas").style.width = "auto";
    	document.getElementById("map_canvas").style.borderRadius = "2px 16px 16px 2px";
    	document.getElementById("map_canvas").style.MozBorderRadius = "2px 16px 16px 2px";
        $('#sidebar').show();
        $('#viewlist').hide();
    }
  });

}

function initialize() {
	if ( msieversion() == 6 || msieversion() == 7) msielt7 = true;
	else msielt7 = false;

    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(38.476,-96.416);
    var myOptions = {
      zoom: 4,
      center:latlng,
      rotateControl: false,
      mapTypeControl:false,
      panControl:false,
      streetViewControl : false,
      zoomControl: true,
      zoomControlOptions: {
        position: google.maps.ControlPosition.LEFT_TOP
      },
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      styles:[{
    	  featureType:"poi",
    	  elementType:"labels",
    	  stylers:[{
    		  visibility:"off"
    	  }]
      }]
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    document.getElementById("map_canvas").style.position = "relative";
    document.getElementById("sidebar").style.visibility = "visible";

    var homeControlDiv = document.createElement('div');
 	var homeControl = new HomeControl(homeControlDiv, map);
 	homeControlDiv.index = -1;
 	map.controls[google.maps.ControlPosition.LEFT_TOP].push(homeControlDiv);

 	var zip = function () {
	  var query_string = '';
	  var query = window.location.search.substring(1);
	  var vars = query.split("&");
	  for (var i=0;i<vars.length;i++) {
	    var pair = vars[i].split("=");
	    if (pair[0] === "zip") {
	      query_string = pair[1];
	    }
	  }
	    return query_string;
	} ();

	var intRegex = /^\s*\d+\s*$/;

	if(zip!=null && zip!='' && zip.length==5 && String(zip).search(intRegex) != -1) {
		document.getElementById("zipcode").value = zip;
		//document.getElementById("mobilezipcode").value = zip;
		google.maps.event.addListenerOnce(map, 'idle', function(){
		    submitform(zip);
		});
	}
   }

$(document).ready(function(){
    $('#zipcodebtn').click(function(e){
        e.preventDefault();
        var zip = document.getElementById("zipcode").value;
        //document.getElementById("mobilezipcode").value = zip;
        submitform(zip);
        document.getElementById("zipcodebtn").disabled=true;
    });
    $("#zipcode").keydown(function(e){
    	if(e.keyCode == 13){
    		$("#zipcodebtn").click();
    	}
    });
    $("#closeSidebar").click(function(e){
    	 document.getElementById("sidebar").style.display = "none";
    	return false;
        e.preventDefault();
//        $('#sidebar').attr('style', 'width:0px; margin-left:-10px;');
//        $('#map_canvas').attr('style', 'width:763px;');
        document.getElementById("sidebar").style.width = "0px";
    	document.getElementById("sidebar").style.marginLeft = "-10px";
    	document.getElementById("map_canvas").style.width = "auto";
    	document.getElementById("map_canvas").style.borderRadius = "16px";
    	document.getElementById("map_canvas").style.MozBorderRadius = "16px";
        $('#sidebar').hide();
        $('#viewlist').show();
    });


});

function switchAgentView(value) {
	if(value == 'map') {
		$("#mapView").removeClass("selected");
    	$("#listView").addClass("selected");

		$("#results").removeClass("selected");
		$("#map_canvas").addClass("selected");
		$("#legend").addClass("selected");
		map.fitBounds(bounds);
	} else if(value == 'list') {
		$("#listView").removeClass("selected");
    	$("#mapView").addClass("selected");

		$("#map_canvas").removeClass("selected");
		$("#legend").removeClass("selected");
		$("#results").addClass("selected");
	}
}

var infoBox;
var image;
var shadow;
var shape;
var geoCodeError;

function loadAgents(xml) {

	var agent;
	var address;
	var addressArr;
	var phone;
	var phonetype;
	var locIndex = 0;

	geoCodeError = false;
	agentList = [];
	markers = [];
	markersListeners = [];
	places = [];
	bounds = new google.maps.LatLngBounds();

	numOfAgents = $('agent',xml).length;


	$('agent',xml).each(function(i) {
		if(geoCodeError) {return false;}

		agent = {};
		addressArr = [];
		phone = "";
		address = "";

		agent.name = $(this).find("name").text();
        agent.email = $(this).find("email").text();
        agent.website = $(this).find("agentInternetAddress").text();
        agent.pictureUrl = $(this).find("pictureUrl").text();
        agent.agentId = $(this).find("agentId").text();
        agent.globalNickname = $(this).find("globalNickname").text();

		$(this).find("address").children().each(function(n) {
				address = address + " "+ $(this).text();
				addressArr.push($(this).text());
		});
		agent.address = addressArr;

		$(this).find("phone").each(function(n) {
			var arr = [];
			$(this).children().each(function() {
				arr.push($(this).text());
			});
			if(arr.length == 2) {if(arr[1] == "OFFICE") phone=arr[0];}
		});
        agent.phone = phone;
        agentList.push(agent);

		geocode(address, locIndex);

		timeout(250);
        locIndex++;
	});
}

function geocode(address, locIndex) {
	geocoder.geocode({ 'address': address }, function(results, status) {

        if (status == google.maps.GeocoderStatus.OK) {
            places[locIndex] = results[0].geometry.location;
			if(places.length == numOfAgents) {
				var count = 0;
				for(var i=0; i<places.length; i++){
					if(places[i] != null && places[i] != "") count++;
				}
				if(count == numOfAgents) loadMarkers();
			}

        } else {
        	geoCodeError = true;
			unlockPage();
        	timeout(250);
            showErrorMessage();
            return false;
        }
    });
}

function loadMarkers() {

	var sortedPlaces = [], sortedPlaces2 = [];
	for (var i=0; i<places.length; i++) {
		sortedPlaces[i]=0;
		sortedPlaces2[i]=0;
	}

	outerloop:
	for (var i=0; i<places.length; i++) {
		for (var j=0; j<i; j++) {
			if( places[j].lat() == places[i].lat() &&
		     	places[j].lng() == places[i].lng()) {
				sortedPlaces[j]++;
				continue outerloop;
			}
		}
		sortedPlaces[i]++;
	}

	var latlng;
	var duplicatePosition;
	for (var locIndex=0; locIndex<places.length; locIndex++) {
		duplicatePosition = 0;
		latlng = places[locIndex];
		if(sortedPlaces[locIndex] == 0) {
			for (var k=0; k<sortedPlaces.length; k++) {
				if(sortedPlaces[k] > 0) {
					if(places[k].lat() == latlng.lat() &&
							places[k].lng() == latlng.lng()) {
						sortedPlaces[k]--;
						sortedPlaces2[k]++;
						duplicatePosition = sortedPlaces2[k];
						break;
					}
				}
			}
		}
		else {
			sortedPlaces[locIndex]--;
		}

    	image = new google.maps.MarkerImage(
		  duplicatePosition>0 ? '../img/location_bubble2.png':'../img/location_bubble.png',
		  new google.maps.Size(19,28),
		  new google.maps.Point(0,0),
		  new google.maps.Point((10-(duplicatePosition*16)),28)
		);

		shadow = new google.maps.MarkerImage(
		  '../img/shadow.png',
		  new google.maps.Size(37,28),
		  new google.maps.Point(0,0),
		  new google.maps.Point(10,28)
		);

		shape = {
		  coord: [18,0,18,1,18,2,18,3,18,4,18,5,18,6,18,7,18,8,18,9,18,10,18,11,18,12,18,
			  13,18,14,18,15,18,16,18,17,18,18,16,19,11,20,11,21,11,22,11,23,11,24,11,25,
			  11,26,11,27,11,27,10,26,9,25,8,24,7,23,6,22,5,21,4,20,2,19,0,18,0,17,0,16,
			  0,15,0,14,0,13,0,12,0,11,0,10,0,9,0,8,0,7,0,6,0,5,0,4,0,3,0,2,0,1,0,0,18,0],
		  type: 'poly'
		};

	    var marker = new MarkerWithLabel({
	    	   position: places[locIndex],
	    	   map: map,
			   draggable: false,
			   raiseOnDrag: false,
			   icon: image,
			   shadow: shadow,
			   shape: shape,
		       labelContent: markerlabels[locIndex],
		       labelAnchor: new google.maps.Point((6-(duplicatePosition*16)), 23),
		       labelClass: "labels", // the CSS class for the label
		       labelInBackground: false
		});

	    updateMarkersWithAgents(marker, locIndex, (duplicatePosition>0 ? (-60+(duplicatePosition*16)) : null));


	    // Extending the bounds object with each LatLng
	    bounds.extend(places[locIndex]);

	    // Adjusting the map to new bounding box
	    map.fitBounds(bounds);

	    markers[locIndex]=marker;
	}

	var mcOptions = { maxZoom: 16};
	markerCluster = new MarkerClusterer(map, markers, mcOptions);
	buildSidebarAgents(agentList);

}

function timeout(milliseconds)
{
    var initialDate = new Date();
    var currentDate = new Date();
    while ((currentDate-initialDate)<milliseconds)
    {
        currentDate = new Date();
    }
}

function updateMarkersWithAgents(marker, locIndex, offsetx) {
	markersListeners[agentList[locIndex].agentId] = google.maps.event.addListener(marker, "click", function(e) {
    	if (infoBox) infoBox.remove();
    	var index;
    	for (var j in markers) {
	        if (markers[j].getPosition() == marker.getPosition()) {index = j; break;}
	    }
    	infoBox = new InfoBox({latlng: marker.getPosition(), map: map, popupContent: agentList[index], offsetx: offsetx});
    	//added a new class to highlight the agent when an icon is clicked on the map - Jon Toshmatov 5/22/2013
    	$("#agentlist .sidebarAgentDiv").removeClass("sidebarAgentDivFocus");
    	$("#agentlist .sidebarAgentDiv").eq(index).addClass("sidebarAgentDivFocus");
    });


}

function focusMarker(i) {
	google.maps.event.trigger(markers[i], 'click');
	mytest(i);
}

google.maps.Map.prototype.clearMarkers = function() {
    for(var i=0; i<markers.length; i++){
        markers[i].setMap(null);
    }
    markers = new Array();
};

function buildSidebarAgents(agents) {
	$("#agentlist").empty();

	var i=0;
    $(agents).each( function () {
        var agent = $(this);
        var name = agent[0]['name'];
        var email = buildAgentEmailURL(agent);
        var website = agent[0]['website'];
        var phone = agent[0]['phone'];
        var address = agent[0]['address'];

        var html;

        html  = '<div class="sidebarAgentDiv">';
        html += 	'<h3>';
        html += 			'<div class="agentTopDiv" onclick="focusMarker('+i+');return false;">';
        html += 				'<div class="sidebarMarker" >';
        html += 					'<input type="button" class="marker" value="'+ markerlabels[i] +'"/>';
        html += 				'</div>';
        html += 				'<div class="sidebarAgentName">';
        html += 					'<p>'+name+'</p>';
        html += 				'</div>';
        html += 				'<div class="sideBarPhoneIcon">';
        html += 					'<img src="../img/phone.png"></img>';
        html += 				'</div>';
        html += 				'<div class="sideBarPhoneDiv">';
        html += 					'<a class=\'agentphone\' href=\'tel:'+phone+'\'>'+phone+'</a>';
        html += 				'</div>';
        html += 				'<div class="sidebarAddress" >';
        html += 					'<p>'+address[0]+'</p>'+'<p>'+address[1]+' '+address[2]+' '+address[3]+'</p>';
        html += 				'</div>';
        html += 			'</div>';
        html += 	'</h3>';
		/*
        html += 	'<div class="agentBottomDiv" >';
        html += 		'<div class="sidebarAddress" >';
        html += 			'<p>'+address[0]+'</p>'+'<p>'+address[1]+' '+address[2]+' '+address[3]+'</p>';
        html += 		'</div>';
        html += 		'<div class="sidebarContact" >';
        //html += 			'<span class=\"agentemail\">'+getAgentEmail(agent)+'</span>';
        //html += 			'<a href="'+ email +'" target="_blank" style="padding-top:2px;">Email</a>'; //Jon Toshmatov updated the email and website 8/13/2013
        //html += 			website;
        html += 			'';
        html += 			'';
        html += 		'</div>';
        html += 	'</div>'; */
        html += '</div>';

        //Append it to user predefined element
		$(html).appendTo('#agentlist');
        //$(html).appendTo('#accordion').accordion('destroy').accordion({ header: "h3", active:false, autoHeight:false, clearStyle:true, fillSpace:true, collapsible:true });
        i++;
    });
	/*$("#accordion").accordion({ header: "h3", active:false, autoHeight:false, clearStyle:true, fillSpace:true });
	$( "#accordion" ).accordion( "option", "collapsible", true );
	$( "#accordion" ).accordion( "option", "clearStyle", true );
	$( "#accordion" ).accordion( "option", "active", false );
	$( "#accordion" ).accordion( "option", "autoHeight", false );*/
	//$('#scrollbar1').tinyscrollbar();

	/*$( "#accordion" ).bind("accordionchange", function(event, ui) {
  		$('#scrollbar1').tinyscrollbar_update();
	});*/
	unlockPage();
	if(isMobile()) switchAgentView('list');
	//updateOmniture();

}

function buildAgentEmailURL(agent) {
	return 'https://apps.amfam.com/agentlocator/getEmailForm.do?email=' + agent[0]['globalNickname'] +
		'&state=WI&agtid='+agent[0]['agentId'] + '&userid=Amfam';
}

function getAgentEmail(agent) {
	return agent[0]['globalNickname'];
}

$().ajaxStart(function(){
	$('body').css('cursor', 'wait');
});

$().ajaxStop(function(){
	$('body').css('cursor', 'auto');
});
$.ajaxSetup({
	timeout : 50000
});//set by Jon Toshmatov 4/30

var from_qrf = "", zw_counter2=0;
function submitform(zip, from) {

	from_qrf = from;
	var intRegex = /^\s*\d+\s*$/;
	$("#agentlist").empty();
	if (infoBox) infoBox.remove();
	map.clearMarkers();
	if(markerCluster != null) markerCluster.clearMarkers();


	if(zip!='') {


		//QRF.warning("Searching agent started");
		$("#zipcodebtn").attr('disabled','disabled');
		$("#zipcodebtn").fadeOut("slow");

	    $("#agentlist").empty();

	    var html;
	    html  = '<div class="zip_warning">';
	    html +=     '<p>Please Wait<br /> while search is being performed</p>';
	    html += '</div>';

	    if (zw_counter2==0){
	        $(html).insertAfter('#agentlist');
	    }else{
	    	$(".zip_warning").fadeIn("slow");
	    }
	    zw_counter2++;




		if (from_qrf!='tell-us' || from_qrf!='meetyouragent'){

		 //
		}else{
			lockPage();
		}


		var params = "deviceId=agtloc&version=v1&locateMethod=radius&" +
						"radius=5&results=5&searchType=locateByZip&zip="+zip;
		$.ajax({
				type:"POST",
				cache:false,
				url: "../Prospects/process",
				dataType: "html",
				data: params,
				async: true,
				processData: false,
				success: function(xmldata){
					var hasError = false;
					var ver = navigator.appVersion;
					if (ver.indexOf("MSIE") != -1)
					{
						var xmldoc = new ActiveXObject("Microsoft.XMLDOM");
						xmldoc.async = "false";
						if(!isNaN(xmldata.charAt(xmldata.length-1))) xmldata = xmldata.substring(0, xmldata.length-1);
						//QRFE-206 fix 12/4/2013 10:25 AM
						var tempXmldata = xmldata.toLowerCase(); xmldoc.loadXML(tempXmldata );
						xmldata = tempXmldata;
						//xmldoc.loadXML(xmldata);
						var errors = xmldoc.getElementsByTagName("error");
						if(errors.length > 0) hasError = true;
					}
					else {
						if($(xmldata).find("error").text() != "") hasError = true;
					}





					if(hasError) {




						unlockPage();
						$("#agentlist").empty();
//						$('#scrollbar1').tinyscrollbar_update();

						var html;
						html  = '<div class="noResultsDiv">';
				        html += 	'<p>Your Zip Code appears to be outside of our operating states. To view which states we operate in please view the <a href="http://www.amfam.com/about-us/where-we-are/default.asp" target="_blank">Where We Are<a/> page.</p>';
				        html += '</div>';
				        $(html).appendTo('#agentlist');
					}
					else{
						loadAgents(xmldata);

						//enable the find zip button
						 $("#zipcodebtn").removeAttr('disabled');
						 $(".zip_warning").fadeOut("fast");
					}
					//QRF.warning("Searching completed");
					$("#zipcodebtn").removeAttr('disabled');
					$("#zipcodebtn").fadeIn("slow");
				},
				error: function(req, status, msg) {
					unlockPage();
					alert("Status:"+status +"\n Message:"+ msg);
					//QRF.warning("Status:"+status +"\n Message:"+ msg);

					 if(status == "timeout" || status == "error") {
						showErrorMessage();
					 }
				}


		});


	}
	else {
		if(zip!=null && zip!='') {
			var html;
			html  = '<div class="noResultsDiv">';
	        html += 	'<p>Please enter a valid Zip Code.</p>';
	        html += '</div>';
	        $(html).appendTo('#agentlist');
        }
	}







}
function submitformByName(firstName,lastName,state) {
	var isvalid = true;

	if(isvalid) {
		$("#agentlist").empty();
		map.clearMarkers();
		if(markerCluster != null) markerCluster.clearMarkers();
		lockPage();

		var params = "deviceId=agtloc&version=v1&" +
						"results=5&searchType=locateByName&firstName="+firstName+"&lastName="+lastName+"state="+state;
		$.ajax({
				type:"POST",
				cache:false,
				url: "Prospects/processbyname",
				dataType: "html",
				data: params,
				async: true,
				processData: false,
				success: function(xmldata){
					var hasError = false;
					var ver = navigator.appVersion;
					if (ver.indexOf("MSIE") != -1)
					{
						var xmldoc = new ActiveXObject("Microsoft.XMLDOM");
						xmldoc.async = "false";
						if(!isNaN(xmldata.charAt(xmldata.length-1))) xmldata = xmldata.substring(0, xmldata.length-1);
						//QRFE-206 fix 12/4/2013 10:25 AM
						var tempXmldata = xmldata.toLowerCase(); xmldoc.loadXML(tempXmldata );
						xmldata = tempXmldata;
						//xmldoc.loadXML(xmldata);
						var errors = xmldoc.getElementsByTagName("error");
						if(errors.length > 0) hasError = true;
					}
					else {
						if($(xmldata).find("error").text() != "") hasError = true;
					}


					if(hasError) {
						unlockPage();
						$("#agentlist").empty();
//						$('#scrollbar1').tinyscrollbar_update();

						var html;
						html  = '<div class="noResultsDiv">';
				        html += 	'<p>No matches found.</p>';
				        html += '</div>';
				        $(html).appendTo('#agentlist');
					}
					else{
						loadAgents(xmldata);
					}
				},
				error: function(req, status, msg) {
					unlockPage();
					 if(status == "timeout" || status == "error") {
						showErrorMessage();
					 }
				}
		});

	}
	else {
		if(zip!=null && zip!='') {
			$("#agentlist").empty();

			var html;
			html  = '<div class="noResultsDiv">';
	        html += 	'<p>Please enter a valid name.</p>';
	        html += '</div>';
	        $(html).appendTo('#agentlist');
        }
	}
}

function lockPage() {

    var blurForm = document.createElement('div');
	blurForm.id='blur';
	blurForm.innerHTML ="&nbsp;";
	blurForm.style.height = document.getElementById('content').offsetHeight+'px';

    var progressForm = document.createElement('div');
	progressForm.id='progress';
	progressForm.innerHTML ="<p>Please wait ...<p>";
	var popW = progressForm.style.offsetWidth;
	var popH = progressForm.style.height;
	var x,y;
	if (self.innerHeight) // all except Explorer
	{
		x = self.innerWidth;
		y = self.innerHeight;
	}
	else if (document.documentElement && document.documentElement.clientHeight) // Explorer 6 Strict Mode
	{
		x = document.documentElement.clientWidth;
		y = document.documentElement.clientHeight;
	}
	else if (document.body) // other Explorers
	{
		x = document.body.clientWidth;
		y = document.body.clientHeight;
	}
	if (typeof(window.pageYOffset) == 'number') {
		progressForm.style.cssText = "top: "+(window.pageYOffset + (y/2))+"px; left: " +(window.pageXOffset + (x/2-80))+"px";
	}
	else {
		progressForm.style.cssText = "top: "+(document.documentElement.scrollTop + (y/2))+"px; left: " +(document.documentElement.scrollLeft + (x/2-80))+"px";
	}

    document.body.appendChild(blurForm);
    document.body.appendChild(progressForm);
}

function unlockPage() {
	if (from_qrf!='tell-us' || from_qrf!='meetyouragent'){

	}else{
		document.body.removeChild(document.getElementById('blur'));
		document.body.removeChild(document.getElementById('progress'));
	}
}

function showErrorMessage() {
	$("#zipcodebtn").fadeIn("slow");
	map.clearMarkers();
	if(markerCluster != null) markerCluster.clearMarkers();
	$("#agentlist").empty();

	var html;
	html  = '<div class="noResultsDiv">';
    html += 	'<p>Please try again.</p>';
    html += '</div>';
    $(html).appendTo('#agentlist');
}

function updateOmniture(){
	return false;// Jon Toshmatov, prevent a conflict with main omniture
	/*var path = location.pathname;
	var deconcept;
	if (deconcept == undefined) {
		var playerVersion = "";
		var UserFlashVersion = "no flash on page";
	} else {
		var playerVersion = deconcept.SWFObjectUtil.getPlayerVersion();
		var UserFlashVersion = playerVersion.major + "." + playerVersion.minor
				+ "." + playerVersion.rev;
	}<!--
	 You may give each page an identifying name, server, and channel on
	the next lines.

	var omnTitle=omnTitle
	if (omnTitle=="") {
	omnTitle=document.title
	}
	if (typeof omnTitle=="undefined"){
	omnTitle=document.title
	}

	s.pageName=omnTitle
	s.channel =""
	s.server=""
	s.pageType=""
	s.prop1=""
	s.prop2=""
	s.prop3=""
	s.prop4=""
	s.prop5=""
	s.prop7=""
	s.pro8 =""
	s.prop9="english"
	s.prop10=omnTitle
	s.prop16=UserFlashVersion
	 E-commerce Variables
	s.campaign=""
	s.eVar27=""
	s.eVar13 = ""
	s.eVar16 = ""
	s.eVar17 = ""
	s.events =""
	s.products=""
	s.prop8 = (path.indexOf("businessinsuranceagents") != -1) ?
					"Commercial Agent Locator Paid Search" : "Agent Locator Paid Search";
	s.channel="Find an Agent"
	s.events ="event12"
	s.products =""*/

	/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
	//var s_code=s.t();//--></script>

}

function msieversion()
{
  var ua = window.navigator.userAgent;
  var msie = ua.indexOf ( "MSIE" );

  if ( msie > 0 )      // If Internet Explorer, return version number
	 return parseInt (ua.substring (msie+5, ua.indexOf (".", msie )));
  else                 // If another browser, return 0
	 return 0;
}

function isMobile(){
	var useragent = navigator.userAgent;
	var isiPhone = !!useragent.match(/iPhone/i);
	var isiPod = !!useragent.match(/iPod/i);
	var isAndroid = !!useragent.match(/Android/i);
	var isKindle = !!useragent.match(/Silk/i);
	var isWindows = !!useragent.match(/Windows\sPhone/i);
	if(isiPhone == true || isAndroid == true || isWindows == true || isiPod == true){
		return true;
	}
	else{
		return false;
	}
}