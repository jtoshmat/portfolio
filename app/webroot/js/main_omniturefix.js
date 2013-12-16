//##################################################################################################################################################
var QRF = {
		/*
		 * Company: American Family Insurance
		 * Department: Web Experience Unit 2
		 * Project Manager: Robyn Chase
		 * Project Lead: Greg Tarnoff
		 * Developer: Jon Toshmatov
		 * Front-end Developer: Chanda Golani
		 * Graphic Designers: Tricia Stearns
		 * Created: February 26, 2013
		 * Last Modified: August 12, 2013
		 *
		 * All the major variables are declared here
		 * A variable can be called with QRF.varname and set QRF.varname = ''
		 * most of the vars are used for counters		 *
		 */
		previous_id : $('.active').prev().attr('id'),
		current_id : $('.active').attr('id'),
	 	current : $('.active'),
		prospect_id : 0,
		last_id : $('fieldset').last().attr('id'),
		total_fieldsets : $('fieldset').index(),
		form_name : $('.forms').attr('name'),
		slide_direction : 0,newLeft : $('.forms').css('left'),
		screens : $('.screen'),	maxLeft : 0,screenWidth : 775,
		minLeft:0,counter: 3,minLeft : 0,slide_count : 1,data : '',
		is_questions_load : 0,
		total_products_options : 0,
		page_to_exec : '',ajax_request : '',
		products_check_list : '',pop_up_message : '',simple_counter : 0,
		options_fieldsets_total : 0,temp : '',the_last_fieldset : '',
		total_progress_li : 0, selected_products : 0, is_responses_saved : 0,
		is_meet_agent_loaded : 0, is_promotion_on : 0,zipcode:'',trigger_find_agent:0,
		agentID : '',referrer : '',is_from_agent : -1, static_slide_num :5,
		domain : window.location.hostname,medical54_value : '',error : 0, is_facebook : false,
		//*******************************************************************//
		is_numeric : function(num){
			   return typeof num === 'number' && isFinite(num);
		},
		//*******************************************************************//
		is_email : function(email){
			  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,1})+$/;
			  //var regex = /^([a-zA-Z0-9+-_.){1+}\@([a-zA-Z0-9.-_){1+}(.){1}(a-zA-Z){2+} /; acceptible 5/22
			  return regex.test(email);
		},
		//*******************************************************************//
		//get querystring by passing the querystring name for example, www.amfam.com?facebook=2232323 sVar=facebook.
		querystring : function (sVar){
			return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(sVar).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
		},
		//*******************************************************************//
		update_questions_ids : function (qid){
			var json = $.parseJSON(qid);
			$(json).each(function(i,val){
				$.each(val,function(id,qid){
	            //$('#pros_resp_id_'+qid).val(id);
	      		});
			});
		},
		//*******************************************************************//
		save_questions : function (product){
			QRF.is_responses_saved = 1;
			QRF.data = "";
			QRF.data = $("#"+product+" input").serialize();
 			QRF.data = QRF.data+"&"+$("#"+product+" select").serialize();
			QRF.data = QRF.data+"&"+$("#"+product+" textarea").serialize();
			$.ajax({
			    type : 'POST',
			    url :  'ProspectResponses/saveResponse',
			    data : QRF.data
			}).done(function(msg){
				QRF.update_questions_ids(msg);
				QRF.is_responses_saved = 1;
		    });
		},
		//*******************************************************************//
		save_tell_us : function (){
 			QRF.data = "";
 			//QRF.data = $('#tell-us-about-yourself').serialize();
 			QRF.data = $("#tell-us-about-yourself input").serialize();
 			QRF.data = QRF.data+"&"+$("#tell-us-about-yourself select").serialize();
 			QRF.data = QRF.data+"&"+$("#tell-us-about-yourself textarea").serialize();

 			QRF.ajax_request = $.ajax({
				type : 'POST',
				url :  'prospects/createProspect',
				async : true,
				data : QRF.data
			});
		    QRF.ajax_request.done(function(msg){
		    		pid =msg.replace('"','');
					pid =pid.replace('"','');
		       		//QRF.load_products_questions(pid);
		       		$('#ProspectId').val(pid);
		       		QRF.prospect_id = pid;
		       		$('.prospect_id').val(pid);
		       		$("#reference_number").html("Reference Number: QRF"+pid);
		    });
		},
		//*******************************************************************//
		update_products_ids : function (){
			var checked = $("#first input:checked");
			QRF.products_check_list = checked;
			var l = checked.length;
			QRF.data = "";
			for(i=0;i<l; i++){
				QRF.data += checked[i].value+":";
			};
			var pos = QRF.data.lastIndexOf(':');
			var products = QRF.data.substring(0,pos);
			products = products.split(":");
			$('.prodid').val('');
			$('.prodid').css('display','none');
			for (var p=0;p<10;p++){
				$('#prod_'+products[p]).val(products[p]);
				$('#prod_'+products[p]).css('display','block');
			}
			QRF.data = JSON.stringify(QRF.data);
			return products;
		},
		//*******************************************************************//
		s_code_counter : 0,
		update_page_title : function (direction){
			var id = (direction=='next')?$('.active').next().attr('id'):$('.active').prev().attr('id');
			var title = $("#"+id+" .page_title h2").text();

			if (id=='first'){
				title = "QRF:Welcome";
			}
			if(id=='thankyou'){
				title = "Thank You";
			}
			document.title = "QRF:"+title;
			QRF.s_code_counter++;
		},
		//*******************************************************************//
		save_data : function (direction,e){
			var id = $('.active').attr('id');
			//hide progress bar, previous button on first slide
			//use visibility vs display to prevent slides and prev button, progress bar from jumping up&down
			if (direction=='previous' && id =='tell-us-about-yourself'){
				$('#progress-bar').css("visibility","hidden");
				$(".previous").css("display","none");
				}else{
					$('#progress-bar').css("visibility","visible");
				}
			//if (direction!=='next'){return false;}
			var next_fieldset_name = $('.active').next().attr('name');

			switch (id){
			case 'first':
				QRF.update_products_ids();
				$(".previous").fadeIn("fast");
				QRF.submitomniture("first",e);
				break;
			case 'tell-us-about-yourself':
				QRF.submitomniture("tell-us-about-yourself",e);
				break;
			case 'auto':
				QRF.save_questions('auto');
				QRF.submitomniture("auto",e);
				break;
			case 'business':
				QRF.save_questions('business');
				QRF.submitomniture("business",e);
				break;
			case 'farm':
				QRF.save_questions('farm');
				QRF.submitomniture("farm",e);
				break;
			case 'life':
				QRF.save_questions('life');
				QRF.submitomniture("life",e);
				break;
			case 'medical':
				//$("#medical54_response").val(QRF.medical54_value);
				QRF.save_questions('medical');
				QRF.submitomniture("medical",e);
				break;
			case 'travel':
				QRF.save_questions('travel');
				QRF.submitomniture("travel",e);
				break;
			case 'renters':
				QRF.save_questions('renters');
				QRF.submitomniture("renters",e);
				break;
			case 'homeowners':
				QRF.save_questions('homeowners');
				QRF.submitomniture("homeowners",e);
				break;
			case 'power':
				//QRF.power_sports();
				QRF.save_questions('power');
				QRF.submitomniture("power",e);
				break;
			case 'umbrella':
				QRF.save_questions('umbrella');
				QRF.submitomniture("umbrella",e);
				break;
			case 'findyouragent':
				QRF.submitomniture("findyouragent",e);
				break;
			case 'meetyouragent':
				//$(".paging").fadeOut();
				QRF.is_promotion_on = 0;
				QRF.submitomniture("meetyouragent",e);
				break;
			case 'thankyou':
				//$(".paging").fadeOut();
				QRF.is_promotion_on = 0;
				QRF.submitomniture("thankyou",e);
				break;
			default:
				QRF.update_products_ids();
				break;
			}
		},
		//*******************************************************************//
		//slide the fieldsets next or previous
		getX : function (){
			var windowWidth = window.innerWidth || document.documentElement.clientWidth;
			var screenWidth = parseInt($('.screen').css('width'))/2;
			var xPos = (windowWidth/2)-screenWidth;
			return xPos;
		},
		previousPos : "-110%",
		nextPos : "110%",
		slide : function(moveScreen, slideScreen){
			if(moveScreen != ""){
				$('.active').removeClass('active').animate({
						left: moveScreen
					}, 1000);
			};
			$(slideScreen).addClass('active').delay(500).animate({
						left: QRF.getX()}, 1000);
		},
		move : function(direction){
			QRF.slide_count++;
			var moveScreen = (direction ==  'next') ? QRF.previousPos : QRF.nextPos;
			var slideScreen = (direction ==  'next') ? $('.active').next('.screen') : $('.active').prev('.screen');
			if(($('.active').hasClass('last') && direction == 'next') || ($('.active').hasClass('first') && direction == 'previous')){
				return false;
			} else {
				QRF.slide(moveScreen,slideScreen);
			}
			if( $('.active').hasClass('first') ){
				QRF.is_questions_load = 0; //set the question load to 0 for new products to be selected
				QRF.slide_count = 0;
			}
		},
		resize : function(){
			$('.active').css('left',QRF.getX()+"px");
		},
		//*******************************************************************//
		page_num : 1,
		page_id : 2,
		load_pages : function (screen,id,when){
			var pid = QRF.prospect_id;
			//set vars
			if (screen==''){return false;}//screen is required
			//end set vars
			if (when=='33'){
				$("<fieldset>").load(screen+"?data="+id, function() {
					$($(this).html()).insertAfter(".first");
				});
			}
			if (when=='beforethankyou'){
				$("<fieldset>").load(screen+"?data="+id, function() {
					$($(this).html()).insertAfter("#tell-us-about-yourself");

				});
			}
			QRF.page_id++;
		},
		//*******************************************************************//
		load_slides : function(slide,url){
			//IE fix for ajax, load and get
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			    {
			    document.getElementById(slide).innerHTML=xmlhttp.responseText;
			    }
			  }
			xmlhttp.open("GET",url,true);
			xmlhttp.send();
		},
		//*******************************************************************//
		first_selected : new Array(),
		last_selected : new Array(),
		last_selected_value : new Array(),
		all_selected : new Array(),
		load_products : function (direction, ins_slide){

			if (direction!='next' || QRF.is_questions_load!=0){return false;}
			var checked = $("#first input:checked");
			var checked_all = $("#first input[type='checkbox']");
			var l_all = checked_all.length;
			var l = checked.length;
			var total = parseInt($("form fieldset").index())+1;
			var id ="";
			var slide = "";
			var slideurl = "";
			var thankyou_products = new Array();
			QRF.all_selected = [];
			for(i=0;i<l; i++){
				QRF.all_selected[i]=checked[i].name;
					thankyou_products[i] = checked[i].value;
					//console.log(checked[i].name);
		 	}
			//var found = QRF.all_selected.indexOf("renters"); //-1 is not found
			var total_open_fieldsets = $("fieldset").index()+1; //total 5 static fieldsets
			var product='';
			checked.sort();
			checked_all.sort();
			QRF.all_selected.sort();
			checked_all.sort();
			//IE fix for indexOf
			if (!Array.prototype.indexOf)
			{
			  Array.prototype.indexOf = function(elt /*, from*/)
			  {
			    var len = this.length >>> 0;

			    var from = Number(arguments[1]) || 0;
			    from = (from < 0)
			         ? Math.ceil(from)
			         : Math.floor(from);
			    if (from < 0)
			      from += len;

			    for (; from < len; from++)
			    {
			      if (from in this &&
			          this[from] === elt)
			        return from;
			    }
			    return -1;
			  };
			}

			for(var i=0;i<l_all; i++){
				if (checked_all[i].name!=''){
					product = ($("#"+checked_all[i].name).attr("name")==checked_all[i].name)?checked_all[i].name:'';
				}
				if (product && QRF.all_selected.indexOf(checked_all[i].name)==-1){
					 $("#"+checked_all[i].name).remove();
				}
				if (product=='' && QRF.all_selected.indexOf(checked_all[i].name)>=0){
					$("<fieldset name='"+checked_all[i].name+"' class='screen' id='"+checked_all[i].name+"'>"+checked_all[i].name+"</fieldset>").insertBefore("#"+ins_slide);
					slide = checked_all[i].name;
					url = checked_all[i].name+"?data="+checked_all[i].value;
					QRF.load_slides(slide, url);
				}
			}//end for loop
			//Update the thankyou slide with the selected products
			$("#thankyou").load("thankyou?data="+thankyou_products);
		},
		//*******************************************************************//
		update_progress_bar : function (){
			//$('.progress-bar > li').eq(1).attr('class', 'selected');
			var txt = "";
			var current_fieldset = $('.active').index();
			var id = (QRF.slide_direction==1)?parseInt(current_fieldset)+1:parseInt(current_fieldset)-1;
			var selected = "";
			var first_li =1;
			var checked = $("#first input:checked");
			var products = parseInt(checked.length) + QRF.static_slide_num;
			var l = $('fieldset').length + 5;
			var c = $('.active').attr('id');

			for (var i=1; i<products;i++){
				if (i==id){
					txt += '<li class=\'selected\' id=li_'+i+'>'+i+'</li>';
				}else{
					txt += '<li id=li_'+i+'>'+i+'</li>';
				}
			}

			$('.progress-bar').html(txt);
		},
		//*******************************************************************//
		load_auto_options : function (id){
			if (id==0){$(".auto11").css('display','none');
			$(".auto11 input").val('');
			}
			if (id==0 || id>7){return false;}

			$(".auto11").css('display','none');
			$(".auto11 input").attr('disabled','disabled');

			for (var i=1;i<=id;i++){
				$("#answer_"+i+" input").attr('disabled',false);
				$("#answer_"+i).css('display','block');

				if (i==6){
					$("#autooptions6").css('display','block');
					return false;
				}else{
					$("#autooptions6").css('display','none');
				}
			}
		},
		//*******************************************************************//
		search_agent : function (zip){
		var zipcode = parseInt($("#zipcode").val());
		if ($("#zipcode").val().length<5){QRF.warning("Zip code must be 5 number long"); return false;}
		if (!QRF.is_numeric(zipcode)){QRF.warning("Zip code must be only numbers");return false;}
		submitform(zipcode,'findagent');
		},
		//*******************************************************************//
		meet_your_agent : function (){
			var mydata = $(".contentdiv").html();
			var data = {};
			data['agentimage'] = $("#imagediv").html();
			data['agentname'] = $("#agentname").text();
			data['agentaddress'] = $("#agentaddress").text();
			data['agentphone'] = $("#agentphone").text();
			data['agentsite'] = $("#agentsite").html();
			data['agentemail'] = $("#agentemail").text();
			QRF.agentname = data['agentname'];
			//var email = $(".ui-accordion-content-active .sidebarContact a").eq(0).attr("href");
			//email_text = "<a target='blank' href='"+email+"'>Email</a>";
			var html = "";
			html += "<li>"+data['agentimage']+"</li>";
			html += "<li><h3>"+data['agentname']+"</h3></li>";
			html += "<li>"+data['agentaddress']+"</li>";
			html += "<li>"+data['agentphone']+"</li>";
			//html += "<li>"+email_text+"</li>";
			//html += "<li>"+data['agentsite']+"</li>";
			$("#meetyouragent .agent-location").html(html);
			var longlat1 = $('#map_canvas a[href^="http://maps.google.com/maps"]').attr("href");
			//http://maps.google.com/maps?ll=42.567869,-90.59469&z=10&t=m&hl=en-US
			var longlat1 = longlat1.replace("http://maps.google.com/maps?ll=","");
			var pos = longlat1.indexOf("&");
			var longlat1 = longlat1.substring(0,pos);
			var zip = $("#zipcode").val();
			//var longlat = longlat1.split(":");
			//longlat[1]longlat[2];

			/*
			 * The Google map API is subject to Google terms adn condition. Please go to URL below for limit and usage agreement
			 * https://developers.google.com/maps/documentation/staticmaps/
			 */

			//var longlat2 = "http://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318&markers=color:red%7Ccolor:red%7Clabel:C%7C40.718217,-73.998284&sensor=false";
			//var longlat2 = "http://maps.googleapis.com/maps/api/staticmap?center="+data['agentaddress']+"&zoom=13&size=435x350&maptype=roadmap&markers=color:blue%7Clabel:S%7S42.567869,-90.59469&sensor=true";


			var longlat2 = "http://maps.googleapis.com/maps/api/staticmap?size=435x350&maptype=roadmap\&markers=size:mid%7Ccolor:red%7C"+data['agentaddress']+"&sensor=false";
			$("#meetyouragent_google_map").attr("src",longlat2);
		},
		warning : function (msg){
			if (msg==''){return false;}
			$(".warning").html("<h3>"+msg+"</h3>");
			$('.warning').fadeIn().delay(1500).fadeOut('slow');
		},
		//*******************************************************************//
		sproducts : '',
		sproducts2 : '',
		saywhat : '',
		set_omniture_code : function (slide, prop10){
			return false;
			var id = $('.active').next().attr('id');
			var next_fieldset_name = $('.active').next().attr('name');
			var previous_fieldset_name = $('.active').prev().attr('name');
			var current_fieldset_name = $('.active').attr('name');
			//var pageTitle = $("#"+current_fieldset_name+" .page_title h2");
			var myTime = new Date();
			OmnTitle = ($("#"+current_fieldset_name+" .page_title h2").text()=='')?"QRF:Welcome":"QRF:"+$("#"+current_fieldset_name+" .page_title h2").text();
			s.pageName= myTime;

			//s.prop7 = $("#"+previous_fieldset_name+" .page_title h2").text();; //previous page

			var fieldset_number = $('.active').index();
			/*
			 * Caitlin and I modified this on May 8
			 *
			 */
			if (fieldset_number==2){
			s.eVar16 = ($("#ProspectCity").val()=='')?'':$("#ProspectCity").val();
			s.eVar17 = ($("#ProspectStateId").val()=='')?'':$("#ProspectStateId").find(":selected").text();
			s.transactionID = "QRF"+$(".prospect_id").val();
			}else{
				s.eVar16 = "";
				s.eVar17 = "";
				s.transactionID = "";
			}
			s.prop10 = prop10;
			var checked = $("#first input:checked");
			var lp = checked.length;
			var omname ="";
			var omname2 ="";
			var num=1;
			if (slide=='tell-us-about-yourself'){
				for(y=0;y<lp; y++){
					omname = $("#option_"+checked[y].name).attr("class");
					QRF.sproducts += ";["+QRF.capitalize(checked[y].name)+":"+omname+"]";
				}
			s.products = QRF.sproducts;//selected products
			}else{
				for(t=0;t<lp; t++){
					if (current_fieldset_name==checked[t].name){
						omname2 = $("#option_"+checked[t].name).attr("class");
						QRF.sproducts2 += ";["+QRF.capitalize(checked[t].name)+":"+omname2+"]["+num+"],";

					}
					num++;

				}
				s.eVar59 = QRF.sproducts2;//only completed products
			}

			s.eVar28 = ($(".agent-location h3").text()=='')?"":$(".agent-location h3").text();
		},
		all_value : "",
		auto_counter : 1,
		//*******************************************************************//
		capitalize : function (string){
		    return string[0].toUpperCase() + string.slice(1);
		},
		//*******************************************************************//
		cookies : function (name) {
		    var nameEQ = name + "=";
		    var ca = document.cookie.split(';');

		    for(var i=0;i < ca.length;i++) {
		        var c = ca[i];
		        while (c.charAt(0)==' ') c = c.substring(1,c.length);
		        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		    }
		    return false;
		},
		//*******************************************************************//
		fetch_responses : function (qid, pid){
			if (qid=='' || pid==''){return false;}
			QRF.data = "qid="+qid+"&pid="+pid;
			$.ajax({
			    type : 'POST',
			   url :  'ProspectResponses/buildemail',
			   data : QRF.data
			}).done(function(msg){
				//alert("DONE");
			});
		},
		//*******************************************************************//
		submitomniture : function (slide, e){
			QRF.update_omniture_tags(slide);
			console.log("Step 2: s.t fired up line 560");
			//Step 2 run the s.code
			s.t();
		    //if(e.isPropagationStopped()) return;  //important, check for it!
		    //e.stopPropagation();

		},
		update_omniture_tags : function (slide){
			//Step 1- update the tags
			var checked = $("#first input:checked");
			var lp = checked.length;
			var omname ="";
			var omname2 ="";
			var num=1;

			s.products="";
			s.pageName="QRF:Tell Us About Yourself";
				s.server="";
				s.channel="Quote";
				s.pageType="";
				s.prop1="";	 /* Site Search Keywords */
				s.prop3="";	 /* Dayparting (Day) */
				s.prop4="";	 /* Dayparting (Hour) */
				s.prop5="";	 /* Form Analysis */
				s.prop7="";	 /* Previous Page */
				s.prop8="QRF";	 /* Application */
				s.prop9="english";    /* Language */
				s.prop10="";    /* Roll Up Pages */
				/* E-commerce Variables */
				s.campaign="";    /* Tracking Code */
				s.eVar6="QRF";     /* Site Tool */
				s.eVar27="";    /* Previous Page */
				s.eVar14="";			/* DART View Through */
				s.eVar15=""; 			/* DART Time Since Last Ad Visit */
				s.eVar16="";     /* City */
				s.eVar17="";     /* State */
				s.event="event16";    /* QRF Start */


			if (slide=="first"){
				s.pageName="QRF:Welcome";
				s.prop10="QRF:Welcome";    /* Roll Up Pages */
				s.event="event16";     /* Site Tool Starts */
				console.log("update tags for:"+slide);
			}
			if(slide=="tell-us-about-yourself"){

				s.pageName="QRF:Tell Us About Yourself";
				s.prop10="QRF:Tell Us About Yourself";    /* Roll Up Pages */
				s.products="";
				s.eVar16 = ($("#ProspectCity").val()=='')?'':$("#ProspectCity").val();
				s.eVar17 = ($("#ProspectStateId").val()=='')?'':$("#ProspectStateId").find(":selected").text();
				s.transactionID = "QRF"+$(".prospect_id").val();
				s.event="event18";     /* QRF Start */

				for(var y=0;y<lp; y++){
					omname = $("#option_"+checked[y].name).attr("class");
					QRF.sproducts += ";["+QRF.capitalize(checked[y].name)+":"+omname+"]";
				}
				s.products = QRF.sproducts;//selected products
				console.log("update tags for:"+slide);
			}
			if(slide=="auto"){
				s.pageName="QRF:Auto";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				s.eVar3=s.transactionID="";     /* Reference Number */
				s.eVar59=QRF.sproducts;
				console.log("update tags for:"+slide);
			}
			if(slide=="homeowners"){
				s.pageName="QRF:Homeowners";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				s.eVar59=QRF.sproducts;
				console.log("update tags for:"+slide);
			}
			if(slide=="life"){
				s.pageName="QRF:Life";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				s.eVar59=QRF.sproducts;
				console.log("update tags for:"+slide);
			}
			if(slide=="power"){
				s.pageName="QRF:Power Sports";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				s.eVar59="coming soon";
				console.log("update tags for:"+slide);
			}
			if(slide=="renters"){
				s.pageName="QRF:Renters";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				s.eVar59=QRF.sproducts;
				console.log("update tags for:"+slide);
			}
			if(slide=="business"){
				s.pageName="QRF:Business";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				s.eVar59=QRF.sproducts;
				console.log("update tags for:"+slide);
			}
			if(slide=="travel"){
				s.pageName="QRF:Travel";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				s.eVar59=QRF.sproducts;
				console.log("update tags for:"+slide);
			}
			if(slide=="medical"){
				s.pageName="QRF:Medical";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				s.eVar59=QRF.sproducts;
				console.log("update tags for:"+slide);
			}
			if(slide=="farm"){
				s.pageName="QRF:Farm";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				s.eVar59=QRF.sproducts;
				console.log("update tags for:"+slide);
			}
			if(slide=="umbrella"){
				s.pageName="QRF:Umbrella";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				s.eVar59=QRF.sproducts;
				console.log("update tags for:"+slide);
			}
			if(slide=="findyouragent"){
				s.pageName="QRF:Find An Agent";
				s.prop10="QRF:Find An Agent";    /* Roll Up Pages */
				s.event="";
				s.eVar6 = "QRF";
				console.log("update tags for:"+slide);
			}
			if(slide=="meetyouragent"){
				s.pageName="QRF:Preselected Agent";
				s.prop10="QRF:Find An Agent";    /* Roll Up Pages */
				s.event="";
				s.eVar6 = "QRF";
				console.log("update tags for:"+slide);
			}
			if(slide=="thankyou"){
				s.pageName="QRF:Thank You Confirmation";
				s.prop10="QRF:Confirmation";    /* Roll Up Pages */
				s.eVar28="";    /* Agent First and Last Name */
				//s.event="event19";     /* QRF Complete */
				//s.event="event30";     /* Lead Contact Submitted */
				s.eVar6 = "QRF";
				console.log("update tags for:"+slide);
			}
			if(slide=="wait"){
				s.pageName="QRF:Processing Request";
				s.prop10="QRF:Confirmation";    /* Roll Up Pages */
				s.event="";
				s.eVar6 = "QRF";
				console.log("update tags for:"+slide);
			}

		},
		//*******************************************************************//
		all_inputs : "",
		old_product : "",
		copy_inputs : function(label,val,product){
			label = label.replace("YesNo","");
			label = label.replace("NoYes","");
			label = label.replace(/~+$/g,"");
			val = val.replace(/~+$/g,"");
			product = product.charAt(0).toUpperCase() + product.slice(1);
		if (QRF.old_product!=product){
			QRF.old_product = product.charAt(0).toUpperCase() + product.slice(1);
			QRF.all_inputs+="<hr /><strong>"+QRF.old_product+ "</strong><br/>";
		}
		QRF.all_inputs+=label+": <i><u>"+val+"</u></i><br/>";
		},
		//*******************************************************************//
		email_responses : '<ul>',
		build_email_responses : function () {//loads meet your agent if referrer is amfam agent site
				QRF.email_responses += "<li><strong>Prospect Name: </strong>"+$("#ProspectFirstName").val()+" "+$("#ProspectLastName").val()+"</li>";
				QRF.email_responses += "<li><strong>Address: </strong>"+$("#ProspectAddress").val()+"</li>";
				QRF.email_responses += "<li><strong>City: </strong>"+$("#ProspectCity").val()+"</li>";
				QRF.email_responses += "<li><strong>State: </strong>"+$("#ProspectStateId").find(":selected").text()+"</li>";
				QRF.email_responses += "<li><strong>ZIP Code: </strong>"+$("#ProspectZipcode").val()+"</li>";
				QRF.email_responses += "<li><strong>Phone: </strong>"+$("#ProspectPhoneNumber").val()+"</li>";
				QRF.email_responses += "<li><strong>E-mail: </strong>"+$("#ProspectEmailAddress").val()+"</li>";
				QRF.email_responses += "<li><strong>Language: </strong>"+$("#ProspectLanguageId").find(":selected").text()+"</li>";
				QRF.email_responses += QRF.all_inputs;
		},
		agentname : '',
		agentinformation : "",
		load_facebook : function (fbid){

			QRF.data = "fbid="+fbid+"&key=hEzHBQV1Ic";
			$.ajax({
			    type : 'POST',
			   url :  'ProspectResponses/getfacebookagent',
			   data : QRF.data
			}).done(function(xml){

				var obj = jQuery.parseJSON(xml);
				var firstname = "", lastname="",fbid="",zip="",email="",error="",status="",agencyname="";
				prospect_state = $("#ProspectStateId").val();
				$(obj).each(function(){
					fbid = obj.items[0].fbid;
					firstname = obj.items[0].firstname;
					lastname = obj.items[0].lastname;
					zip = obj.items[0].zip;
					email = obj.items[0].email.toLowerCase();
					error = obj.items[0].error;
					status = obj.items[0].status;
					agencyname = obj.items[0].agencyname;
				});

				QRF.data = "zip="+zip;
				$.ajax({
				    type : 'POST',
				    url :  'ProspectResponses/process',
				    data : QRF.data
				}).done(function(xml){

					$(xml).find('agent').each(function(){
							var agentname = $(this).find('name').text();
							var agentaddress = $(this).find('address').text();
							var pictureUrl = $(this).find('pictureUrl').text();
							var agentemail = $(this).find('email').text().toLowerCase();
							//var agentphone = ($(this).find('phone').eq(2).text()=='')?$(this).find('phone').eq(1).text():$(this).find('phone').eq(2).text();
							var agentphone = $(this).find('phone').text();
							var agentInternetAddress = $(this).find('agentInternetAddress').text();
							var agentsite =$(this).find('agentsite').text();

							QRF.agentname = agentname;
						if (agentemail==email){
							//Agent's information
							var agentInternetAddress = $(this).find('agentInternetAddress').text();
							var html = "";
							html += "<li><img src=\""+pictureUrl+"\" style=\"width: 70px; height: 100px;\"></li>";
							html += "<li><h3>"+agentname+"</h3></li>";
							html += "<li>"+agentaddress+"</li>";
							html += "<li>"+agentphone.toLowerCase()+"</li>";
							html += "<li><a target='blank' href=\"mailto:"+agentemail+"\">Email</a><br /></li>";
							html += "<li><a target='blank' href=\""+agentInternetAddress+"\">Website</a></li>";
							$("#meetyouragent .agent-location").html(html);



							//thankyou slide agentinformation


							var agentname = "<h3>"+agentname+"</h3>";
							var address = "<span class=\"agent-office-location\">Office Location:</span>"+agentaddress+"";
							var phone = "<span class=\"agent-office-phone\"><a href='tel:"+agentphone+"'>"+agentphone+"</a></span><br/>";
							var agentemail = "<span class=\"agent-office-email\"><a href=\"mailto:"+agentemail+"\">"+agentemail+"</a></span>";
							var url = "<a target=\"_blank\" title=\"Meet Your Agent\" href=\"http://www.amfam.com\" class=\"button agent_website\" id=\"thankyou-agent-website\">Agent Website ></a>";
							//url = "<a target='_blank' href='"+agentInternetAddress+"' title='Meet Your Agent' class='button agent_website' id='thankyou-agent-website'>Agent Website ></a>";
							//$(url).insertAfter("#agentinformation");

							$("#agentinformation").attr("href",agentInternetAddress);
							QRF.agentinformation = agentname+address+phone+agentemail;
							//Agent's map
							var longlat3 = "http://maps.googleapis.com/maps/api/staticmap?size=435x350&maptype=roadmap\&markers=size:mid%7Ccolor:red%7C"+agentaddress+"&sensor=false";
							$("#meetyouragent_google_map").attr("src",longlat3);
						}
					});

			    });




			});
		},
		load_agent : function () {//loads meet your agent if referrer is amfam agent site
			//check the agent info in the querystring.
			var c_url = document.location;
			var qs = document.location.search;
			var splt = qs.split('&');
			if (splt[0]==''){return false;}
			var agent_first_name = splt[0].replace('?agent-first-name=','');
			var agent_last_name = splt[1].replace('agent-last-name=','');
			var agent_state = splt[2].replace('agent-state=','');
			QRF.data = "firstName="+agent_first_name+"&lastName="+agent_last_name+"&state="+agent_state;
			$.ajax({
			    type : 'POST',
			    url :  'ProspectResponses/processbyname',
			    data : QRF.data
			}).done(function(xml){
				$(xml).find('agent').each(function(){
					var agentname = $(this).find('name').text();
					var agentaddress = $(this).find('address').text();
					var pictureUrl = $(this).find('pictureUrl').text();
					var agentemail = $(this).find('email').text();
					var agentphone = ($(this).find('phone').eq(2).text()=='')?$(this).find('phone').eq(1).text():$(this).find('phone').eq(2).text();
					var agentInternetAddress = $(this).find('agentInternetAddress').text();
					QRF.agentname = agentname;

					//Agent's information
					var html = "";
					html += "<li><img src=\""+pictureUrl+"\" style=\"width: 70px; height: 100px;\"></li>";
					html += "<li><h3>"+agentname+"</h3></li>";
					html += "<li>"+agentaddress+"</li>";
					html += "<li>"+agentphone.toLowerCase()+"</li>";
					html += "<li><a target='blank' href=\"mailto:"+agentemail+"\">Email</a><br /></li>";
					html += "<li><a target='blank' href=\""+agentInternetAddress+"\">Website</a></li>";
					$("#meetyouragent .agent-location").html(html);
					//Agent's map
					var longlat3 = "http://maps.googleapis.com/maps/api/staticmap?size=435x350&maptype=roadmap\&markers=size:mid%7Ccolor:red%7C"+agentaddress+"&sensor=false";
					$("#meetyouragent_google_map").attr("src",longlat3);
				});

		    });
		},
		  response_value : "", vehicle_error:"",all_vehicle:1,
	power_sports : function(){
		    var select_menu = "", input="";
		    all_vehicle = parseInt(QRF.all_vehicle);
		    for (var i=1; i<=all_vehicle; i++){
		        select_menu = $("#vehicle_"+i+" .select_vehicle").val();
		        input = $("#vehicle_"+i+" .vehicle_input").val();

		        if (select_menu=="" || select_menu=="Select"){
		        	QRF.error = QRF.vehicle_error = "Your must choose vehicle type for vehicle #"+i;
		            break;
		            }else{
		            	QRF.error = QRF.vehicle_error=0;
		              }

		        if (input==""){
		        	QRF.error = QRF.vehicle_error = "Your must enter information for vehicle #"+i;
		            //QRF.warning(QRF.vehicle_error);
		            break;
		            }else{
		            	QRF.error = QRF.vehicle_error=0;
		            }
		        QRF.response_value += select_menu +":"+input+";";
		    }
		    $("#power_q_37").val(QRF.response_value);
		  },//end of Power Sports

		  //load javascript
		  load_js_counter : 0,
		  load_script : function(url, callback){
			  if (QRF.load_js_counter>1){return false;}
			  var script = document.createElement("script")
			    script.type = "text/javascript";

			    if (script.readyState){  //IE
			        script.onreadystatechange = function(){
			            if (script.readyState == "loaded" ||
			                    script.readyState == "complete"){
			                script.onreadystatechange = null;
			                callback();
			            }
			        };
			    } else {  //Others
			        script.onload = function(){
			            callback();
			        };
			    }

			    script.src = url;
			    document.getElementsByTagName("head")[0].appendChild(script);
			    QRF.load_js_counter++;
		  }
};//end of QRF
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
//DOCUMENT

window.onload = function(e) {
	  $('.paging a').click(function(e){
			//if(e.isPropagationStopped()){return;};  //important, check for it!
			e.stopPropagation();

	  });

		  $('.paging-buttons a').live('click', function(e){
			//if(e.isPropagationStopped()){return;};  //important, check for it!
			  var direction = $(this).attr('class');
			  QRF.update_progress_bar();
			  QRF.move(direction);
			  //e.preventDefault();
			  //e.stopPropagation();


	  });


};

/*
$("a").live('click',function(e){
	if(e.isPropagationStopped()) return;  //important, check for it!
	e.stopPropagation();
});
*/
$(document).on('click', 'document' ,function(e){
	if(e.isPropagationStopped()) return;  //important, check for it!
	e.stopPropagation();
});


//selects/unselects the products
$(document).on('click', '.items li' ,function(e){


	//var current_fieldset_name = $('.active').attr('name');
	//if (current_fieldset_name=='tell-us-about-yourself'){return false;}
    var checkbox = $(this).toggleClass('clicked').find(':checkbox');

    if($(this).hasClass('clicked')) {
      checkbox.attr('checked','checked');

    } else {
      checkbox.removeAttr('checked');

    }
    if(e.isPropagationStopped()) return;  //important, check for it!
    //change the plus to check when product is clicked 8/09/2013 JT
    if ($(this).find('span').attr("class")=='uncheck-product'){
    	$(this).find('span').attr("class","check-product");
    }else{
    	$(this).find('span').attr("class","uncheck-product");
    };

 });
$(document).ready(function(e){
		QRF.is_facebook = (QRF.querystring("fbid").length>14)?true:false;



	 	//var fileref=document.createElement('script')
	 	// fileref.setAttribute("type","text/javascript")
	 	// fileref.setAttribute("src", "https://web.amfam.com/site-assets/js/s_code.js")
		//get the Agent from cookies
		QRF.agentID = QRF.cookies('agentID');
		//get the referring url
		QRF.referrer = document.referrer;
		//QRF.is_from_agent = QRF.referrer.indexOf('insurance-agency.amfam.com'); //greater than 1 is true <-- production test
		//QRF.is_from_agent = QRF.referrer.indexOf('af1dev.com/QRF'); //greater than 1 is true <-- dev test
		QRF.is_from_agent = QRF.referrer.indexOf('localhost'); //greater than 1 is true  -> localhost test
		//QRF.fireup_scode();



		if (QRF.is_from_agent>=0){
			QRF.static_slide_num = 4;
		}


		$("<fieldset>").load("tell-us-about-yourself", function() {
			$($(this).html()).insertAfter(".first");
		});


		if ($("#thankyou").length>0){$("#thankyou").load("thankyou");}
		if ($("#findyouragent").length>0){$("#findyouragent").load("findyouragent");}
		if ($("#meetyouragent").length>0){$("#meetyouragent").load("meetyouragent");}

		var qsc =0; //question save counter
		var id2 = "";
		var col_id = 1; //column id for year, make and model for each row (1,2,3)
		$(".page-title").html(""); //remove page title from the first slide
		$(".previous").css("display","none");
		//concatinate the vehicles to all_value variable to save to response_value field in the db


		//July 31, 2013 - JT
		//get car model
		function fetch_car_make(year,lid){
			var mydata = "year="+year;
			$("#make_"+lid).html("<option>Select Make</option>");
			$.ajax({
			    type : 'POST',
			    url :  'Autos/getMake',
			    data : mydata
			}).done(function(msg){
				$("#make_"+lid).html(msg);

		    });
		}
		$(".carquery_year").live('change', function(e){
			var id = $(this).attr("name");
			var pos = id.search('_')+1;
			var lid = id.substring(pos);
			var year =  $(this).find("option:selected").text();
			fetch_car_make(year,lid);
			$("#model_"+lid).html("<option>-----</option>");
		});

		//get car model
		function fetch_car_model(make,year,lid){
			var mydata = "make="+make+"&year="+year;
			$("#model_"+lid).html("<option>Select Model</option>");
			$.ajax({
			    type : 'POST',
			    url :  'Autos/getModel',
			    data : mydata
			}).done(function(msg){
				$("#model_"+lid).html(msg);

		    });
		}

		$(".carquery_make").live('change', function(e){
			var id = $(this).attr("name");
			var pos = id.search('_')+1;
			var lid = id.substring(pos);
			var make =  $(this).find("option:selected").text();
			if (make=='Select Model'){$(".carquery_model").html("<option>-----</option>"); return false; }
			var year =  $("#year_"+lid).find("option:selected").text();
			fetch_car_model(make,year,lid);
		});

		var all_cars ="";
		var car = new Array();
		function fetch_car_validate(lid){
	 		var year = new Array();
	 		var make = new Array();
	 		var model = new Array();
			year[lid] = $("#year_"+lid).find("option:selected").text();
	 		make[lid] =  $("#make_"+lid).find("option:selected").text();
			model[lid] =  $("#model_"+lid).find("option:selected").text();
			car[lid] = year[lid]+" "+make[lid]+" "+model[lid]+";";

			 if(typeof car[lid] === 'undefined'){
				 car[lid] = lid;
			 }
			all_cars=car['1']+car['2']+car['3']+car['4']+car['5'];
			all_cars = all_cars.replace(new RegExp('undefined', 'g'), '');
			$("#autooptions").val(all_cars);
		}
		$(".carquery_model").live('change', function(e){
			var id = $(this).attr("id");
			var pos = id.search('_')+1;
			var lid = id.substring(pos);
			fetch_car_validate(lid);
		});
		//load the vehicle options based on number of vehicle selected
		$("#auto11_options").live('change', function(e){
			QRF.load_auto_options(this.value);
			var id =  $(this).find("option:selected").text();

			if (id==1){
				all_cars=car['1'];
			}
			if (id==2){
				all_cars=car['1']+car['2'];
			}
			if (id==3){
				all_cars=car['1']+car['2']+car['3'];
			}
			if (id==4){
				all_cars=car['1']+car['2']+car['3']+car['4'];
			}
			if (id==5){
				all_cars=car['1']+car['2']+car['3']+car['4']+car['5'];
			}
			if (id==6){
				all_cars=car['1']+car['2']+car['3']+car['4']+car['5'];
			}
			if (id=='Select'){all_cars=''; $("#autooptions6").css("display","none");}

			//all_cars = all_cars.replace(new RegExp('NaN', 'g'), '');
			//all_cars = all_cars.replace(new RegExp('undefined', 'g'), '');
			$("#autooptions").val(all_cars);
		});

		//$("#autooptions6_value").live('change', function(e){
		$('.paging a').live('mouseover', function(e){
			if ($("#autooptions6_value").val()!=''){
			var opt = $("#autooptions").val()+$("#autooptions6_value").val()+";";
			$("#autooptions").val(opt);
			}
		});

		//Business
		$("#question47_y").live('click', function(e){
			$("#q48").fadeIn("slow");
			$("#q48").removeAttr("class");
			e.stopPropagation();
		});
		$("#question47_n").live('click', function(e){
			$("#q48").fadeOut("slow");
			$("#q48 input").val('');
			$("#q48").addClass("hidden_li");
			e.stopPropagation();
		});
		$("#question50_y").live('click', function(e){
			$("#q51").fadeIn("slow");
			$("#q51").removeClass("hidden_li");
			e.stopPropagation();
		});
		$("#question50_n").live('click', function(e){
			$("#q51").fadeOut("slow");
			$("#q51 input").val('');
			$("#q51").addClass("hidden_li");
			e.stopPropagation();
		});
		//Life Insurance
		var life_val = new Array();
		life_val[0]="";life_val[1]="";life_val[2]="";
		$(".term_life").live('click', function(e){
			var checked = $('#life_insurance').attr('checked');
			if (checked){
			life_val[0] = "Term Life Insurance;";
			}else{
				life_val[0] = "";
			}
			$("#life_41").val(life_val[0]+life_val[1]+life_val[2]);

			e.stopPropagation();
		});
		$(".whole_life").live('click', function(e){
			var checked = $('#whole_life_insurance').attr('checked');
			if (checked){
			life_val[1] = "Whole Life Insurance;";
			}else{
				life_val[1] = "";
			}
			$("#life_41").val(life_val[0]+life_val[1]+life_val[2]);
			e.stopPropagation();
		});
		$(".universal_life").live('click', function(e){
			var checked = $('#universal_life_insurance').attr('checked');
			if (checked){
			life_val[2] = "Universal Life Insurance;";
			}else{
				life_val[2] = "";
			}
			$("#life_41").val(life_val[0]+life_val[1]+life_val[2]);
			e.stopPropagation();
		});
		window.onresize = function(){QRF.resize();};
		window.onorientationchange = function(){QRF.resize();};
		if(!$('.screen').hasClass('active')){
			//QRF.load_pages('tell-us-about-yourself',9,'0');
			QRF.slide("", $('.first'));
		};
		var is_this = "";
		var is_zip_ran =0;
		var is_callme = false;
		  $("#callme").live('click', function(e){
			  $("#bestimetocall").fadeIn();
			  $("#ProspectPhoneNumber").attr("required","1");
			  $("#ProspectPhoneNumber").closest("li").addClass("class required");
			  is_callme = true;
			  e.stopPropagation();
		  });
		  $("#nocallme").live('click', function(e){
			  $("#bestimetocall").fadeOut();
			  $("#ProspectPhoneNumber").closest("li").removeClass("required");

			  $("#ProspectPhoneNumber").removeAttr("required");
			  is_callme = false;
			  e.stopPropagation();
		  });
		/*
		 * Navigation
		 */

		  $('.paging a, .btn-get_started a').live('mouseover', function(e){
			  var is_tellus_loaded = $("#tell-us-about-yourself").length;
				if (is_tellus_loaded<=0){
					$("<fieldset>").load("tell-us-about-yourself", function() {
						$($(this).html()).insertAfter(".first");
					});
				}
		  });


			//Jon Toshmatov modified on 8/26/2013

			if (QRF.slide_direction==1){
				e.stopPropagation();
				QRF.update_omniture_tags();

			}


		  //update the product list when mouseover
		  $('.paging a, .btn-get_started a').live('mouseover', function(e){

			  var direction = $(this).attr('class');
			  var current_fieldset_name = $('.active').attr('name');
			if(current_fieldset_name=='select' && direction=='next'){
				QRF.update_products_ids();
			}
			if(current_fieldset_name=='power'){
				//QRF.warning(QRF.error);
				//return false;
				QRF.power_sports();
				$("#power_q_37").val(QRF.response_value);
			}
		  });
		  var cid = "";
		  var pcid ="";

		  $('.paging a').bind('click', function(e){
			  return false;

			  /*
			  e.stopPropagation();
			var direction = $(this).attr('class');
			var current_fieldset_name = $('.active').attr('name');
			if (current_fieldset_name=='select'){
				QRF.load_products(direction, QRF.ins_before);
				}
				*/
		  });

		$('.paging a, .btn-get_started a, #submit_qrf').bind('click', function(e){

			e.preventDefault();
			cid = $('.active').next().attr('name');
			pcid = $('.active').attr('name');
			//Placeholder IE fix - Chanda
			var inputs = $('.lt-ie9 div.form-container input[placeholder], .ie-later div.form-container input[placeholder]');
            fixPlaceholders(inputs);
			var direction = $(this).attr('class');
			var next_fieldset_name = $('.active').next().attr('name');
			var previous_fieldset_name = $('.active').prev().attr('name');
			var current_fieldset_name = $('.active').attr('name');
			var cf = $('.active').index();
			var checked = $("#first input:checked");
			var l = checked.length;
			//	in case if they want the power fields required, just uncomment these lines
			if(current_fieldset_name=='power'){
				//QRF.warning(QRF.error);
				//return false;
				$("#power_q_37").val(QRF.response_value);
			}
			QRF.update_page_title(direction); //update title
			//social media, agency and etc
			//if both cookie and referrer exist
			//update line 540-545 as well
			//if (previous_fieldset_name=='select' && QRF.slide_direction==1 && QRF.is_from_agent>=0 && QRF.agentID!=false){
			if (previous_fieldset_name=='select' && QRF.slide_direction==1 && QRF.is_from_agent>=0){
				//alert("Both cookie and Agent exist");
				$("#meetoyouragent .different_agent").css("display","none");
				if ($("#findyouragent").length>0){$("#findyouragent").remove();}
				QRF.update_progress_bar();
				QRF.load_agent();
			}

			if (previous_fieldset_name=='select' && QRF.slide_direction==1 && QRF.is_facebook==true){
				$("#meetoyouragent .different_agent").css("display","none");
				if ($("#findyouragent").length>0){$("#findyouragent").remove();}
				QRF.update_progress_bar();
				QRF.load_facebook(QRF.querystring("fbid"),"facebook");

			}

			//Medical


			//if only cookie exists
			if (previous_fieldset_name=='first' && QRF.slide_direction==1 && QRF.is_from_agent<0 && QRF.agentID!=false){
				//alert("Both cookie but Agent does exist");
				$("#meetoyouragent .different_agent").css("display","none");
				if ($("#findyouragent").length>0){$("#findyouragent").remove();}
				QRF.update_progress_bar(4);
			}
			if (current_fieldset_name=='meetyouragent'){
				var da = $("#different_agent").attr("id");

			}


			if (next_fieldset_name=='meetyouragent' && QRF.slide_direction==1){
				$(".paging .next").css("display","none");
			}else{
				$(".paging .next").fadeIn("fast");
			}
			if (next_fieldset_name=='meetyouragent'){
				$(".paging .next").css("display","none");
			}
			if (current_fieldset_name=='select' && l<1){//at least one product must be selected
				QRF.warning("Please select your product.");
				return false;
			}
			if ($("#findyouragent").length>0){
				QRF.ins_before = "findyouragent";
				}else{
					QRF.ins_before = "meetyouragent";
				}
			if (current_fieldset_name=='select'){
			QRF.load_products(direction, QRF.ins_before);
			}
			//it is currently saving only on next to avoid some functional conflicts.
			QRF.save_data(direction,e);
			//QRF.move(direction);
			QRF.slide_direction = (direction=='next')?1:0;

			if ($("#findyouragent").length>0 && next_fieldset_name=='findyouragent'){
				var ProspectZipcode = $("#ProspectZipcode").val();
				$("#zipcode").val(ProspectZipcode);

				is_this = "findyouragent";
				//initialize();//initialize populating the map
			}
			//refresh the products list when prospect re-select or unselect
			if(current_fieldset_name=='select' && direction=='next'){
				QRF.update_products_ids();
				$(".warning").css("display","none");
			}
			if (previous_fieldset_name=='select'){
				//ProspectZipcode
				if (QRF.zipcode=='' && $("#ProspectZipcode").val()!=''){
					QRF.zipcode = $("#ProspectZipcode").val();
				}else{
					if (QRF.zipcode==$("#ProspectZipcode").val()){
						QRF.trigger_find_agent =0;
					}else{
						//trigger the finding an agent script here.
						QRF.trigger_find_agent =1;
						QRF.zipcode=$("#ProspectZipcode");
					}
				}

			}
			if ($("#findyouragent").length>0 && current_fieldset_name=='findyouragent'){
				if ($(".sidebarAgentName").text().length<=0 && QRF.slide_direction==1){
					QRF.warning("Please enter your ZIP code and click to find, then select your agent.");
					return false;
				}

				if ($("#agentname").text().length>0 && QRF.slide_direction==1){
				QRF.meet_your_agent();
				}
				if ($("#agentname").text().length<=0 && QRF.slide_direction==1){
					QRF.warning("Please select your agent from the list.");
					return false;
				}
			}
			if (next_fieldset_name=='thankyou'){
				var agentname = $("#agentname").text();
				var agentaddress = $("#agentaddress").text();
				var agentphone = $("#agentphone").text();
				var agentsite = $("#agentsite").text();
				var email = $("#agentemail").text();
				var firstname = $("#ProspectFirstName").val();
				var lastname = $("#ProspectLastName").val();
				//$("#prospect_full_name").html("Thank you "+firstname+" "+lastname+"!");
				$("#prospect_full_name").html("Thank you "+firstname+"!"); //08/09/2013
				var url = $("#agentsite a").attr("href");
				var agentname = "<h3>"+$("#agentname").text()+"</h3>";
				var name = agentname;
				var address = "<span class=\"agent-office-location\">Office Location:</span>"+agentaddress+"";
				var phone = "<span class=\"agent-office-phone\"><a href='tel:"+agentphone+"'>"+agentphone+"</a></span><br/>";
				var agentemail = "<span class=\"agent-office-email\"><a href=\"mailto:"+email+"\">"+email+"</a></span>";
				$("#thankyou-agent-website").attr("href",agentsite);

				if (QRF.is_facebook==true){
					$("#agentinformation").html(QRF.agentinformation);
				}else{
					$("#agentinformation").html(name+address+phone+agentemail);
				}
			}else{
				//$(".paging").css("display","block");
			}
			if (next_fieldset_name=='thankyou' && QRF.slide_direction==1){
				$(".paging").fadeOut();
			}
			if (current_fieldset_name=='tell-us-about-yourself' && direction=="next"){
				//first name
				if ($("#ProspectFirstName").val()=='First Name' || $("#ProspectFirstName").val().length<1){
					QRF.warning("Please enter your first name");
					$(".required").css("display","block");
					return false;
				}
				//last name
				if ($("#ProspectLastName").val()=='Last Name' || $("#ProspectLastName").val().length<1){
					QRF.warning("Please enter your last name");
					return false;
				}
				//zipcode
				var zip = ($("#ProspectZipcode").val()!="")?parseInt($("#ProspectZipcode").val()):"";
				if (zip.length<6 || zip==''){
						QRF.warning("Please enter your ZIP code");
						return false;
				}
				if (!$.isNumeric(zip)){
					QRF.warning("Your ZIP code is in the wrong format.");
					return false;
				}

				if ($("#ProspectZipcode").val().length<5){
					QRF.warning("Your ZIP must be 5 numbers long.");
					return false;
				}
				//email
				var email = $("#ProspectEmailAddress").val();
				if (email =='E-mail Address' || email=='' || email.length<5){
					QRF.warning("Please enter a valid email address.");
					return false;
				}
				if (!QRF.is_email(email)){
					QRF.warning("Please enter a valid email address.");
					return false;
				}
				//set language in the tell-us based on the url
				  var lang = QRF.domain.search("latino");
				  if (lang>0){
					  //change the language on tell-us to Spanish
					  $("#ProspectLanguageId").val(2);
				  }else{
					  //default language is English
					  $("#ProspectLanguageId").val(1);
				  }

				  //call me best time
				  if (is_callme){
					  if ($("#ProspectPhoneNumber").val().length<10){
						  QRF.warning("Please enter your phone number");
						  return false;
					  }
				  }
				QRF.save_tell_us();
				QRF.is_promotion_on==1;
}//end of if tell-us required fields
				QRF.update_progress_bar();
				QRF.move(direction);

				if (previous_fieldset_name=='select' && QRF.slide_direction==1 && QRF.is_from_agent==-1 && QRF.is_facebook==false){
					if (QRF.trigger_find_agent ==1 || is_zip_ran==0){
						var zip = $("#ProspectZipcode").val();
						zip = parseInt(zip);
						initialize();
						submitform(zip,'tell-us');
						is_zip_ran =1;
						QRF.zipcode = zip;
					}
					}
				//send email to Agenta and prospect when QRF is completed
				//08/06/2013 Jon Toshmatov
				if (current_fieldset_name=='meetyouragent' && direction=="next"){
					QRF.build_email_responses();
					var prospect_first_name = $("#ProspectFirstName").val();
					var prospect_last_name = $("#ProspectLastName").val();
					var prospect_email = $("#ProspectEmailAddress").val();
					var prospect_agent = QRF.agentname;
					var prospect_phone = $("#ProspectPhoneNumber").val();
					var prospect_state = $("#ProspectStateId").val();
					var prospect_zip = $("#ProspectZipcode").val();
					var agent_id = $("#agentid").text();
					$("#thankyou .warningclass").html("<p><img src='img/wait.gif'><br />Please wait while we are sending your request to your agent</p>");
					QRF.data = "agent_id="+agent_id+"&prospect_zip="+prospect_zip+"&prospect_state="+prospect_state+"&prospect_phone="+prospect_phone+"&pid=QRF"+QRF.prospect_id+"&prospect_first_name="+prospect_first_name+"&prospect_last_name="+prospect_last_name+"&prospect_email="+prospect_email+"&prospect_agent="+prospect_agent+"&responses="+QRF.email_responses;
					QRF.submitomniture("wait");
					$.ajax({
					    type : 'POST',
					    //url :  'promotions/email',
					    url :  'email/save',
					    data : QRF.data
					}).done(function(msg){
						if (msg=='saved'){
							$.ajax({
							    type : 'POST',
							    //url :  'promotions/email',
							    url :  'email/send',
							    data : QRF.data
							}).done(function(msg){
								$("#thankyou .warningclass").fadeOut("slow");
								QRF.submitomniture("thankyou");
							});
						}
						return false;
					});
				}

		e.preventDefault();
		e.stopPropagation();
		return false;
		});//end of pagging
		function send_incomplete_email(){
			QRF.build_email_responses();
			var prospect_name = $("#ProspectFirstName").val()+" "+$("#ProspectLastName").val();;
			var prospect_email = $("#ProspectEmailAddress").val();
			var prospect_agent = QRF.agentname;
			var prospect_phone = $("#ProspectPhoneNumber").val();
			var prospect_state = $("#ProspectStateId").val();
			var prospect_zip = $("#ProspectZipcode").val();
			QRF.data = "prospect_zip="+prospect_zip+"&prospect_state="+prospect_state+"&prospect_phone="+prospect_phone+"&pid=QRF"+QRF.prospect_id+"&prospect_name="+prospect_name+"&prospect_email="+prospect_email+"&prospect_agent="+prospect_agent+"&responses="+QRF.email_responses;
			$.ajax({
			    type : 'POST',
			    url :  'promotions/email',
			    //url :  'email/save',
			    data : QRF.data
			}).done(function(msg){
				//alert("done");
			});

		}


		$("#question14_y").live('click', function(e){
			$("#teenssavedriver").fadeIn("slow");
			e.stopPropagation();
		});
		$("#question14_n").live('click', function(e){
			$("#teenssavedriver").fadeOut("slow");
			e.stopPropagation();
		});
		$("#question15_y").live('click', function(e){
			$("#question_16").fadeIn("slow");
			e.stopPropagation();
		});
		$("#question15_n").live('click', function(e){
			$("#question_16").val('');
			$("#question_16").fadeOut("slow");
			e.stopPropagation();
		});
		var inp="";
		$("#question37_select").live('change', function(e){
			if ($("#question37_select").val()=='Select'){
			return false;
			}
			inp = $("#question38_input").val()+this.value+":\n";
			$("#question38_input").val(inp);
			e.stopPropagation();
		});
		//validate every input fields tell us slide
		$("#ProspectFirstName, #ProspectLastName").live('change', function(e){
		    text = this.value.replace(/[^a-zA-Z-,.\s]/g, "");
		    if(/_|\s/.test(text)) {
			        text = text.replace(/_|/g, "");
			    }
			    this.value =text;
		});
		$("#ProspectAddress, #ProspectCity").live('change', function(e){
		    text = this.value.replace(/[^a-zA-Z0-9-_,:.\s]/g, "");
		    if(/_|\s/.test(text)) {
			        text = text.replace(/_|/g, "");
			    }
			    this.value =text;
		});
		$(".numbersonly").live('change', function(e){
		    text = this.value.replace(/[^0-9\s]/g, "");
		    if(/_|\s/.test(text)) {
			        text = text.replace(/_|/g, "");
			    }

		    if (text<0 || text>3000){
		    	text = 1;
		    }
			    this.value =text;
		});
		$(".yearonly").live('change', function(e){
		    text = this.value.replace(/[^0-9\s]/g, "");
		    if(/_|\s/.test(text)) {
			        text = text.replace(/_|/g, "");
			}
		    if (text<1700 || text>2050){
		    	text = '';
		    }
			    this.value =text;
		});
		$(".url").live('change', function(e){
			//./,?!@#$%&*()-_=+\;:
			text = this.value.replace(/[^a-zA-Z0-9./,\?!@#$%&*()-_=+\;:\//~\s]/g, "");
		    if (text<0 || text>20){
		    	text = 1;
		    };
			    this.value =text;
		});


		//validate every input fields in reponses $('input:enabled')

		$(".items li").live('click', function(e){
			var text = $(this).find("input").val();
			text = (text!='')?"Yes":"No";
			var product = $(this).closest("fieldset").attr("id");
			if (product=='first'){return false;}
			var label = $(this).find("label").text();
			QRF.copy_inputs(label,text,product);
			e.stopPropagation();
		});

		$(".items li textarea").live('change', function(e){
			var text = $(this).find("input").val();
			var product = $(this).closest("fieldset").attr("id");
			var label = $(this).find("label").text();
			QRF.copy_inputs(label,text,product);

		});



		$("fieldset li select").live('change', function(e){
			var text = $(this).val();
			var product = $(this).closest("fieldset").attr("id");
			var label = $(this).parent().find("label").text();
			QRF.copy_inputs(label,text,product);
		});

		$("fieldset li input").live('change', function(e){
			var text = $(this).val();
			var product = $(this).closest("fieldset").attr("id");
			if (product=='tell-us-about-yourself'){return false;}
			var label = $(this).parents().find("label").first().text();
			QRF.copy_inputs(label,text,product);
		});



		$("fieldset li input[type=text], textarea").live('change', function(e){
			var text = $(this).val();
			var product = $(this).closest("fieldset").attr("id");
			if (product=='tell-us-about-yourself'){return false;}
			var label = $(this).parent().find("label").text();
			QRF.copy_inputs(label,text,product);
		});

		/*
		$("#umbrella li input,#farm li input,#auto li input,#renters li input,#homeowners li input,#life li input,#power li input,#business li input,#travel li input,#medical li input").live('change', function(e){
		   var url = $(this).attr("class");
		  if (url=='url'){return false;}
			text = this.value.replace(/[^a-zA-Z0-9-_,.\s]/g, "");
		    if(/_|\s/.test(text)) {
			        text = text.replace(/_|/g, "");
			    }
			    this.value =text;
			    var label = $(this).siblings("label").text();
			    label = (label=="")?$(this).parent().parent().find('label').text():label;
			    var product = $(this).closest("fieldset").attr("id");
			    QRF.copy_inputs(label,text,product);
		});
		//textarea validation
		$("#umbrella li textarea,#farm li textarea,#auto li textarea,#renters li textarea,#homeowners li textarea,#life li textarea,#power li textarea,#business li textarea,#travel li textarea,#medical li textarea").live('change', function(e){
		    text = this.value.replace(/[^a-zA-Z0-9-_:,.\s]/g, "");
		    if(/_|\s/.test(text)) {
			        text = text.replace(/_|/g, "");
			    }
			    this.value =text;
			    var label = $(this).siblings("label").text();
			    label = (label=="")?$(this).parent().parent().find('label').text():label;
			    var product = $(this).closest("fieldset").attr("id");
			    QRF.copy_inputs(label,text,product);
		});
		*/

		//ZIP code validation
		$("#ProspectZipcode").live('change', function(e){
		    text = this.value.replace(/[^0-9]/g, "");
		    if(/_|\s/.test(text)) {
			        text = text.replace(/_|\s/g, "");
			    }
			    this.value =text;
		});
		//Phone code validation
		$("#ProspectPhoneNumber").live('change', function(e){
		    text = this.value.replace(/[^0-9-]()- /g, "");
		    if(/_|\s/.test(text)) {
			        text = text.replace(/_|\s/g, "");
			    }
			    this.value =text;
		});
		//Medical / Dental Question 54
		var medical_val = new Array();
		medical_val[0]="";medical_val[1]="";medical_val[2]="";
		$(".health").live('click', function(e){
			var checked = $('#medical54_health').attr('checked');
			if (checked){
			medical_val[0] = "";
			}else{
				medical_val[0] = "Health Insurance;";
			}
			$("#medical54_response").val(medical_val[0]+medical_val[1]+medical_val[2]);
			e.stopPropagation();
		});
		$(".dental").live('click', function(e){
			var checked = $('#medical54_dental').attr('checked');
			if (checked){
			medical_val[1] = "";
			}else{
				medical_val[1] = "Dental Insurance;";
			}
			$("#medical54_response").val(medical_val[0]+medical_val[1]+medical_val[2]);
			e.stopPropagation();
		});
		$(".medicare_supplement").live('click', function(e){
			var checked = $('#medical54_medicare').attr('checked');
			if (checked){
			medical_val[2] = "";
			}else{
				medical_val[2] = "Medicare Supplement Plus;";
			}
			$("#medical54_response").val(medical_val[0]+medical_val[1]+medical_val[2]);
			e.stopPropagation();
		});
		//Travel Insurance
		var travel_val = new Array();
		travel_val[0]="";travel_val[1]="";travel_val[2]="";
		$(".trip_cancellation").live('click', function(e){
			var checked = $('#travel52_cancel').attr('checked');
			if (checked){
			travel_val[0] = "";
			}else{
				travel_val[0] = "Trip Cancellation Insurance;";
			}
			$("#travel52_response").val(travel_val[0]+travel_val[1]+travel_val[2]);
			e.stopPropagation();
		});
		$(".global_medical").live('click', function(e){
			var checked = $('#travel52_medical').attr('checked');
			if (checked){
			travel_val[1] = "";
			}else{
				travel_val[1] = "Global Medical Insurance;";
			}
			$("#travel52_response").val(travel_val[0]+travel_val[1]+travel_val[2]);
			e.stopPropagation();
		});
		$(".mexico_auto").live('click', function(e){
			var checked = $('#travel52_mexico').attr('checked');
			if (checked){
			travel_val[2] = "";
			}else{
				travel_val[2] = "Mexico Auto Insurance;";
			}
			$("#travel52_response").val(travel_val[0]+travel_val[1]+travel_val[2]);
			e.stopPropagation();
		});
		//Umbrella Insurance
		var umbrella_val = new Array();
		umbrella_val[0]="";umbrella_val[1]="";umbrella_val[2]="";
		$(".personal_liability").live('click', function(e){
			var checked = $('#umbrella61_personal').attr('checked');
			if (checked){
			umbrella_val[0] = "";
			}else{
				umbrella_val[0] = "Personal Liability Umbrella Insurance;";
			}
			$("#umbrella61_response").val(umbrella_val[0]+umbrella_val[1]+umbrella_val[2]);
			e.stopPropagation();
		});
		$(".commercial_liability").live('click', function(e){
			var checked = $('#umbrella61_commercial').attr('checked');
			if (checked){
			umbrella_val[1] = "";
			}else{
				umbrella_val[1] = "Commercial Liability Umbrella Insurance;";
			}
			$("#umbrella61_response").val(umbrella_val[0]+umbrella_val[1]+umbrella_val[2]);
			e.stopPropagation();
		});
		$(".farm_liability").live('click', function(e){
			var checked = $('#umbrella61_farm').attr('checked');
			if (checked){
			umbrella_val[2] = "";
			}else{
				umbrella_val[2] = "Farm/Ranch Liability Umbrella Insurance;";
			}
			$("#umbrella61_response").val(umbrella_val[0]+umbrella_val[1]+umbrella_val[2]);
			e.stopPropagation();
		});
		$("#different_agent").live('click', function(e){
			e.preventDefault();

			$(".paging .next").fadeIn("fast");

			if ($("#findyouragent").length<=0){return false;}
			QRF.slide_direction = (direction=='next')?1:0;
			var direction = $(this).attr('class');
			var zipcode = parseInt($("#ProspectZipcode").val());

			if ($("#findyouragent").length>0 && QRF.ins_before=="meetyouragent"){
				$("<fieldset name='findyouragent' class='screen' id='findyouragent'></fieldset>").insertBefore("#meetyouragent");
				$("#findyouragent").load("findyouragent?zipcode="+zipcode);
				QRF.static_slide_num = 5;
				QRF.update_progress_bar();
			}
			if (QRF.is_from_agent>=0){
				$("#zipcode").val(zipcode);
				submitform(zipcode,'meetyouragent');
			}
			QRF.update_progress_bar();
			QRF.move(direction);
			e.stopPropagation();
		});


		//When does your policy expire? slides: Business
		$(".havepolicy input").live('click', function(e){
			var fld = $(this).closest('fieldset').attr("id");
			var val = $(this).val();
			if (val=="Yes"){
				$("#"+fld+" .havepolicy2").fadeIn("fast");
			}else{
				$("#"+fld+" .havepolicy2").fadeOut("fast");
			};
			e.stopPropagation();
		});

		//Disable the enter key by Jon Toshmatov 5/14
	  $(function () {
		   $('form').bind("keypress", function (e) {
		              if (e.keyCode == 13) return false;
		              e.stopPropagation();
		          });
		   var inputs = $('.lt-ie9 div.form-container input[placeholder],.ie-later div.form-container input[placeholder]');
           fixPlaceholders(inputs);
	  });


	// IE Placeholder fix part I
	  function fixPlaceholders(inputs){

	                  function resetInputToPlaceholder(e){
	                                  var $input = $(e);
	                                  var placeholder = $input.attr('placeholder');
	                                  if ($input.val() == '' && placeholder != ''){
	                                                  $input.val(placeholder);
	                                  };
	                  };

	                  if (inputs != null && inputs.length > 0){
	                                  for(i=0;i<inputs.length; i++){
	                                                  resetInputToPlaceholder(inputs[i]);
	                                  };
	                                  inputs.focus(function(){
	                                                  var $this = $(this);
	                                                  if ($this.val() === $this.attr('placeholder')){
	                                                                  $this.val('');

	                                                  };

	                                  });
	                                  inputs.blur(function(){
	                                                  if($(this).val() == '')
	                                                    resetInputToPlaceholder(this);
	                                  });
	                  };
	  };

	  //IE placeholder fix part II
	  $(function(){
		  var inputs = $('.lt-ie9 div.form-container input[placeholder], .ie-later div.form-container input[placeholder]');
          fixPlaceholders(inputs);
	  });

	  //Power Sports
	  var q37 = $("#question37_select").val();
	  var increment=2;

	  //add vehicle
	  $("#add_vehicle").live('click', function(e){
	  	  e.preventDefault();
	  if (increment>=5){$("#add_vehicle").fadeOut("fast");}
	  if (increment>5){$("#add_vehicle").fadeOut("fast");return false;}
	  total = $(".powervehicles").last().attr("id");
	  var lastli = $(".powervehicles").last().attr("id");//last vehicle id
	  var pos = lastli.search('_')+1;
	  var id = parseInt(lastli.substring(pos))+1;
	  var clone = $("#"+lastli).clone();
	  $(clone).clone().attr('class','powervehicles').attr("id","vehicle_"+id).insertAfter("#"+lastli);//clone the vehicle
	  $(".del_vehicle").last().attr("id","delete_vehicle_"+id);//assign id for delete button for each vehicle
	  $("#delete_vehicle_"+id).show();
	  $("#vehicle_"+id+" .vehicle_input").val('');//clear the input for new vehicles
	  increment++;
	  QRF.all_vehicle++;
	  e.stopPropagation();
	  });

	  //delete the vehicles
	  $(".del_vehicle").live('click', function(e){
	  	  e.preventDefault();
	      var lastli = $(".powervehicles").last().attr("id");
	      button = $(this).attr("id");
	      var pos = button.search('_')+1;
		  var id = button.substring(pos);

	      if ($("#"+id).attr("id")=="vehicle_1"){
	          return false;
	      }
	      if (increment>1){
	             $("#"+id).remove();  //modify this if you want to delete the particular vehicle from lastli to id
	             increment--;
	             QRF.all_vehicle--;
	             $("#add_vehicle").fadeIn("fast");
	      };
	      e.stopPropagation();
	  });

	  //before exiting the window JT 08/12/2013
	  //QRF.form_name : $('.forms').attr('name')
	  exit_qrf();
	  function exit_qrf(){
		   $(window).bind("beforeunload", function() {
				  if (cid!='thankyou' && cid!=''){
					   //send_incomplete_email();
					   //var conf = confirm("Are you sure you want to leave the form?");
					   //alert("Sorry you have not completed the form \n I hope you will come back again \n Thanks for visiting QRF!");
				  }
			  });
		   };


//##################################################################################################################################################
});//end of document load