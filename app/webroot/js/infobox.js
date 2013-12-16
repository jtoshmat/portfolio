/* An InfoBox is like an info window, but it displays
 * under the marker, opens quicker, and has flexible styling.
 * @param {GLatLng} latlng Point to place bar at
 * @param {Map} map The map on which to display this InfoBox.
 * @param {Object} opts Passes configuration options - content,
 *   offsetVertical, offsetHorizontal, className, height, width
 */
function InfoBox(opts) {
  google.maps.OverlayView.call(this);
  this.latlng_ = opts.latlng;
  this.map_ = opts.map;
  this.popupContent_ = opts.popupContent;
  this.offsetVertical_ = -245;
  this.offsetHorizontal_ = opts.offsetx || -60;
  this.height_ = 220;
  this.width_ = 258;

  var me = this;
  this.boundsChangedListener_ =
    google.maps.event.addListener(this.map_, "bounds_changed", function() {
      return me.panMap.apply(me);
    });

  // Once the properties of this OverlayView are initialized, set its map so
  // that we can display it.  This will trigger calls to panes_changed and
  // draw.
  this.setMap(this.map_);
}

/* InfoBox extends GOverlay class from the Google Maps API
 */
InfoBox.prototype = new google.maps.OverlayView();

/* Creates the DIV representing this InfoBox
 */
InfoBox.prototype.remove = function() {
  if (this.div_) {
	  if(this.div_.parentNode) {
	    this.div_.parentNode.removeChild(this.div_);
	    this.div_ = null;
	    this.popupContent_ = null;
	  }
  }
};

/* Redraw the Bar based on the current projection and zoom level
 */
InfoBox.prototype.draw = function() {
  // Creates the element if it doesn't exist already.
  this.createElement();
  if (!this.div_) return;

  // Calculate the DIV coordinates of two opposite corners of our bounds to
  // get the size and position of our Bar
  var pixPosition = this.getProjection().fromLatLngToDivPixel(this.latlng_);
  if (!pixPosition) return;

  // Now position our DIV based on the DIV coordinates of our bounds
  this.div_.style.width = this.width_ + "px";
  this.div_.style.left = (pixPosition.x + this.offsetHorizontal_) + "px";
  this.div_.style.height = this.height_ + "px";
  this.div_.style.top = (pixPosition.y + this.offsetVertical_) + "px";
  this.div_.style.display = 'block';
};

/* Creates the DIV representing this InfoBox in the floatPane.  If the panes
 * object, retrieved by calling getPanes, is null, remove the element from the
 * DOM.  If the div exists, but its parent is not the floatPane, move the div
 * to the new pane.
 * Called from within draw.  Alternatively, this can be called specifically on
 * a panes_changed event.
 */
InfoBox.prototype.createElement = function() {
  var panes = this.getPanes();
  var div = this.div_;
  if (!div) {

	var popupContent = this.popupContent_;

    // This does not handle changing panes.  You can set the map to be null and
    // then reset the map to move the div.
    if(popupContent) {
		div = this.div_ = document.createElement("div");
		div.style.border = "0px none";
		div.style.position = "absolute";
		div.style.background = "url('../img/agent-bubble.png') no-repeat";
		div.style.width = this.width_ + "px";
		div.style.height = this.height_ + "px";

		var contentDiv = getContent(popupContent);

		var topDiv = document.createElement("div");
		topDiv.style.textAlign = "right";
		var closeImg = document.createElement("img");
		closeImg.style.cursor = "pointer";
		closeImg.src = "../img/bigx.png";
		topDiv.appendChild(closeImg);

		function removeInfoBox(ib) {
		  return function() {
		    ib.setMap(null);
		  };
		}

		google.maps.event.addDomListener(closeImg, 'click', removeInfoBox(this));

		div.appendChild(topDiv);
		div.appendChild(contentDiv);
		div.style.display = 'none';
		if(panes.floatPane)
		panes.floatPane.appendChild(div);
		this.panMap();


	}
  } else if (div.parentNode != null && div.parentNode != panes.floatPane) {
    // The panes have changed.  Move the div.
    div.parentNode.removeChild(div);
    panes.floatPane.appendChild(div);
  } else {
    // The panes have not changed, so no need to create or move the div.
  }
}

function getContent(popupContent) {
	if(popupContent) {
		var contentDiv = document.createElement("div");
	    contentDiv.setAttribute((msielt7 ? 'className' : 'class'),"contentdiv");

	    // Agent Image
	    var leftDiv = document.createElement("div");
	    leftDiv.setAttribute("id","leftdiv");
	    var imageDiv = document.createElement("div");
	    imageDiv.setAttribute("id","imagediv");
	    imageDiv.setAttribute((msielt7 ? 'className' : 'class'),"imagediv");
	    var agentImg = document.createElement("img");
	    agentImg.src = (popupContent.pictureUrl == null)?'':popupContent.pictureUrl;
	    agentImg.style.width = "70px";
	    agentImg.style.height = "100px";
	    imageDiv.appendChild(agentImg);
	    leftDiv.appendChild(imageDiv);
	    // Amfam Logo
	    var logoDiv = document.createElement("div");
	    logoDiv.setAttribute((msielt7 ? 'className' : 'class'),"logodiv");
	    var logoImg = document.createElement("img");
	    logoImg.src = "../img/sm-logo.png";
	    logoDiv.appendChild(logoImg);
	    leftDiv.appendChild(logoDiv);
	    contentDiv.appendChild(leftDiv);


	    // Agent details
	    var agentDiv = document.createElement("div");
	    agentDiv.setAttribute("id","agentdiv");
	    agentDiv.setAttribute((msielt7 ? 'className' : 'class'),"agentdiv");

	    // Agent Name
	    var agentNameDiv = document.createElement("div");
	    agentNameDiv.setAttribute("id","agentname");
	    agentNameDiv.setAttribute((msielt7 ? 'className' : 'class'),"agentsubdiv");
	    agentNameDiv.innerHTML = "<h2>"+popupContent.name+"</h2>";
	    agentDiv.appendChild(agentNameDiv);
	    // Agent Address
	    var agentAddressDiv = document.createElement("div");
	    agentAddressDiv.setAttribute("id","agentaddress");
	    agentAddressDiv.setAttribute((msielt7 ? 'className' : 'class'),"agentsubdiv");
	    agentAddressDiv.innerHTML = "<p>"+popupContent.address[0]+",</p> <p>"+popupContent.address[1]+"<br /> "+popupContent.address[2]+" "+popupContent.address[3]+"</p>";
	    agentDiv.appendChild(agentAddressDiv);
	    // Agent Phone
	    var agentPhoneDiv = document.createElement("div");
	    agentPhoneDiv.setAttribute("id","agentphone");
	    agentPhoneDiv.setAttribute((msielt7 ? 'className' : 'class'),"agentsubdiv");
	    agentPhoneDiv.innerHTML = "<a href='tel:+1-"+popupContent.phone+"'>"+popupContent.phone+"</a>";
	    agentDiv.appendChild(agentPhoneDiv);
	    // Agent Email
	    var agentEmailDiv = document.createElement("div");
	    agentEmailDiv.setAttribute("id","agentemail");
	    agentEmailDiv.setAttribute((msielt7 ? 'className' : 'class'),"agentsubdiv");
	    agentEmailDiv.innerHTML = popupContent.email;
	    agentDiv.appendChild(agentEmailDiv);
	    // Agent Site
	    var agentSiteDiv = document.createElement("div");
	    agentSiteDiv.setAttribute("id","agentsite");
	    agentSiteDiv.setAttribute((msielt7 ? 'className' : 'class'),"agentsubdiv");
	    agentSiteDiv.innerHTML = popupContent.website; // Jon Toshmatov 8/15/2013
	    agentDiv.appendChild(agentSiteDiv);
	    // Agent ID
	    var agentIdDiv = document.createElement("div");
	    agentIdDiv.setAttribute("id","agentid");
	    agentIdDiv.setAttribute((msielt7 ? 'className' : 'class'),"agentsubdiv");
	    agentIdDiv.innerHTML = popupContent.agentId; // Jon Toshmatov 8/19/2013
	    agentDiv.appendChild(agentIdDiv);

	    contentDiv.appendChild(agentDiv);
	    return contentDiv;
	 }
	return '';
}

/* Pan the map to fit the InfoBox.
 */
InfoBox.prototype.panMap = function() {
  // if we go beyond map, pan map
  var map = this.map_;
  var bounds = map.getBounds();
  if (!bounds) return;

  // The position of the infowindow
  var position = this.latlng_;

  // The dimension of the infowindow
  var iwWidth = this.width_;
  var iwHeight = this.height_;

  // The offset position of the infowindow
  var iwOffsetX = this.offsetHorizontal_;
  var iwOffsetY = this.offsetVertical_;

  // Padding on the infowindow
  var padX = 40;
  var padY = 40;

  // The degrees per pixel
  var mapDiv = map.getDiv();
  var mapWidth = mapDiv.offsetWidth;
  var mapHeight = mapDiv.offsetHeight;
  var boundsSpan = bounds.toSpan();
  var longSpan = boundsSpan.lng();
  var latSpan = boundsSpan.lat();
  var degPixelX = longSpan / mapWidth;
  var degPixelY = latSpan / mapHeight;

  // The bounds of the map
  var mapWestLng = bounds.getSouthWest().lng();
  var mapEastLng = bounds.getNorthEast().lng();
  var mapNorthLat = bounds.getNorthEast().lat();
  var mapSouthLat = bounds.getSouthWest().lat();

  // The bounds of the infowindow
  var iwWestLng = position.lng() + (iwOffsetX - padX) * degPixelX;
  var iwEastLng = position.lng() + (iwOffsetX + iwWidth + padX) * degPixelX;
  var iwNorthLat = position.lat() - (iwOffsetY - padY) * degPixelY;
  var iwSouthLat = position.lat() - (iwOffsetY + iwHeight + padY) * degPixelY;

  // calculate center shift
  var shiftLng =
      (iwWestLng < mapWestLng ? mapWestLng - iwWestLng : 0) +
      (iwEastLng > mapEastLng ? mapEastLng - iwEastLng : 0);
  var shiftLat =
      (iwNorthLat > mapNorthLat ? mapNorthLat - iwNorthLat : 0) +
      (iwSouthLat < mapSouthLat ? mapSouthLat - iwSouthLat : 0);

  // The center of the map
  var center = map.getCenter();

  // The new map center
  var centerX = center.lng() - shiftLng;
  var centerY = center.lat() - shiftLat;

  // center the map to the new shifted center
  map.setCenter(new google.maps.LatLng(centerY, centerX));

  // Remove the listener after panning is complete.
  google.maps.event.removeListener(this.boundsChangedListener_);
  this.boundsChangedListener_ = null;
};