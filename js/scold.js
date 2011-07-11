function setCookie(c_name,value,expiredays) { var exdate=new Date(); exdate.setDate(exdate.getDate()+expiredays); document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString()); }

function getCookie(c_name) { if (document.cookie.length>0) { c_start=document.cookie.indexOf(c_name + "="); if (c_start!=-1) { c_start=c_start + c_name.length+1; c_end=document.cookie.indexOf(";",c_start); if (c_end==-1) c_end=document.cookie.length; return unescape(document.cookie.substring(c_start,c_end)); } } return ""; }

scolded = getCookie('scolded');
if (scolded == null || scolded == "") {
	alert("Hey there old timer! You're using an old web browser, so some things won't look right here. I guess you like it this way.");
	setCookie('scolded', true, 365);
}

/* IE-special rendering code. */
var code = document.createTextNode('<center>');
stuff = document.getElementById("page").innerHTML;
document.getElementById("page").innerHTML = code+stuff;