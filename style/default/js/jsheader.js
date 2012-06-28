var persistclose=0 //set to 0 or 1. 1 means once the bar is manually closed, it will remain closed for browser session
var startX = 5 //set x offset of bar in pixels
var startY = 25 //set y offset of bar in pixels
var verticalpos="fromtop" //enter "fromtop" or "frombottom"
var theObj="";  
var image="";
function toolTip(img,me) {  
       theObj=me;  
       theObj.onmousemove=updatePos;  
       image=img;
       window.onscroll=updatePos;  
}  
function updatePos() {  
       var ev=arguments[0]?arguments[0]:event;  
       var x=ev.clientX;  
       var y=ev.clientY;  
       diffX=24;  
       diffY=0;  
       theObj.src=image+'1.png'; 
       theObj.onmouseout=hideMe;  
}  
function hideMe() {  
      theObj.onmouseout=theObj.src=image+'.png'; 
}  
function OpenPopup() {
    window.open("../memberlist.php?t=1","List","scrollbars=no,resizable=no,width=800,height=600");
}

function GetRowValue(val) {
    window.opener.document.getElementById("receiver").value = val;
    window.close();
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function get_cookie(Name) {
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) {
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}