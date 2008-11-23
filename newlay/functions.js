function LoadImage() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=LoadImage.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function ImageRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function ImageObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=ImageObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function ShowImage() { //v3.0
  var i,j=0,x,a=ShowImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=ImageObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function LoadBG(tag,classe)
{
	tag.className = classe;
}

function MouseOverBigButton(source)
{
  source.firstChild.style.visibility = "visible";
}
function MouseOutBigButton(source)
{
  source.firstChild.style.visibility = "hidden";
}

function _g(id)
{
	return document.getElementById(id);
}

function newsTicker(id)
{
	var showPlace = _g("fn_sh_" + id);
	var abrevTxt = _g("fn_ab_" + id);
	var completeTxt = _g("fn_cp_" + id);
	var img = _g("fn_img_" + id);
	
	if(showPlace.innerHTML == abrevTxt.innerHTML) {
		showPlace.innerHTML = completeTxt.innerHTML;
		img.src = LAYOUT_DIR + "/images/general/minus.gif";
	} else {
		showPlace.innerHTML = abrevTxt.innerHTML;
		img.src = LAYOUT_DIR + "/images/general/plus.gif";
	}		
}

function HideTicker(id) {
	var objct = _g(id);
	if(objct.style.display == "none") {
		objct.style.display = "";
	} else {
		objct.style.display = "none";
	}
}

