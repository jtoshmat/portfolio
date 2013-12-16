var CNA = {
		/*
		 * Company: American Family Insurance
		 * Project: Commercial Needs Assessmenet (CNA)
		 * Department: Web Experience Unit 2
		 * Project Manager: Robyn Chase
		 * Developer: Jon Toshmatov
		 * Designer: Joe Engle
		 * Created: October 16, 2013
		 *
		 * All the major variables are declared here
		 * A variable can be called with CNA.varname
		 * most of the vars are used for counters		 *
		 */
		domain : window.location.hostname,data:'', is_facebook: false, Agent: new Object(),
		Prospect: new Object(),
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
		coming_from_facebook : function (){
			if (CNA.querystring("fbid").match(/[^0-9$]/)){return false;}
			var fbid = (typeof (CNA.querystring("fbid")!=undefined))?parseInt(CNA.querystring("fbid")):null;
			if (CNA.querystring("fbid")=='' || fbid==null){return false;}//fbid empty exit;
			if (!CNA.is_numeric(fbid)){	return false;}//fbid not numeric exit;
			//facebook action here.
			CNA.is_facebook = true;
			CNA.data = "fbid="+fbid+"&key=hEzHBQV1Ic";
			$.ajax({
			    type : 'POST',
			   url :  'FrontQuestions/getfacebookagent',
			   data : CNA.data
			}).done(function(xml){
				var obj = jQuery.parseJSON(xml);
				$(obj).each(function(){
					if (obj.items[0].error!=0){return false; CNA.is_facebook=false;}
					CNA.Agent.agentid = obj.items[0].agentid;
					CNA.Agent.fbid = obj.items[0].fbid;
					CNA.Agent.firstname = obj.items[0].firstname;
					CNA.Agent.lastname = obj.items[0].lastname;
					CNA.Agent.zip = obj.items[0].zip;
					CNA.Agent.email = obj.items[0].email.toLowerCase();
					CNA.Agent.error = obj.items[0].error;
					CNA.Agent.status = obj.items[0].status;
					CNA.Agent.agencyname = obj.items[0].agencyname;
					return false;
				});
				if (obj.items[0].error!=0){return false; CNA.is_facebook=false;}
				var agent = "<br />Agent name:"+CNA.Agent.firstname+" "+CNA.Agent.lastname+"<br />"+CNA.Agent.agentid ;
				$("#jon_display").html("You came from Facebook: "+agent);
				CNA.data = "method=locateByZip&zip="+CNA.Agent.zip;
				CNA.search_agent('facebook');
				return false;
			});
			return true;//default function value
		},//end of coming_from_facebook
		//*******************************************************************//
		coming_from_agent : function (){
			if (CNA.is_facebook){return false;}
			if (CNA.querystring("agent-first-name")==''){return false;}
			if (CNA.querystring("agent-last-name")==''){return false;}
			if (CNA.querystring("agent-state")==''){return false;}

			var agent_first_name = CNA.querystring("agent-first-name");
			var agent_last_name = CNA.querystring("agent-last-name");
			var agent_state = CNA.querystring("agent-state");
			CNA.is_facebook = false;
			CNA.data = null;
			CNA.data = "agent_first_name="+agent_first_name+"&agent_last_name="+agent_last_name+"&agent_state="+agent_state+"&method=locateByName";
			CNA.search_agent('agent');
			return true;//default function value
		},
		search_agent :function(from){
			$.ajax({
			    type : 'POST',
			   url :  'FrontQuestions/getagentbyname',
			   data : CNA.data
			}).done(function(xml){
				$(xml).find('agent').each(function(){
					if (from=='facebook'){
					CNA.Agent.email = CNA.Agent.email.toUpperCase();
					if ($(this).find('email').text()=='AZAHNOW@AMFAM.COM'){
							CNA.Agent.agentid = $(this).find('agentId').text();
							CNA.Agent.fullname = $(this).find('name').text();
							CNA.Agent.address = $(this).find('address').text();
							CNA.Agent.pictureUrl = $(this).find('pictureUrl').text();
							CNA.Agent.email = $(this).find('email').text();
							CNA.Agent.zip = $(this).find('zip').text();
							CNA.Agent.phone = ($(this).find('phone').eq(2).text()=='')?$(this).find('phone').eq(1).text():$(this).find('phone').eq(2).text();
							CNA.Agent.website = $(this).find('agentInternetAddress').text();
							CNA.update_agent($(this).find('name').text());
							console.log("facebook found and comparing email:"+ CNA.Agentemail);
							CNA.update_agent(CNA.Agent.fullname, CNA.Agent.agentid);
						}else{
							CNA.Agent.email = "";
							console.log("facebook found and email not found");
						}
					}
					if (from=='agent'){
						CNA.Agent.agentid = $(this).find('agentId').text();
						CNA.Agent.fullname = $(this).find('name').text();
						CNA.Agent.address = $(this).find('address').text();
						CNA.Agent.pictureUrl = $(this).find('pictureUrl').text();
						CNA.Agentemail = $(this).find('email').text();
						CNA.Agent.phone = ($(this).find('phone').eq(2).text()=='')?$(this).find('phone').eq(1).text():$(this).find('phone').eq(2).text();
						CNA.Agent.website = $(this).find('agentInternetAddress').text();
						CNA.update_agent($(this).find('name').text());
					}


				});
				if (CNA.Agent.agentid!=null){
					$("#jon_display").html("You came from Agent Website<br /> Agent name: "+CNA.Agent.fullname+"<br /><img src=\""+CNA.Agent.pictureUrl+"\"><br />"+CNA.Agent.email);
				}
				return false;
			});
		},
		//*******************************************************************//
		update_agent : function(fullname, agentid){
			CNA.Agent.fullname = agentid;
		},
		//*******************************************************************//
		//*******************************************************************//
		come_from : function(){
			if (CNA.coming_from_facebook()==true){return false;};
			if (CNA.coming_from_agent()==true){return false;}
		},
		//*******************************************************************//
};

//when dom loaded completely.
$(document).ready(function(){
	CNA.come_from();
	//clicks, submits actions
	// Hide Question fieldsets on launch & show them on click.
	$("#content .cna_fieldset_div .fieldset_label" ).on("click", function() {
		var id = $(this).closest("div").attr("id");
		$(".cna_fieldsets").hide();
		$(".cna_fieldset_div").removeClass("active_fieldset");
		$("#" + id + " .cna_fieldsets").show();
		$("#" + id + ".cna_fieldset_div").addClass("active_fieldset");
		if (id == 'findagent') {
			initialize();
			}
		});


 	$("#jon_display img").live('click', function(e){
 		alert("Agent Name:" + CNA.Agent.fullname);
 	});

 	var flag = 0;
 	$(":submit").click(function() {
	$("#ProspectAddForm .required input").each(function(index) {
 			var inp = $(this).val();
 			if (inp==''){
 				var label = $(this).parent().text();
 				//alert(label +" is required");
 				$(this).focus();
 				$("#ProspectAddForm .required input").eq(index).attr("class","required_fields");
 				flag = 0;
 				return false;
 			}
	 		$("#ProspectAddForm .required input").eq(index).attr("class","input_fields_blank");
	 		$("#ProspectAddForm .required select").eq(index).attr("class","input_fields_blank");
 		});
 		flag = 1;
 		});

 	$('#ProspectAddForm').submit(function() {
 		if (flag==1){
 			return true;
 		}
 	});

 	$("#zipcodebtn").live('click', function(e){
 		search_agent(52001);
 	});
	function search_agent(zip){
		var zipcode = 52001;
		//submitform(zipcode,'findagent');
		alert("coming soon");
	}

	// Except the first fieldset, which should open immediately when the site is loaded.
	$("#tell-us .cna_fieldsets").show();
	$("#tell-us").addClass("active_fieldset");


	$(':submit').live('mouseover', function(e){

		$("#flashMessage").show();
		$("#flashMessage").html("sdfsdfdsf");
	});


});//end of document