<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
		<?php
		if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')){ob_start("ob_gzhandler");}else {ob_start();}
		$page_name = strtolower($title_for_layout);
		echo "\n";
		?>
	<html class="no-js"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title></title>
		<meta name="description" content="Contact us today and get insurance quotes for your home, office, autos and life. Let us protect the dreams youve worked so hard to achieve.">
		<meta name="expires" content="<?php echo date('D, d M Y h:i:s e',strtotime("next month"));?>">
		<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="Public">
		<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=0">
		<meta property="og:title" content="CNA description"/>
		<meta property="og:type" content="event"/>
		<meta property="og:url" content="https://qrf.amfam.com"/>
		<meta property="og:image" content="img/qrf-OG-tag.jpg"/>
		<meta property="og:description" content="Contact us today and get insurance quotes for your home, office, autos and life. Let us protect the dreams youve worked so hard to achieve."/>
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="@amfam">
		<meta name="twitter:creator" content="@amfam">
		<meta name="twitter:title" content="CNA description">
		<meta name="twitter:description" content="Contact us today and get insurance quotes for your home, office, autos and life. Let us protect the dreams youve worked so hard to achieve.">
		<meta name="twitter:image" content="img/qrf-OG-tag.jpg">
		<?php
		if ($page_name == 'findyouragent'){
			echo "\t \t";
			//echo $this -> Html -> script('jquery.min');
			echo $this -> Html -> script('https://maps-api-ssl.google.com/maps/api/js?v=3&sensor=false');
			echo "\n";
		}
		echo "\t \t";
		echo $this -> Html -> script('jquery.min');
		echo "\n";
 		if ($page_name == 'findyouragent'){

echo $this -> Html -> script('jquery-ui-1.8.20.custom.min');
echo "\n";
		echo "\t \t";
		echo $this -> Html -> script('markerclusterer');
		echo "\n";
		echo "\t \t";
		echo $this -> Html -> script('markerwithlabel');
		echo "\n";
		//echo $this -> Html -> script('jquery.tinyscrollbar.min');
		//echo "\n";
		//echo $this -> Html -> script('jquery-ui-1.8.20.custom.min');
		//echo "\n";
		echo "\t \t";
		echo $this -> Html -> script('infobox');
		echo "\t \t";
		echo "\n";
		echo $this -> Html -> script('agentscript');
			echo "\n";

		}
		echo $this -> Html -> script('main');
		echo "\t \t";
		echo $this -> Html -> css('fuelux');
		echo "\n";
		echo "\t \t";
		echo $this -> Html -> css('bootstrap');
		echo "\n";
		echo "\t \t";
		echo $this -> Html -> css('bootstrap-formhelpers');
		echo "\n";
		echo "\t \t";
		echo $this -> Html -> css('bootstrap-theme');
		echo "\n";
		echo "\t \t";
		echo $this -> Html -> css('custom');
		echo "\n";
		?>
	</head>
	<body>
		<header class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
				<?php echo $this->Html->image('logo-175x77.png', array('alt' => 'Amfam CNA'));?>
				</div>
			</div>
		</header>
		<div id="content" role="main" class="container main">
			<div class="content-container row">
				<?php echo $this -> Session -> flash(); ?>
				<?php echo $this -> fetch('content'); ?>
			</div>
		</div>
	</div>
		<footer>
			<div class="container">
				<div class="row">
					<div class="form-group col-xs-12 col-sm-6 col-md-6 legal">
						<ul>
							<li><a href="https://web.amfam.com/security/privacy.asp"class="list-group-item-text" target="_blank">Privacy &amp; Security Policy</a></li>
							<li><a href="https://web.amfam.com/customer/forms/helptext/vqw/privacy_alternate.pdf" class="list-group-item-text" target="blank">Insurance Practices</a></li>
						</ul>
					</div>
					<div class="form-group col-xs-12 col-sm-6 col-md-6 copyright">
						<p>&copy;<span id="year"><?php echo date('Y');?></span> American Family Insurance. All rights reserved.</p>
					</div>
				</div>
			</div>
		</footer>
<?php
ob_start();
echo $this -> Html -> script('https://af1dev.com/DreamBank/js/development/s_code.js');
echo "\n";
?>
<!-- SiteCatalyst code version: H.20.3.
Copyright 1997-2009 Omniture, Inc. More info available at
https://www.omniture.com -->
<script language="JavaScript" type="text/javascript">
<!--
/* You may give each page an identifying name, server, and channel on
the next lines. */

	s.pageName=CNA.page_title;
	s.server=""
	s.channel="CNA Quote"
	s.pageType=""
	s.prop1=""	 /* Site Search Keywords */
	s.prop3=""	 /* Dayparting (Day) */
	s.prop4=""	 /* Dayparting (Hour) */
	s.prop7=""	 /* Previous Page */
	s.prop8="CNA"	 /* Application */
	s.prop9="english"    /* Language */
	s.prop10="CNA Product Pages"    /* Roll Up Pages */
	/* E-commerce Variables */
	s.campaign=""    /* Tracking Code */
	s.eVar6="CNA"     /* Site Tool */
	s.eVar27=""    /* Previous Page */
	s.eVar14=""			/* DART View Through */
	s.eVar15="" 			/* DART Time Since Last Ad Visit */
	s.eVar3=s.transactionID=""     /* Reference Number */
	s.eVar59=";[Auto:Cars&Trucks],;[Home:Homeowners],;[Business]|[1]"
	s.xact = s.transactionID = ''
	s.products = CNA.products
/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
var s_code=s.t();

if(s_code)document.write(s_code)//--></script>
<script language="JavaScript" type="text/javascript"><!--
if(navigator.appVersion.indexOf('MSIE')>=0)document.write(unescape('%3C')+'\!-'+'-')
//--></script><noscript><a href="https://www.omniture.com" title="Web Analytics"><img
src="https://metrics.amfam.com/b/ss/amfamprod/1/H.20.3--NS/0"
height="1" width="1" border="0" alt="" /></a></noscript><!--/DO NOT REMOVE/-->
<!-- End SiteCatalyst code version: H.20.3 -->
<?php
$Omniture = ob_get_contents();
ob_end_clean();
echo $Omniture;
?>
</body>
</html>