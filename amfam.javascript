var QRF = {
		/*
		 * Company: American Family Insurance
		 * Department: Web Experience Unit 2
		 * Project Manager: Robyn Chase
		 * Developer: Jon Toshmatov
		 * Created: February 26, 2013
		 * Last Modified: April 1 2015 10:00am Nick R		 *
		 * All the major variables are declared here
		 * A variable can be called with QRF.varname and set QRF.varname = ''
		 * most of the vars are used for counters		 *
		 */
		previous_id : $('.active').prev().attr('id'),
		current_id : $('.active').attr('id'),
	 	current : $('.active'),
		prospect_id : null,
		last_id : $('form').last().attr('id'),
		total_fieldsets : $('form').index(),
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
		agent_email :'',agent_id : '',agent_site : '', host : $("#host").val(), omn_check : 0,
		mi : 0,language : 'en',
		//*******************************************************************//
		is_numeric : function(num){
			   return typeof num === 'number' && isFinite(num);
		},
		//*******************************************************************//
		is_email : function(email){
			  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,1})+$/;
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
				//QRF.update_questions_ids(msg);
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
		       		s.eVar3 =s.transactionID="QRF"+pid;
		       		$("#reference_number").html("Reference Number: QRF"+pid);
		    });
		},
		//*******************************************************************//
		update_products_ids : function (){
			var checked = $("#first input:checked");
			QRF.products_check_list = checked;
			var l = checked.length;
			QRF.data = "";
			for(var i=0;i<l; i++){
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
				title = "Welcome";
			}
			if(id=='thankyou'){
				title = "Thank You";
			}
			 var title_exists = document.title.match(/^QRF:/);

		 if (title_exists==null){
			 document.title = "QRF:"+title;
		 }else{
			 document.title = "QRF:"+title;
		 }
			QRF.s_code_counter++;
		},

		//*******************************************************************//
		save_data : function (direction){
			var id = $('.active').attr('id');

			//hide progress bar, previous button on first slide
			//use visibility vs display to prevent slides and prev button, progress bar from jumping up&down
			if (direction=='previous' && id =='tell-us-about-yourself'){
				$('#progress-bar').css("visibility","hidden");
				$(".previous").css("display","none");
            } else {
                $('#progress-bar').css("visibility","visible");
            }

			switch (id){
			case 'first':
				QRF.update_products_ids();
				$(".previous").fadeIn("fast");
				QRF.update_omniture_tags("first");
				s.t();
				break;
			case 'tell-us-about-yourself':
				QRF.update_omniture_tags("tell-us-about-yourself");
				break;
			case 'auto':
				QRF.save_questions('auto');
				QRF.update_omniture_tags("auto");
				break;
			case 'business':
				QRF.save_questions('business');
				QRF.update_omniture_tags("business");
				break;
			case 'farm':
				QRF.save_questions('farm');
				QRF.update_omniture_tags("farm");
				break;
			case 'life':
				QRF.save_questions('life');
				QRF.update_omniture_tags("life");
				break;
			case 'medical':
				QRF.save_questions('medical');
				QRF.update_omniture_tags("medical");
				break;
			case 'travel':
				QRF.save_questions('travel');
				QRF.update_omniture_tags("travel");
				break;
			case 'renters':
				QRF.save_questions('renters');
				QRF.update_omniture_tags("renters");
				break;
			case 'homeowners':
				QRF.save_questions('homeowners');
				QRF.update_omniture_tags("homeowners");
				break;
			case 'power':
				QRF.save_questions('power');
				QRF.update_omniture_tags("power");
				break;
			case 'umbrella':
				QRF.save_questions('umbrella');
				QRF.update_omniture_tags("umbrella");
				break;
			case 'meetyouragent':
				QRF.is_promotion_on = 0;
				QRF.update_omniture_tags("meetyouragent");
				console.log("213 case meetoyouragent");
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
		previousPos : "-180%",
		nextPos : "120%",
		slide : function(currentScreen, moveScreen, slideScreen){
			//Added by Jon Toshmatov on 11/22/2013 at 7:50 AM
			var slide = $('.active').attr('name') || 'none';
			if (QRF.host=='qrf.amfam.com' || QRF.host=='localhost'){
				if (slide!='none' && slide!='select' && slide!='meetyouragent'){
					s.t();
				}
			}

			if(isAndroid()) {
				if(moveScreen != ""){
					currentScreen.removeClass('active').css("left", moveScreen);
                    $(currentScreen).hide();
				}
                $(slideScreen).show();
				$(slideScreen).addClass('active').css("left", QRF.getX());
				$('html, body').animate({scrollTop: '0px'}, 400);
			}

			else {
				if(moveScreen != ""){
					currentScreen.removeClass('active').animate({
						left: moveScreen }, 1000).animate({
                        display: 'none' }, 1000);
                    //$(currentScreen).hide();
				}
                $(slideScreen).show();
				$(slideScreen).addClass('active').delay(500).animate({
							left: QRF.getX(), display: 'inline'}, 1000);
				$('html, body').delay(1400).animate({scrollTop: '0px'}, 400);
			}

			var current_fieldset_name = $('.active').attr('name');

			if (current_fieldset_name == "meetyouragent"){
				$(".paging .next").css("visibility","hidden");
			}else{
				$(".paging .next").css("visibility","visible");
			}
			if (current_fieldset_name == "thankyou"){
				$(".paging .next").css("visibility","hidden");
				$(".paging .previous").css("visibility","hidden");
			}

		},
		move : function(direction){
			QRF.slide_count++;
			var moveScreen = (direction ==  'next') ? QRF.previousPos : QRF.nextPos;
			var slideScreen = (direction ==  'next') ? $('.active').next('.screen') : $('.active').prev('.screen');
			if(($('.active').hasClass('last') && direction == 'next') || ($('.active').hasClass('first') && direction == 'previous')){
				return false;
			} else {
				QRF.slide($('.active'),moveScreen,slideScreen);
				QRF.update_omniture_tags($(slideScreen).attr('name'), slideScreen);
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
		load_slides : function(slide,url){
            $.ajax({
                url: url,
                context: document.body
            }).done(function(data) {
                $( '#'+slide ).html( data );
            });

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
			var id ="";
			var slide = "";
			var thankyou_products = new Array();
			QRF.all_selected = [];
			for(var i=0;i<l; i++){
				QRF.all_selected[i]=checked[i].name;
					thankyou_products[i] = checked[i].value;
		 	}
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
                    $("<form name='"+checked_all[i].name+"' class='screen' id='"+checked_all[i].name+"'>"+checked_all[i].name+"</form>").insertBefore("#"+ins_slide);
					slide = checked_all[i].name;
					url = checked_all[i].name+"?data="+checked_all[i].value;
					QRF.load_slides(slide, url);
				}

			}//end for loop
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
		agentname : '',
		//*******************************************************************//
		meet_your_agent : function (){
			var data = {};
			data['agentimage'] = $("#agentlist .sidebarAgentDivFocus .picturediv").text();
			data['agentname'] = $("#agentlist .sidebarAgentDivFocus .sidebarAgentName").text();
			QRF.agent_id = $("#agentlist .sidebarAgentDivFocus #agentid").text();
            var agentaddress = agentList[$("#agentlist .sidebarAgentDivFocus").index()]['address'];
			data['agentaddress'] = agentaddress[0]+",<br />"+agentaddress[1]+", "+agentaddress[2]+"<br />"+agentaddress[3];
			data['agentphone'] = $("#agentlist .sidebarAgentDivFocus .sideBarPhoneDiv").text();
			data['agentsite'] = $("#agentlist .sidebarAgentDivFocus #agentsite").html()+"&tid=ap99";
			data['agentemail'] = $("#agentlist .sidebarAgentDivFocus #agentemail").text();
			QRF.agentemail = QRF.agent_email = data['agentemail'];
			QRF.agentname = data['agentname'];
			var html = "";
			html += "<li><img src='"+data['agentimage']+"' style='width: 70px; height: 100px;'></li>";
			html += "<li><h3>"+data['agentname']+"</h3></li>";
			html += "<li> "+data['agentaddress']+" </li>";
			html += "<li><a href='tel:+1-"+data['agentphone']+"'>"+data['agentphone']+"</a></li>";
			$("#meetyouragent .agent-location").html(html);
			var longlat1 = $('#map_canvas a[href^="http://maps.google.com/maps"]').attr("href");
			var longlat1 = longlat1.replace("http://maps.google.com/maps?ll=","");
			var pos = longlat1.indexOf("&");
			var longlat1 = longlat1.substring(0,pos);
			var zip = $("#zipcode").val();
			QRF.agentname = data['agentname'];

			$("#ProspectAgentname").val(QRF.agentname);
			$("#ProspectAgentFacebook").val(QRF.querystring("fbid"));
			$("#ProspectAgentEmailAddress").val(QRF.agentemail);
			if (QRF.agent_id.length==3){QRF.agent_id = "000"+QRF.agent_id;}
			if (QRF.agent_id.length==4){QRF.agent_id = "00"+QRF.agent_id;}
			if (QRF.agent_id.length==5){QRF.agent_id = "0"+QRF.agent_id;}
			$("#ProspectAgentid").val(QRF.agent_id);
			$("#ProspectStatus").val(0);
			/*
			 * The Google map API is subject to Google terms and condition. Please go to URL below for limit and usage agreement
			 * https://developers.google.com/maps/documentation/staticmaps/
			 */
            agentaddress = data['agentaddress'].replace("#", "");

			var longlat2 = "https://maps.googleapis.com/maps/api/staticmap?size=435x350&maptype=roadmap\&markers=size:mid%7Ccolor:red%7C"+agentaddress+"&sensor=false";
			$("#meetyouragent_google_map").attr("src",longlat2);
		},
		warning : function (msg){
			if (msg==''){return false;}
			$(".warning").html("<h3>"+msg+"</h3>");
			$('.warning').fadeIn().delay(3000).fadeOut('slow');
		},
		//*******************************************************************//
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
		sproducts : [],
		fallout : [],
		get_products_for_omniture : function(slide){
			s.products= QRF.fallout;
			var checked = $("#first input:checked");

            $('.clicked').each(function(){
				if (typeof $(this).children('input').attr('data-product') != "undefined" && $(this).children('input').attr('data-product')!='undefined'){ //fix by Jon Toshmatov 11/20
				var obj = ";["+$(this).children('input').attr('data-product')+"]";
				if($.inArray(obj, s.products) == -1)
					s.products.push(obj);
				}
			});
			QRF.fallout = s.products;
			return QRF.fallout;
        },
        //*******************************************************************//
        product_on_fly : function(slide){
            var obj = ";["+$("#first input[name='"+slide+"']").attr('data-product')+"]";
            if($.inArray(obj, QRF.sproducts) == -1)
                QRF.sproducts.push(obj);
            return QRF.sproducts + "|["+QRF.fallout.length+"]";
        },
        states : { 0 : '',
                1 : 'AZ',
                2 : 'AL',
                3 : 'AR',
                4 : 'AK',
                5 : 'CA',
                6 : 'CO',
                7 : 'CT',
                8 : 'DE',
                9 : 'FL',
                10 : 'GA',
                11 : 'HI',
                12 : 'ID',
                13 : 'IL',
                14 : 'IN',
                15 : 'IA',
                16 : 'KS',
                17 : 'KY',
                18 : 'LA',
                19 : 'ME',
                20 : 'MD',
                21 : 'MA',
                22 : 'MI',
                23 : 'MN',
                24 : 'MS',
                25 : 'MO',
                26 : 'MT',
                27 : 'NE',
                28 : 'NV',
                29 : 'NH',
                30 : 'NJ',
                31 : 'NM',
                32 : 'NY',
                33 : 'NC',
                34 : 'ND',
                35 : 'OH',
                36 : 'OR',
                37 : 'PA',
                38 : 'RI',
                39 : 'SC',
                40 : 'SD',
                41 : 'TN',
                42 : 'TX',
                43 : 'UT',
                44 : 'VT',
                45 : 'VA',
                46 : 'WA',
                47 : 'WV',
                48 : 'WI',
                49 : 'WY',
                50 : 'DC',
                51 : 'PR'
                },
                mya : 0,
		update_omniture_tags : function (slide){
			//Step 1- update the tags
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
            s.events="";    /* QRF Start */
            s.eVar59 = "|["+QRF.fallout.length+"]";

			if (slide=="first"){
				var products = QRF.get_products_for_omniture('first');
				s.pageName="QRF:Welcome Click";
				s.prop10="QRF:Welcome Click";    /* Roll Up Pages */
				s.events="";     /* Site Tool Starts */
				s.eVar27 = "QRF:Welcome";
				s.products = products;
				s.eVar59 = "";
			}

			if(slide=="tell-us-about-yourself"){
				s.pageName="QRF:Tell Us About Yourself";
				s.prop10="QRF:Tell Us About Yourself";    /* Roll Up Pages */

				if ($("#ProspectCity").val().length>0 || $("#ProspectCity").val()!=''){
					s.eVar16= $("#ProspectCity").val()+" ";
				}else{
					s.eVar16 = 'No City Entered';
				}
				s.eVar17= $("#ProspectStateId").find(":selected").text();     /* State ProspectStateId */
				s.events="event18";     /* QRF Start */
				$("#"+slide+" textarea, input").PCICleaner();
				return false;

			}
			if(slide=="auto"){
				s.pageName="QRF:Auto";
				s.eVar59 = QRF.product_on_fly(slide);
				s.events="";
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
                                $("#"+slide+" textarea, input").PCICleaner();
				return false;
			}
			if(slide=="homeowners"){
				s.pageName="QRF:Homeowners";
				s.events="";
				s.eVar59 = QRF.product_on_fly(slide);
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
                                $("#"+slide+" textarea, input").PCICleaner();
				return false;

			}
			if(slide=="life"){
				s.pageName="QRF:Life";
				s.events="";
				s.eVar59 = QRF.product_on_fly(slide);
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
                                $("#"+slide+" textarea, input").PCICleaner();
				return false;

			}
			if(slide=="power"){
				s.pageName="QRF:Power Sports";
				s.events="";
				s.eVar59 = QRF.product_on_fly(slide);
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
                                $("#"+slide+" textarea, input").PCICleaner();
				return false;

			}
			if(slide=="renters"){
				s.pageName="QRF:Renters";
				s.events="";
				s.eVar59 = QRF.product_on_fly(slide);
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
                                $("#"+slide+" textarea, input").PCICleaner();
				return false;

			}
			if(slide=="business"){
				s.pageName="QRF:Business";
				s.events="";
				s.eVar59 = QRF.product_on_fly(slide);
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
				return false;
			}
			if(slide=="travel"){
				s.pageName="QRF:Travel";
				s.events="";
				s.eVar59 = QRF.product_on_fly(slide);
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
                                $("#"+slide+" textarea, input").PCICleaner();
				return false;
			}
			if(slide=="medical"){
				s.pageName="QRF:Medical";
				s.events="";
				s.eVar59 = QRF.product_on_fly(slide);
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
                                $("#"+slide+" textarea, input").PCICleaner();
				return false;
			}
			if(slide=="farm"){
				s.pageName="QRF:Farm";
				s.events="";
				s.eVar59 = QRF.product_on_fly(slide);
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
                                $("#"+slide+" textarea, input").PCICleaner();
				return false;
			}
			if(slide=="umbrella"){
				s.pageName="QRF:Umbrella";
				s.eVar59 = QRF.product_on_fly(slide);
				s.prop10="QRF Product Pages";    /* Roll Up Pages */
                                $("#"+slide+" textarea, input").PCICleaner();
				return false;
			}
			if(slide == "findyouragent"){
				s.events="";
				s.pageName = "QRF:Find an Agent";
				s.eVar59 = s.products = "";
				s.prop10 = s.pageName;
				return false;
			}

			if(slide == "meetyouragent" && QRF.mya==0){
				s.events="";
				s.eVar59 = s.products = "";
				s.pageName = "QRF:Preselected Agent";
				s.prop10 = "QRF:Find an Agent";
				console.log("meetyouagent st calling");
				s.t();
				QRF.mya++;
				return false;
			}
			if(slide=="processing"){
				s.pageName = "QRF:Processing Request";
				s.eVar28 = "";
				s.prop10 = "QRF Confirmation";
				s.eVar59 = s.products = "";
				//s.t();
				console.log("processing st updaing");
				return false;
			}
			if(slide == "thankyou"){
				s.pageName = "QRF:Thank You Confirmation";
				s.prop10 = "QRF Confirmation";
				s.eVar28 = QRF.agentname;
				s.eVar59 = s.products = "";
				s.events = "event19, event30";
				s.t();
				return false;
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

		QRF.all_inputs += "<p>"+label+"<i>"+val+"</i></p>";

		},
		//*******************************************************************//
		email_responses : '<ul>',
		build_email_responses : function () {//loads meet your agent if referrer is amfam agent site
				QRF.email_responses += "<li><strong>Prospect Name: </strong>"+$("#ProspectFirstName").val()+" "+$("#ProspectLastName").val()+"</li>";
				QRF.email_responses += "<li><strong>Address: </strong>"+$("#ProspectAddress").val()+"</li>";
				QRF.email_responses += "<li><strong>City: </strong>"+$("#ProspectCity").val()+"</li>";
				var state = ($("#ProspectStateId").find(":selected").text()=='Select')?"":"<li><strong>State:</strong>"+$("#ProspectStateId").find(":selected").text()+"</li>";
				QRF.email_responses += state;
				QRF.email_responses += "<li><strong>ZIP Code: </strong>"+$("#ProspectZipcode").val()+"</li>";
				QRF.email_responses += "<li><strong>Phone: </strong>"+$("#ProspectPhoneNumber").val()+"</li>";
				QRF.email_responses += "<li><strong>E-mail: </strong>"+$("#ProspectEmailAddress").val()+"</li>";
				QRF.email_responses += "<li><strong>Language: </strong>"+$("#ProspectLanguageId").find(":selected").text()+"</li>";
				QRF.email_responses += QRF.all_inputs;
		},
		agentinformationfacebook : "",
		agentinformationsite : "",
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
                        var agentemail = $(this).find('email').text().toLowerCase();
						if (agentemail==email){
							//Agent's information
							var agentname = $(this).find('name').text();
							var addressArr = [];
							$(this).find("address").children().each(function(n) {
									addressArr.push($(this).text());
							});
							var agentaddress = addressArr[0]+",<br />"+addressArr[1]+", "+addressArr[2]+"<br />"+addressArr[3];

							var pictureUrl = $(this).find('pictureUrl').text();
                            pictureUrl = pictureUrl.replace('http://','https://');
							var agentphone = "";
							$(this).find("phone").each(function(n) {
								var arr = [];
								$(this).children().each(function() {
									arr.push($(this).text());
								});
								if(arr.length == 2) {if(arr[1] == "OFFICE") agentphone=arr[0];}
							});
							var agentInternetAddress = $(this).find('agentInternetAddress').text();
							var agentsite =$(this).find('agentsite').text();
							var agent_id = $(this).find('agentId').text();
							QRF.agent_site = (QRF.agent_site=='')?agentInternetAddress:QRF.agent_site;
							var agentname = $(this).find('name').text();
							var agent_id = $(this).find('agentId').text();
							QRF.agent_id = agent_id;
							QRF.agentname = agentname;
							QRF.agent_email = email;
							$("#ProspectAgentname").val(QRF.agentname);
							var agentInternetAddress = $(this).find('agentInternetAddress').text();
							var html = "";
							html += "<li><img src=\""+pictureUrl+"\" style=\"width: 70px; height: 100px;\"></li>";
							html += "<li><h3>"+agentname+"</h3></li>";
							html += "<li>"+agentaddress+"</li>";
							html += "<li><a href='tel:+1-"+agentphone.toLowerCase()+"'>"+agentphone.toLowerCase()+"</a></li>";
							$("#meetyouragent .agent-location").html(html);
							//thankyou slide agentinformation
							var agentname = "<h3>"+agentname+"</h3>";
							var address = "<span class=\"agent-office-location\">Office Location:</span>"+agentaddress+"";
							var phone = "<span class=\"agent-office-phone\"><a href='tel:"+agentphone+"'>"+agentphone+"</a></span><br/>";
							var agentemail = "<span class=\"agent-office-email\"><a href=\"mailto:"+agentemail+"\">"+agentemail+"</a></span>";
							var url = "<a target=\"_blank\" title=\"Meet Your Agent\" href=\"http://www.amfam.com\" class=\"button agent_website\" id=\"thankyou-agent-website\">Agent Website ></a>";
							$("#agentinformation").attr("href",agentInternetAddress+'&tid=ap99');
							QRF.agentinformationfacebook = agentname+address+phone+agentemail;
							agentaddress = agentaddress.replace("#", "");
							//Agent's map

							var longlat3 = "https://maps.googleapis.com/maps/api/staticmap?size=435x350&maptype=roadmap\&markers=size:mid%7Ccolor:red%7C"+agentaddress+"&sensor=false";

							$("#meetyouragent_google_map").attr("src",longlat3);
						}
					});

			    });
			});
		},
		load_agent : function () {//loads meet your agent if referrer is amfam agent site
			//check the agent info in the querystring.
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
					var agent_id = $(this).find('agentId').text();
					var agentname = $(this).find('name').text();
					//var agentaddress = $(this).find('address').text();
					var addressArr = [];
						$(this).find("address").children().each(function(n) {
								addressArr.push($(this).text());
						});
					var agentaddress = addressArr[0]+",<br />"+addressArr[1]+", "+addressArr[2]+"<br />"+addressArr[3];
					var pictureUrl = $(this).find('pictureUrl').text();
                    pictureUrl = pictureUrl.replace('http://','https://');
					var agentemail = $(this).find('email').text();
					var agentphone = "";
					$(this).find("phone").each(function(n) {
						var arr = [];
						$(this).children().each(function() {
							arr.push($(this).text());
						});
						if(arr.length == 2) {if(arr[1] == "OFFICE") agentphone=arr[0];}
					});

					var agentInternetAddress = $(this).find('agentInternetAddress').text();
					QRF.agentname = agentname;
					QRF.agent_email = agentemail;
					QRF.agent_id = (QRF.agent_id=="")?agent_id:QRF.agent_id;
					//Agent's information
					var html = "";
					html += "<li><img src=\""+pictureUrl+"\" style=\"width: 70px; height: 100px;\"></li>";
					html += "<li><h3>"+agentname+"</h3></li>";
					html += "<li>"+agentaddress+"</li>";
					html += "<li><a href='tel:+1-"+agentphone.toLowerCase()+"'>"+agentphone.toLowerCase()+"</a></li>";
					html += "<li id='meetyouragent_email'><a target='blank' href=\"mailto:"+agentemail+"\">Email</a><br /></li>";
					html += "<li id='meetyouragent_site'><a target='blank' href=\""+agentInternetAddress+"\">Website</a></li>";
					$("#meetyouragent .agent-location").html(html);
					$("#agentinformation").attr("href",agentInternetAddress);
					var agentsite = agentInternetAddress;
					var email = agentemail;
					QRF.agentemail = agentemail;
					var firstname = $("#ProspectFirstName").val();
					var lastname = $("#ProspectLastName").val();
					$("#prospect_full_name").html("Thank you, <!-- mp_trans_disable_start -->"+firstname+"<!-- mp_trans_disable_end -->!"); //08/09/2013
					var url = agentInternetAddress;
					var agentname = "<h3>"+agentname+"</h3>";
					var name = agentname;
					var address = "<span class=\"agent-office-location\">Office Location:</span>"+agentaddress+"";
					var phone = "<span class=\"agent-office-phone\"><a href='tel:"+agentphone+"'>"+agentphone+"</a></span><br/>";
					var agentemail = "<span class=\"agent-office-email\"><a href=\"mailto:"+email+"\">"+email+"</a></span>";
					QRF.agent_site = agentsite;
					$("#thankyou-agent-website").attr("href",QRF.agent_site);
					QRF.agentinformationsite = name+address+phone+agentemail;
					$("#ProspectAgentname").val(QRF.agentname);
					//Agent's map
					agentaddress = agentaddress.replace("#", "");

					var longlat3 = "https://maps.googleapis.com/maps/api/staticmap?size=435x350&maptype=roadmap\&markers=size:mid%7Ccolor:red%7C"+agentaddress+"&sensor=false";

					$("#meetyouragent_google_map").attr("src",longlat3);
				});

		    });
		},
		load_cookied_agent : function (data) {//loads meet your agent if referrer is amfam agent site
			//check the agent info in the querystring.
			var splt = data.split(' ');
			if (splt[0]==''){return false;}
			var agent_first_name = splt[0];
			var agent_last_name = splt[1];
			var agent_state = splt[2];
			QRF.data = "firstName="+agent_first_name+"&lastName="+agent_last_name+"&state="+agent_state;
			$.ajax({
			    type : 'POST',
			    url :  'ProspectResponses/processbyname',
			    data : QRF.data
			}).done(function(xml){
				$(xml).find('agent').each(function(){
					var agent_id = $(this).find('agentId').text();
					var agentname = $(this).find('name').text();
					//var agentaddress = $(this).find('address').text();
					var addressArr = [];
						$(this).find("address").children().each(function(n) {
								addressArr.push($(this).text());
						});
					var agentaddress = addressArr[0]+",<br />"+addressArr[1]+", "+addressArr[2]+"<br />"+addressArr[3];
					var pictureUrl = $(this).find('pictureUrl').text();
                    pictureUrl = pictureUrl.replace('http://','https://');
					var agentemail = $(this).find('email').text();
					//var agentphone = ($(this).find('phone').eq(2).text()=='')?$(this).find('phone').eq(1).text():$(this).find('phone').eq(2).text();
					var agentphone = "";
					$(this).find("phone").each(function(n) {
						var arr = [];
						$(this).children().each(function() {
							arr.push($(this).text());
						});
						if(arr.length == 2) {if(arr[1] == "OFFICE") agentphone=arr[0];}
					});

					var agentInternetAddress = $(this).find('agentInternetAddress').text();
					QRF.agentname = agentname;
					QRF.agent_email = agentemail;
					QRF.agent_id = (QRF.agent_id=="")?agent_id:QRF.agent_id;
					//Agent's information
					var html = "";
					html += "<li><img src=\""+pictureUrl+"\" style=\"width: 70px; height: 100px;\"></li>";
					html += "<li><h3>"+agentname+"</h3></li>";
					html += "<li>"+agentaddress+"</li>";
					html += "<li><a href='tel:+1-"+agentphone.toLowerCase()+"'>"+agentphone.toLowerCase()+"</a></li>";
					html += "<li id='meetyouragent_email'><a target='blank' href=\"mailto:"+agentemail+"\">Email</a><br /></li>";
					html += "<li id='meetyouragent_site'><a target='blank' href=\""+agentInternetAddress+"\">Website</a></li>";
					$("#meetyouragent .agent-location").html(html);
					$("#agentinformation").attr("href",agentInternetAddress);
					var agentsite = agentInternetAddress;
					var email = agentemail;
					QRF.agentemail = agentemail;
					var firstname = $("#ProspectFirstName").val();
					var lastname = $("#ProspectLastName").val();
					$("#prospect_full_name").html("Thank you, <!-- mp_trans_disable_start -->"+firstname+"<!-- mp_trans_disable_end -->!"); //08/09/2013
					var url = agentInternetAddress;
					var agentname = "<h3>"+agentname+"</h3>";
					var name = agentname;
					var address = "<span class=\"agent-office-location\">Office Location:</span>"+agentaddress+"";
					var phone = "<span class=\"agent-office-phone\"><a href='tel:"+agentphone+"'>"+agentphone+"</a></span><br/>";
					var agentemail = "<span class=\"agent-office-email\"><a href=\"mailto:"+email+"\">"+email+"</a></span>";
					QRF.agent_site = agentsite;
					$("#thankyou-agent-website").attr("href",QRF.agent_site);
					QRF.agentinformationsite = name+address+phone+agentemail;
					$("#ProspectAgentname").val(QRF.agentname);
					//Agent's map
					agentaddress = agentaddress.replace("#", "");

					var longlat3 = "https://maps.googleapis.com/maps/api/staticmap?size=435x350&maptype=roadmap\&markers=size:mid%7Ccolor:red%7C"+agentaddress+"&sensor=false";

					$("#meetyouragent_google_map").attr("src",longlat3);
				});

		    });
		},
		  response_value : "", vehicle_error:"",all_vehicle:1,
	power_sports : function(){
        var select_menu = new Array(); var input = new Array();
        all_vehicle = parseInt(QRF.all_vehicle);
        var counter=1;
        for (var i=1; i<=all_vehicle; i++){
            select_menu[i] = "";

            if ($("#vehicle_"+i+" .select_vehicle").val()!='Select'){
                select_menu[i]  = counter+") "+$("#vehicle_"+i+" .select_vehicle").val()+": ";
                counter++;
            }

            input[i] = "";
            if ($("#vehicle_"+i+" .vehicle_input").val()!=''){
                input[i] = $("#vehicle_"+i+" .vehicle_input").val()+"; ";

            }
                    QRF.error = QRF.vehicle_error=0;
                    input[i] = (typeof input[i] === 'undefined')?"":input[i];
                    QRF.response_value = select_menu[1]+input[1]+select_menu[2]+input[2]+select_menu[3]+input[3]+select_menu[4]+input[4]+select_menu[5]+input[5];
            }
        QRF.response_value = QRF.response_value.replace(new RegExp('undefined', 'g'), '');
        $("#power_q_37").val(QRF.response_value);
      }//end of Power Sports

};//end of QRF

$(document).ready(function(){
    s.t();
    QRF.update_omniture_tags('first', null);

    $("#birthDate").mask('99/99/9999');

    // Block all Enter key presses from submitting form  Nick R 3/17/15
    $('body').on('keypress', function(e) {
        if (e.keyCode == 13 || e.which == 13) {
            if($('#zipcode').is(':focus'))
            {
                var zip = ($('#zipcode').val()!="")?parseInt($('#zipcode').val()):"";
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

                var zip = document.getElementById("zipcode").value;
                document.getElementById("mobilezipcode").value = zip;
                submitform(zip,'find-your-agent');
                document.getElementById("zipcodebtn").disabled=true;
                return false;
            }
            e.preventDefault();
        }
    });

    $("#ProspectPhoneNumber").mask("999-999-9999").keydown(function( event ){
        if ( event.which == 9 || event.keyCode == 9 ) {
            event.preventDefault();
            return false;
        }
    }).keyup(function( event ){
        if ( event.which == 9 || event.keyCode == 9 ) {
            event.preventDefault();
            return false;
        }
    });
    QRF.is_facebook = (QRF.querystring("fbid").length>5)?true:false;
    if ($("#thankyou").length>0){$("#thankyou").load("thankyou");}//09/06/13 JT
    if ($("#findyouragent").length>0){$("#findyouragent").load("findyouragent");} //09/06/13 JT
    if ($("#meetyouragent").length>0){$("#meetyouragent").load("meetyouragent");}//09/06/13 JT
    $("#ProspectAgentFacebook").val(QRF.querystring("fbid"));
    QRF.agentID = QRF.cookies('QRFagent');

    //get the referring url
    QRF.referrer = document.referrer;
    var qs = document.location.search;
    var splt = qs.split('&');

    var agent_first_name = (QRF.querystring("agent-first-name").length>0)?splt[0].replace('?agent-first-name=',''):"";
    var agent_last_name = (QRF.querystring("agent-last-name").length>0)?splt[1].replace('agent-last-name=',''):"";
    var agent_state = (QRF.querystring("agent-state").length>0)?agent_state = splt[2].replace('agent-state=',''):"";
    $("#ProspectAgentFirstName").val(agent_first_name);
    $("#ProspectAgentLastName").val(agent_last_name);
    $("#ProspectAgentState").val(agent_state);

    if (agent_last_name!="" && agent_last_name!="" && agent_state!=""){
        $("#ProspectRef").val("agent");
    }

    var sflag = false;
    if (QRF.querystring("agent-first-name")!=''){
        sflag = true;
    }else{
        sflag = false;
    }
    if (QRF.querystring("agent-last-name")!=''){
        sflag = true;
    }else{
        sflag = false;
    }
    if (QRF.querystring("agent-state")!=''){
        sflag = true;
    }else{
        sflag = false;
    }

    if (sflag){
        QRF.is_from_agent = 1;
    }

    if (QRF.is_from_agent>=0){
        QRF.static_slide_num = 4;
    }

    if (QRF.is_facebook==true){
        QRF.load_facebook(QRF.querystring("fbid"),"facebook");
        $("#ProspectRef").val("facebook");
    }

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
        make[lid] = (make[lid]=='Select Make')?"":make[lid];

        model[lid] =  $("#model_"+lid).find("option:selected").text();
        model[lid] = (model[lid]=='-----')?"":model[lid];
        model[lid] = (model[lid]=='Select Model')?"":model[lid];

        car[lid] = year[lid]+" "+make[lid]+" "+model[lid]+"; ";
         if(typeof car[lid] === 'undefined'){
             car[lid] = lid;
         }
        all_cars=car['1']+car['2']+car['3']+car['4']+car['5'];
        all_cars = all_cars.replace(new RegExp('undefined', 'g'), '');
        all_cars = all_cars.replace(new RegExp('NaN', 'g'), '');
        all_cars = all_cars.replace("NaN",'');

        $("#autooptions").val(all_cars);
        var autooptions = all_cars?all_cars:'';
        $("#autooptions").val(autooptions);
    }
    $(".carquery_model").live('change', function(e){
        var id = $(this).attr("id");
        var pos = id.search('_')+1;
        var lid = id.substring(pos);
        fetch_car_validate(lid);
    });

    //added on 9/18/2013 Jon Toshmatov
    $(".carquery_year").live('change', function(e){
        var id = $(this).attr("id");
        var pos = id.search('_')+1;
        var lid = id.substring(pos);
        fetch_car_validate(lid);
    });

    $(".carquery_make").live('change', function(e){
        var id = $(this).attr("id");
        var pos = id.search('_')+1;
        var lid = id.substring(pos);
        fetch_car_validate(lid);
    });

    //load the vehicle options based on number of vehicle selected
    $("#auto13_drivers").live('change', function(e){
        var id =  $(this).find("option:selected").text();
        $("#autoresponse13").val(id);
    });

    $("#auto .autoquestion14").live('click', function(e){
        var val =  $(this).val();
        $("#autoresponse14").val(val);
    });

    $("#auto .autoquestion15").live('click', function(e){
        var val =  $(this).val();
        $("#autoresponse15").val(val);
    });

    $("#vehicle_expires").live('change', function(e){
        var id =  $(this).find("option:selected").text();
        $("#autoresponse16").val(id);
    });

    $("#auto11_options").live('change', function(e){
        QRF.load_auto_options(this.value);
        var id =  $(this).find("option:selected").text();
        $("#autoresponse11").val(id);

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

        if (id=='Select'){all_cars=''; $("#autooptions").val("");$("#autooptions6").css("display","none");}
        else{$("#autooptions").val(all_cars);}

        var autooptions = all_cars?all_cars:'';
        $("#autooptions").val(autooptions);
    });

    //Business
    $("#question47_y").live('click', function(e){
        $("#q48").fadeIn("slow");
        $("#q48").removeAttr("class");
    });
    $("#question47_n").live('click', function(e){
        $("#q48").fadeOut("slow");
        $("#q48 input").val('');
        $("#q48").addClass("hidden_li");
    });
    $("#question50_y").live('click', function(e){
        $("#q51").fadeIn("slow");
        $("#q51").removeClass("hidden_li");
    });
    $("#question50_n").live('click', function(e){
        $("#q51").fadeOut("slow");
        $("#q51 input").val('');
        $("#q51").addClass("hidden_li");
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

    });
    $(".whole_life").live('click', function(e){
        var checked = $('#whole_life_insurance').attr('checked');
        if (checked){
        life_val[1] = "Whole Life Insurance;";
        }else{
            life_val[1] = "";
        }
        $("#life_41").val(life_val[0]+life_val[1]+life_val[2]);
    });
    $(".universal_life").live('click', function(e){
        var checked = $('#universal_life_insurance').attr('checked');
        if (checked){
        life_val[2] = "MyLife Insurance;";
        }else{
            life_val[2] = "";
        }
        $("#life_41").val(life_val[0]+life_val[1]+life_val[2]);
    });
    window.onresize = function(){QRF.resize();};
    window.onorientationchange = function(){QRF.resize();};
    if(!$('.screen').hasClass('active')){
        QRF.slide("","", $('.first'));
    }
    var is_this = "";
    var is_zip_ran =0;

    //Fire up the live email job to send live email to both agent and prospect
    //Created on 8/10/2013 Jon Toshmatov
    $('#submit_qrf').live('click', function(e){
        QRF.update_omniture_tags('processing');
        s.t();
        console.log("1346 submitted processing st func called");
        var wait_html = "<h3 class=\"title\">Processing Request</h3>";
        wait_html+="<p>Your information is being processed and should be ready momentarily. Please do not press the back button or close your browser window.</p>";
        wait_html+="<img src=\"img/processing-bar-20.gif\">";
        wait_html+="<p>Thank you for your patience.</p>";
        $("#thankyou .warningclass").html(wait_html);

        $("#ProspectAgentname").val(QRF.agentname);
        $("#ProspectAgentFacebook").val(QRF.querystring("fbid"));
        QRF.agent_email = QRF.agent_email.toLowerCase();
        $("#ProspectAgentEmailAddress").val(QRF.agent_email);
        if (QRF.agent_id.length==3){QRF.agent_id = "000"+QRF.agent_id;}
        if (QRF.agent_id.length==4){QRF.agent_id = "00"+QRF.agent_id;}
        if (QRF.agent_id.length==5){QRF.agent_id = "0"+QRF.agent_id;}
        $("#ProspectAgentid").val(QRF.agent_id);
        $("#ProspectStatus").val(1);
        QRF.save_tell_us();
        setTimeout(submit_form,2000);
    });

    function submit_form(){
        if (QRF.prospect_id=='' || QRF.prospect_id==null){QRF.warning("Tell-us form has not been submitted successfully");}
            var mydata = "prospect_id="+QRF.prospect_id;
            $.ajax({
                type : 'POST',
                url :  'Emaillive/initemail',
                data : mydata
            }).done(function(msg){
                $("#thankyou .warningclass").fadeOut("slow");
        });
    }


    $('.btn-get_started a').live('click', function(e){
        e.preventDefault();
        QRF.update_omniture_tags("first");
    });

    var cid = "";
    var pcid ="";


    $('.paging a, .btn-get_started a, #submit_qrf, .paging-buttons a').live('click', function(e){
        e.preventDefault();
        $("#ProspectAgentname").val(QRF.agentname);
        $("#ProspectAgentFacebook").val(QRF.querystring("fbid"));
        $("#ProspectAgentEmailAddress").val(QRF.agentemail);
        cid = $('.active').next().attr('name');
        pcid = $('.active').attr('name');
        agent_id = QRF.agent_id;
        var next_fieldset_name = $('.active').next().attr('name');
        var previous_fieldset_name = $('.active').prev().attr('name');
        var cf = $('.active').index();
        var checked = $("#first input:checked");
        var l = checked.length;
        var direction = $(this).attr('class');
        var current_fieldset_name = $('.active').attr('name');
        //combine all navigation clicks in here - Jon Toshmatov 11/21/2013 12:49 PM

        //btn-get_started
        $("#load form").css('min-height','920px');

        if(current_fieldset_name=='select' && direction=='next'){
            QRF.update_products_ids();
        }

        if (current_fieldset_name=='auto' && direction=='next'){
            if ($("#autooptions6_value").val()!=''){
            var opt = $("#autooptions").val()+"  "+$("#autooptions6_value").val()+";";
            $("#autooptions").val(opt);
            var autooptions = opt?opt:'';
            $("#autooptions").val(autooptions);
            $("#autooptions6_value").val("");
            }
        }

        if (QRF.agent_id.length==3){QRF.agent_id = "000"+QRF.agent_id;}
        if (QRF.agent_id.length==4){QRF.agent_id = "00"+QRF.agent_id;}
        if (QRF.agent_id.length==5){QRF.agent_id = "0"+QRF.agent_id;}
        $("#ProspectAgentid").val(QRF.agent_id);

        //	in case if they want the power fields required, just uncomment these lines
        if (next_fieldset_name=='meetyouragent'){
            $("#ProspectAgentname").val(QRF.agentname);
            $("#ProspectAgentFacebook").val(QRF.querystring("fbid"));
            $("#ProspectAgentEmailAddress").val(QRF.agentemail);
            if (QRF.agent_id.length==3){QRF.agent_id = "000"+QRF.agent_id;}
            if (QRF.agent_id.length==4){QRF.agent_id = "00"+QRF.agent_id;}
            if (QRF.agent_id.length==5){QRF.agent_id = "0"+QRF.agent_id;}
            $("#ProspectAgentid").val(QRF.agent_id);
            $("#ProspectStatus").val(0);
            $("#ProspectAgentEmailAddress").val(QRF.agent_email);
            $("#ProspectStatus").val(0);
            QRF.save_tell_us();
        }
        if(current_fieldset_name=='power'){
            QRF.power_sports();
            $("#power_q_37").val(QRF.response_value);
        }

        QRF.update_page_title(direction); //update title
        //social media, agency and etc
        //if both cookie and referrer exist
        //update line 540-545 as well
        if (current_fieldset_name=='select' && QRF.slide_direction==0 && QRF.is_from_agent>=0){
            $("#meetoyouragent .different_agent").css("display","none");
            if ($("#findyouragent").length>0){$("#findyouragent").remove();}
            QRF.update_progress_bar();
            QRF.load_agent();
        }

        if (current_fieldset_name=='select' && QRF.slide_direction==1 && QRF.is_facebook==true){
            $("#meetoyouragent .different_agent").css("display","none");
            if ($("#findyouragent").length>0){$("#findyouragent").remove();}
            QRF.update_progress_bar();
            $("#ProspectAgentEmailAddress").val(QRF.agent_email);
        }

        //Medical
        //if only cookie exists
        //TODO: Marlon Hoilett neees to make changes in case line 1573 does not work

        if  (QRF.agentID!=false){
            if ($("#findyouragent").length>0){$("#findyouragent").remove();}
            QRF.update_progress_bar();
            QRF.load_cookied_agent(QRF.agentID);
            $("#meetyouragent .different_agent").css("display","none");
        }
        if (current_fieldset_name=='meetyouragent'){
            var da = $("#different_agent").attr("id");
        }

        if (next_fieldset_name=='meetyouragent' && QRF.is_from_agent>0){
            $(".different_agent").hide();
        }

        if (next_fieldset_name=='meetyouragent' && QRF.is_facebook==true){
            $(".different_agent").hide();
        }

        if (next_fieldset_name=='meetyouragent'){
            //QRF.save_tell_us();
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
            QRF.load_products(direction, QRF.ins_before); //09/06/13 JT
        }
        //it is currently saving only on next to avoid some functional conflicts.
        QRF.save_data(direction);
        //QRF.move(direction);
        QRF.slide_direction = (direction=='next')?1:0;

        if ($("#findyouragent").length>0 && next_fieldset_name=='findyouragent'){
            var ProspectZipcode = $("#ProspectZipcode").val();

            is_this = "findyouragent";
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

            if ($("#agentlist .sidebarAgentDivFocus").text().length>0 && QRF.slide_direction==1){
                QRF.meet_your_agent();
            }
            if ($("#agentlist .sidebarAgentDivFocus").text().length<=0 && QRF.slide_direction==1){
                QRF.warning("Please select your agent from the list.");
                return false;
            }
        }

        if (next_fieldset_name=='thankyou'){

            if(agentList.length > 0) {
                var addr = agentList[$("#agentlist .sidebarAgentDivFocus").index()]['address'];
                var agentaddress = addr[0]+",<br />"+addr[1]+", "+addr[2]+"<br />"+addr[3];
                agentaddress = agentaddress.replace("#","");
            }
            var agentphone = $("#agentlist .sidebarAgentDivFocus .sideBarPhoneDiv").text();
            var agentsite = $("#agentlist .sidebarAgentDivFocus #agentsite").text();
            var email = $("#agentlist .sidebarAgentDivFocus #agentemail").text();
            QRF.agent_email = (QRF.agent_email=='')?email:QRF.agent_email;
            var firstname = $("#ProspectFirstName").val();
            var lastname = $("#ProspectLastName").val();
            //$("#prospect_full_name").html("Thank you "+firstname+" "+lastname+"!");
            $("#prospect_full_name").html("Thank you, "+firstname+"!"); //08/09/2013
            var url = $("#agentlist .sidebarAgentDivFocus #agentsite a").attr("href");
            var agentname = "<h3>"+$("#agentlist .sidebarAgentDivFocus .sidebarAgentName").text()+"</h3>";
            var name = agentname;
            var address = "<span class=\"agent-office-location\">Office Location:</span>"+agentaddress+"";
            var phone = "<span class=\"agent-office-phone\"><a href='tel:"+agentphone+"'>"+agentphone+"</a></span>";
            var agentemail = "<span class=\"agent-office-email\"><a href=\"mailto:"+email+"\">"+email+"</a></span>";
            QRF.agent_site = (QRF.agent_site=='')?agentsite:QRF.agent_site;

            $("#thankyou-agent-website").attr("href",QRF.agent_site+"&tid=ap99");
            if (QRF.is_facebook==true){
                $("#agentinformation").html("<!-- mp_trans_disable_start -->"+QRF.agentinformationfacebook+"<!-- mp_trans_disable_end -->");
            }else{
                $("#agentinformation").html("<!-- mp_trans_disable_start -->"+name+address+phone+agentemail+"<!-- mp_trans_disable_end -->");
            }
            if (QRF.is_from_agent>0){
                $("#agentinformation").html("<!-- mp_trans_disable_start -->"+QRF.agentinformationsite+"<!-- mp_trans_disable_end -->");
            }


        }

        if (current_fieldset_name=='tell-us-about-yourself' && direction=="next"){
            var ProspectZipcode = $("#ProspectZipcode").val();
            $("#zipcode").val(ProspectZipcode);

            //first name
            if ($("#ProspectFirstName").val()=='First Name' || $("#ProspectFirstName").val()== "" || $("#ProspectFirstName").val()=='SPFirst Name'){
                QRF.warning("Please enter your first name");
                $(".required").css("display","block");
                return false;
            }
            //last name
            if ($("#ProspectLastName").val()=='Last Name' || $("#ProspectLastName").val() == "" ||$("#ProspectLastName").val()=='SPLast Name'){
                QRF.warning("Please enter your last name");
                return false;
            }

            re = /^(?:(?:(?:0?[13578]|1[02])(\/|-|\.)31)\1|(?:(?:0?[1,3-9]|1[0-2])(\/|-|\.)(?:29|30)\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:0?2(\/|-|\.)29\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:(?:0?[1-9])|(?:1[0-2]))(\/|-|\.)(?:0?[1-9]|1\d|2[0-8])\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;

            if ($("#birthDate").val() == '' || $("#birthDate").val().length <=0){
                QRF.warning("Please enter Date of Birth MM/DD/YYYY");
                return false;
            }

            if(!$("#birthDate").val().match(re))
            {
                QRF.warning("Invalid Date of Birth");
                return false;

            } else if($("#birthDate").val().match(re)) {

                var month = $("#birthDate").val().substring(0, 2);
                var date = $("#birthDate").val().substring(3, 5);
                var year = $("#birthDate").val().substring(6, 10);
                var myDate = new Date(year, month - 1, date);
                var adult = new Date();
                adult.setFullYear( adult.getFullYear() - 18 );
                var tooold = new Date();
                tooold.setFullYear( tooold.getFullYear() - 100 );
                if (myDate > adult) {
                    QRF.warning("You must be 18+ years old");
                    return false;
                }
                if (myDate < tooold) {
                    QRF.warning("Invalid Date of Birth");
                    return false;
                }
            }
            else
            {
                QRF.warning("Invalid Date of Birth");
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
            //Added by Jon Toshmatov 10/21/2013 3:02 PM QRFE-165
            var prospect_state_id = $("#ProspectStateId").val();
            if (prospect_state_id==0){
                QRF.warning("Please select your state.");
                return false;
            }

            if (!QRF.is_email(email)){
                QRF.warning("Please enter a valid email address.");
                return false;
            }


            /////////////////Correct Phone number validation
            phonere = /^(\()?\d{3}(\))?(-|\s)?\d{3}(-|\s)\d{4}$/;
            if($("#ProspectPhoneNumber").val() == '')
            {
                //alert($(regs));
                QRF.warning("Please enter phone number");
                return false;

            }
            if(!$("#ProspectPhoneNumber").val().match(phonere) || $("#ProspectPhoneNumber").val() == '000-000-0000' || $("#ProspectPhoneNumber").val() == '111-111-1111')
            {
                //alert($(regs));
                QRF.warning("Invalid phone number");
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
            if ($("#ProspectPhoneNumber").val().length<10){
                QRF.warning("Please enter your phone number");
                return false;
            };
            QRF.save_tell_us();
            QRF.update_omniture_tags('tell-us-about-yourself');

            QRF.is_promotion_on==1;
        }//end of if tell-us required fields

        QRF.update_progress_bar();
        QRF.move(direction);

        if (previous_fieldset_name=='select' && QRF.slide_direction==1 && QRF.is_from_agent==-1 && QRF.is_facebook==false){
            if (QRF.trigger_find_agent ==1 || is_zip_ran==0){
                var zip = $("#ProspectZipcode").val();
                zip = parseInt(zip);
                if(!isAndroid())  initialize();
                submitform(zip,'tell-us');
                is_zip_ran =1;
                QRF.zipcode = zip;
            }
        }

        e.preventDefault();
    });//end of paging

    $("#question14_y").live('click', function(e){
        $("#teenssavedriver").fadeIn("slow");
    });
    $("#question14_n").live('click', function(e){
        $("#teenssavedriver").fadeOut("slow");
    });
    $("#question15_y").live('click', function(e){
        $("#question_16").fadeIn("slow");
    });
    $("#question15_n").live('click', function(e){
        $("#question_16").val('');
        $("#question_16").fadeOut("slow");
    });
    var inp="";
    $("#question37_select").live('change', function(e){
        if ($("#question37_select").val()=='Select'){
            return false;
        }
        inp = $("#question38_input").val()+this.value+":\n";
        $("#question38_input").val(inp);
    });
    // validate every input fields tell us slide
    $("#ProspectFirstName, #ProspectLastName").live('blur', function(e){
        text = this.value.replace(/[^a-zA-Z-,.\s]/g, "");
        if(/_|\s/.test(text)) {
            text = text.replace(/_|/g, "");
        }
        this.value =text;
    });
    $('#ProspectStateId').live('change', function(e){
        s.eVar17 = QRF.states[$('#ProspectStateId').val()];
    });

    $("#ProspectAddress, #ProspectCity").live('blur', function(e){
        text = this.value.replace(/[^a-zA-Z0-9-_,:.\s]/g, "");
        if(/_|\s/.test(text)) {
            text = text.replace(/_|/g, "");
        }
        if ($("#ProspectCity").val().length>0 || $("#ProspectCity").val()!=''){
            s.eVar16= $("#ProspectCity").val()+" ";
        }else{
            s.eVar16 = 'No City Entered';
        }
        this.value =text;
    });


    $(".numbersonly").live('blur', function(e){
        text = this.value.replace(/[^0-9\s]/g, "");
        if(/_|\s/.test(text)) {
            text = text.replace(/_|/g, "");
        }

        if (text<0 || text>3000){
            text = 1;
        }
        this.value =text;
    });
    $(".yearonly").live('blur', function(e){
        text = this.value.replace(/[^0-9\s]/g, "");
        if(/_|\s/.test(text)) {
                text = text.replace(/_|/g, "");
        }
        if (text<1700 || text>2050){
            text = '';
        }
        this.value =text;
    });
    $(".url").live('blur', function(e){
        //./,?!@#$%&*()-_=+\;:
        text = this.value.replace(/[^a-zA-Z0-9./,\?!@#$%&*()-_=+\;:\//~\s]/g, "");
        if (text<0 || text>20){
            text = 1;
        }
        this.value =text;
    });
    //ZIP code validation
    $("#ProspectZipcode").live('change', function(e){
        text = this.value.replace(/[^0-9]/g, "");
        if(/_|\s/.test(text)) {
            text = text.replace(/_|\s/g, "");
        }
        this.value =text;
    });
    //Phone code validation
    $("#ProspectPhoneNumber").live('blur', function(e){
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
        } else {
            medical_val[0] = "Health Insurance;";
        }
        $("#medical54_response").val(medical_val[0]+medical_val[1]+medical_val[2]);
    });
    $(".dental").live('click', function(e){
        var checked = $('#medical54_dental').attr('checked');
        if (checked){
            medical_val[1] = "";
        } else {
            medical_val[1] = "Dental Insurance;";
        }
        $("#medical54_response").val(medical_val[0]+medical_val[1]+medical_val[2]);
    });
    $(".medicare_supplement").live('click', function(e){
        var checked = $('#medical54_medicare').attr('checked');
        if (checked){
            medical_val[2] = "";
        } else {
            medical_val[2] = "Medicare Supplement Plus;";
        }
        $("#medical54_response").val(medical_val[0]+medical_val[1]+medical_val[2]);
    });
    //Travel Insurance
    var travel_val = new Array();
    travel_val[0]="";travel_val[1]="";travel_val[2]="";
    $(".trip_cancellation").live('click', function(e){
        var checked = $('#travel52_cancel').attr('checked');
        if (checked){
            travel_val[0] = "";
        } else {
            travel_val[0] = "Trip Cancellation Insurance;";
        }
        $("#travel52_response").val(travel_val[0]+travel_val[1]+travel_val[2]);
    });
    $(".global_medical").live('click', function(e){
        var checked = $('#travel52_medical').attr('checked');
        if (checked){
            travel_val[1] = "";
        } else {
            travel_val[1] = "Global Medical Insurance;";
        }
        $("#travel52_response").val(travel_val[0]+travel_val[1]+travel_val[2]);
    });
    $(".mexico_auto").live('click', function(e){
        var checked = $('#travel52_mexico').attr('checked');
        if (checked){
            travel_val[2] = "";
        } else {
            travel_val[2] = "Mexico Auto Insurance;";
        }
        $("#travel52_response").val(travel_val[0]+travel_val[1]+travel_val[2]);
    });
    //Umbrella Insurance
    var umbrella_val = new Array();
    umbrella_val[0]="";umbrella_val[1]="";umbrella_val[2]="";
    $(".personal_liability").live('click', function(e){
        var checked = $('#umbrella61_personal').attr('checked');
        if (checked){
            umbrella_val[0] = "";
        } else {
            umbrella_val[0] = "Personal Liability Umbrella Insurance;";
        }
        $("#umbrella61_response").val(umbrella_val[0]+umbrella_val[1]+umbrella_val[2]);
    });
    $(".commercial_liability").live('click', function(e){
        var checked = $('#umbrella61_commercial').attr('checked');
        if (checked){
            umbrella_val[1] = "";
        } else {
            umbrella_val[1] = "Commercial Liability Umbrella Insurance;";
        }
        $("#umbrella61_response").val(umbrella_val[0]+umbrella_val[1]+umbrella_val[2]);
    });
    $(".farm_liability").live('click', function(e){
        var checked = $('#umbrella61_farm').attr('checked');
        if (checked){
            umbrella_val[2] = "";
        } else {
            umbrella_val[2] = "Farm/Ranch Liability Umbrella Insurance;";
        }
        $("#umbrella61_response").val(umbrella_val[0]+umbrella_val[1]+umbrella_val[2]);
    });
    $("#different_agent").live('click', function(e){
        e.preventDefault();
        var direction = $(this).attr('class');
        if ($("#findyouragent").length<=0){return false;}
        QRF.slide_direction = (direction=='next')?1:0;

        var zipcode = parseInt($("#ProspectZipcode").val());

        if ($("#findyouragent").length>0 && QRF.ins_before=="meetyouragent"){
            QRF.static_slide_num = 5;
            QRF.update_progress_bar();
        }
        if (QRF.is_from_agent>=0){
            $("#zipcode").val(zipcode);
            submitform(zipcode,'meetyouragent');
        }
        QRF.update_progress_bar();
        QRF.move(direction);
    });
    //selects/unselects the products
    $(document).on('click', '.items li' ,function(){
        var checkbox = $(this).toggleClass('clicked').find(':checkbox');

        if($(this).hasClass('clicked')) {
          checkbox.attr('checked','checked');
        } else {
          checkbox.removeAttr('checked');
        }

        //change the plus to check when product is clicked 8/09/2013 JT
        if ($(this).find('span').attr("class")=='uncheck-product'){
            $(this).find('span').attr("class","check-product");
        }else{
            $(this).find('span').attr("class","uncheck-product");
        }

     })

    //When does your policy expire? slides: Business
    $(".havepolicy input").live('click', function(e){

        var fld = $(this).closest('form.screen').attr("id");
        var val = $(this).val();
        if (val=="Yes"){
            $("#"+fld+" .havepolicy2").fadeIn("fast");
        }else{
            $("#"+fld+" .havepolicy2").fadeOut("fast");
        };
    });
    //Power Sports
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
      }
    })

});//end of document load
