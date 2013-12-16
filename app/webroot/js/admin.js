// admin.js	
startTimer();
function expireSession()
{
	window.location = "./users/logout";
}
function startTimer(){
	if($('body').attr('id') != 'login'){
  timeoutTimer = setTimeout('expireSession()',870000 ); // calls logout after 14:30 mins of inactivity 870000
	}
}
function clearTimer(){
  clearTimeout(timeoutTimer);
}