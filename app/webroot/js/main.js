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
		Prospect: new Object(),sPath : window.location.pathname, agentemail : '',
		Agent : {agentid : null, info : ''},page_title : 'CNA: Welcome',
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
			CNA.is_facebook = 'facebook';
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
					CNA.Agent.fullname = CNA.Agent.firstname+" "+CNA.Agent.lastname;
					CNA.Agent.zip = obj.items[0].zip;
					CNA.Agent.email = obj.items[0].email.toLowerCase();
					CNA.agentemail = CNA.Agent.email;
					CNA.Agent.error = obj.items[0].error;
					CNA.Agent.status = obj.items[0].status;
					CNA.Agent.agencyname = obj.items[0].agencyname;
					return false;
				});
				if (obj.items[0].error!=0){return false; CNA.is_facebook=false;}
				var agent = "<br />Agent name:"+CNA.Agent.firstname+" "+CNA.Agent.lastname+"<br />"+CNA.Agent.agentid ;
				//$("#jon_display").html("You came from Facebook: "+agent);
				CNA.data = null;
				CNA.data = "method=locateByZip&zip="+CNA.Agent.zip;
				CNA.search_agent('facebook',CNA.agentemail,CNA.Agent.fullname);

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
			CNA.is_agent = 'agent';
			CNA.data = null;
			CNA.data = "agent_first_name="+agent_first_name+"&agent_last_name="+agent_last_name+"&agent_state="+agent_state+"&method=locateByName";
			CNA.search_agent('agent');
			return true;//default function value
		},
		search_agent :function(from,agentemail,fullname){
			$.ajax({
			    type : 'POST',
			   url :  'FrontQuestions/getagentbyname',
			   data : CNA.data
			}).done(function(xml){
				$(xml).find('agent').each(function(){
					if (from=='facebook'){
					CNA.Agent.email = agentemail.toUpperCase();
					if ($(this).find('email').text()==CNA.Agent.email){
						CNA.Agent.test = $(this).find('address').find('ns2').html();
						//alert(xml);
						var addressArr = [];
							$(this).find("address").children().each(function(n) {
								addressArr.push($(this).text());
							});
							CNA.Agent.agentid = $(this).find('agentId').text(); //ok
							CNA.Agent.fullname = $(this).find('name').text();
							CNA.Agent.address =  addressArr[0] ;
							CNA.Agent.pictureUrl = $(this).find('pictureUrl').text();
							CNA.Agentemail = $(this).find('email').text();
							CNA.Agent.zip = addressArr[3] ;//part of address
							var phone="";
							$(this).find("phone").each(function(n) {
								var arr = [];
								$(this).children().each(function() {
									arr.push($(this).text());
								});
								if(arr.length == 2) {if(arr[1] == "OFFICE") phone=arr[0];}
							});
							CNA.Agent.phone =  phone ;//ok group
							CNA.Agent.website = $(this).find('agentInternetAddress').text();//ok
							//CNA.update_agent($(this).find('name').text());
							//CNA.update_agent(CNA.Agent.fullname, CNA.Agent.agentid);

							//collect the agent info to save in the table
							CNA.Agent.info = "agentid = "+CNA.Agent.agentid;
							CNA.Agent.info += "&fullname = "+CNA.Agent.fullname;
							CNA.Agent.info += "&address = "+CNA.Agent.address;
							CNA.Agent.info += "&image = "+CNA.Agent.pictureUrl;
							CNA.Agent.info += "&email = "+CNA.Agentemail;
							CNA.Agent.info += "&phone = "+CNA.Agent.phone;
							alert("CNA.Agent.info " + CNA.Agent.info);
							$("#agent").val(CNA.Agent.info);
							return false;
						}
					}
					if (from=='agent'){
						var addressArr = [];
						$(this).find("address").children().each(function(n) {
							addressArr.push($(this).text());
						});
						CNA.Agent.agentid = $(this).find('agentId').text(); //ok
						CNA.Agent.fullname = $(this).find('name').text();
						CNA.Agent.address =  addressArr[0] ;
						CNA.Agent.pictureUrl = $(this).find('pictureUrl').text();
						CNA.Agentemail = $(this).find('email').text();
						CNA.Agent.zip = addressArr[3] ;//part of address
						var phone="";
						$(this).find("phone").each(function(n) {
							var arr = [];
							$(this).children().each(function() {
								arr.push($(this).text());
							});
							if(arr.length == 2) {if(arr[1] == "OFFICE") phone=arr[0];}
						});
						CNA.Agent.phone =  phone ;//ok group
						CNA.Agent.website = $(this).find('agentInternetAddress').text();//ok

							//collect the agent info to save in the table
							CNA.Agent.info = "agentid = "+CNA.Agent.agentid;
							CNA.Agent.info += "&fullname = "+CNA.Agent.fullname;
							CNA.Agent.info += "&address = "+CNA.Agent.address;
							CNA.Agent.info += "&image = "+CNA.Agent.pictureUrl;
							CNA.Agent.info += "&email = "+CNA.Agentemail;
							CNA.Agent.info += "&phone = "+CNA.Agent.phone;
							$("#agent").val(CNA.Agent.info);
							//CNA.update_agent($(this).find('name').text());

					}
				});

				if (CNA.Agent.agentid!=null){
					var agent =  "Agent name="+CNA.Agent.fullname+"&image="+CNA.Agent.pictureUrl+"&email="+CNA.Agent.email;
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
			if (CNA.coming_from_facebook()==true){CNA.is_facebook = 'facebook';return false;};
			if (CNA.coming_from_agent()==true){CNA.is_agent = 'agent';return false;}
			CNA.is_agent = 'direct';
		},
		//*******************************************************************//

		init : function(){
			//set page title
			CNA.products = "aaaa";
			document.title = CNA.page_title;
			var script_name = CNA.sPath.substring(CNA.sPath.lastIndexOf('/') + 1);
	 		if (script_name==''){
	 			$("#logo").attr("href","img/logo-175x77.png");
				var pid = $("#ProspectId").val()*1 || null; //see if welcome form has been saved
				var is_pid = CNA.is_numeric(pid);//true if welcome is saved and pid created.
				var agent_input = $("#agent").val()||'';
				var found = agent_input.match(/\d{5}/)||agent_input.match(/agentid=\d{5}/)||agent_input.match(/agentid= \d{5}/)||null;
				found = found||'';
				if (is_pid==false && found.length<5){
					CNA.come_from();
					var comefrom = CNA.is_agent || CNA.is_facebook || null;
			 		$("#comefrom").val(comefrom);
				}else{
					CNA.come_from();
				}
				var comefrom = CNA.is_agent || CNA.is_facebook || null;
				if (comefrom=='facebook' || comefrom=='agent'){
					$("#findyouragent").remove();
					$("#meetyouragent .badge").html(4);
					$("#confirmation .badge").html(5);
				}
			}

	 		if (script_name=='findyouragent'){
	 			initialize();
	 		}

		}
	};
//**************************************************************************************************************************//
//**************************************************************************************************************************//
//**************************************************************************************************************************//
//**************************************************************************************************************************//
//**************************************************************************************************************************//
//**************************************************************************************************************************//
//**************************************************************************************************************************//
//**************************************************************************************************************************//
//**************************************************************************************************************************//

function mytest(i){
	//alert("aaaaaaaaaa"+agentList[i].agentId);
}

//when dom loaded completely.
$(document).ready(function(){
	CNA.init();
	var script_name = CNA.sPath.substring(CNA.sPath.lastIndexOf('/') + 1);
	var zipcode = $("#zipcode").val()||null;
	if (script_name=='findyouragent'){
		if (zipcode!=null){
			search_agent(zipcode);
		}
		$("#agentlist .sidebarAgentDivFocus").live("click", function() {
			CNA.Agent.fullname = $("#agentlist .sidebarAgentDivFocus .sidebarAgentName").text();
			var agentphone = $("#agentlist .sidebarAgentDivFocus .agentphone").text();
			CNA.Agent.address = $("#agentlist .sidebarAgentDivFocus .sidebarAddress").text();

			CNA.Agent.info = "agentid = "+CNA.Agent.agentid;
			CNA.Agent.info += "&fullname = "+CNA.Agent.fullname;
			CNA.Agent.info += "&address = "+CNA.Agent.address;
			CNA.Agent.info += "&image = "+CNA.Agent.pictureUrl;
			CNA.Agent.info += "&email = "+CNA.Agentemail;
			CNA.Agent.info += "&phone = "+CNA.Agent.phone;
			$("#agent").val(CNA.Agent.info);



		});



	}


	//clicks, submits actions
	// Hide Question fieldsets on launch & show them on click.
	$("#content .cna_fieldset_div .fieldset_label" ).on("click", function() {
		var id = $(this).closest("div").attr("id");
		$(".cna_fieldsets").hide();
		$(".cna_fieldset_div").removeClass("active_fieldset");
		$("#" + id + " .cna_fieldsets").show();
		$("#" + id + ".cna_fieldset_div").addClass("active_fieldset");
		if (id == 'findagent'){
			initialize();
		}
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


	function validate_inputs(){
		$("#tell-us input").each(function(index) {
		 	if ($(this).attr('required')=='required'){
		 		var inp = $(this).val() || 99;
		 			return inp;
		 	}
		 	return 1111;
		});
	 }

 	$('#ProspectAddForm').submit(function() {
 		if (flag==1){
 			return true;
 		}
 	});

 	$("#zipcodebtn").live('click', function(e){
 		var zipcode = $("#zipcode").val() || null;
 		if (zipcode==null){return false;}
 		search_agent(zipcode);
 	});
	function search_agent(zipcode){
	 if (zipcode=='' || zipcode==null){return false;}
		submitform(zipcode,'findagent');
		}

	// Except the first fieldset, which should open immediately when the site is loaded.
	$("#tell-us .cna_fieldsets").show();
	$("#tell-us").addClass("active_fieldset");


	$(':submit').live('mouseover', function(e){
		//$("#flashMessage").show();
		//$("#flashMessage").html("sdfsdfdsf");
	});

	$('.cna_nav_buttons').live('click', function(e){
		var flag = validate_inputs();
		alert(flag);

		//$("form").submit();
		return false;
	});

	//back button
	$('.back_button').live('click', function(e){
		var id = $(this).attr("id");
		var url = $(this).attr("alt");
		if (id!=''){
			document.location=url;
		}else{
			history.go(-1);
		}
		return false;
	});
	//forward button
	$('.forward_button').live('click', function(e){
		var id = $(this).attr("id");
		var url = $(this).attr("alt");
		if (id!=''){
			document.location=url;
		}else{
			history.go(-1);
		}
		return false;
	});

});//end of document