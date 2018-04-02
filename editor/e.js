var gIsInitEditor=0;var gHtmlId="HtmlEditor";var gSourceId="SourceEditor";var gTextId="TextEditor";var gEditorCurId=null;var gEditorPath = "/editor/";var gEditorToolBarId="editor_toolbar";var gEditorToolBarBtnContainerId="editor_toolbar_btn_container";var gEditorToolBarSet={};var gEditorTxtRange=null;var gEditorStopCurIni=false;var gScreenSnapObj=null;var gEditorMinHeight=null;var gIsPageLoadedFinish=false;var gContentId=null;var gFrame=0;var gsAgent=navigator.userAgent.toLowerCase();var gfAppVer=parseFloat(navigator.appVersion);var gIsOpera=gsAgent.indexOf("opera")>-1;var gIsKHTML=gsAgent.indexOf("khtml")>-1||gsAgent.indexOf("konqueror")>-1||gsAgent.indexOf("applewebkit")>-1;var gIsSafari=gsAgent.indexOf("applewebkit")>-1;var gIsIE=(gsAgent.indexOf("compatible")>-1&&!gIsOpera)||gsAgent.indexOf("msie")>-1;var gIsTT=gIsIE?(navigator.appVersion.indexOf("tencenttraveler")!=-1?1:0):0;var gIsFF=gsAgent.indexOf("gecko")>-1&&!gIsKHTML;if(gIsIE){var reIE=new RegExp("MSIE (\\d+\\.\\d+);","i");reIE.test(navigator.userAgent);var gIEVer=parseFloat(RegExp["$1"]);}
function RegFilter(str){return str.replace(/([\^\.\[\$\(\)\|\*\+\?\{\\])/ig,"\\$1");}
function Template(t,f){var _t=typeof(t)=="string"?t:(t.join?t.join(""):"");var _tD,_lD,_f=f?f:"$",_rf=RegFilter(_f);var rP=function(p){if(!_tD)
_lD=(_tD=_t.split(_f)).concat();for(var i=1,_len=_tD.length;i<_len;i+=2)
_lD[i]=p[_tD[i]];return _lD.join("");};var rRE=function(p){return _t.replace(new RegExp([_rf,"(.*?)",_rf].join(""),"ig"),function(m,v){return p[v];});};this.toString=function(){return _t;};this.replace=function(p,defaultFunc){return(defaultFunc=="parse"||!(document.all&&!(/opera/i.test(navigator.userAgent)))?rP:rRE)(p);};};function T(t,f){return new Template(t,f);}
var gd=document;function Gel(id,ob){return(ob||gd).getElementById(id);}
function GelTags(tag,ob){return(ob||gd).getElementsByTagName(tag);}
function S(i,win){try{return(win||window).document.getElementById(i);}
catch(e){return null;}}
function SO(i,o){return Gel(i,o);}
function SN(i,win){try{return(win||window).document.getElementsByName(i);}
catch(e){return null;}}
function SNO(i,o){return(o?o:gd).getElementsByName(i);}
function F(sID,win){if(!sID)
return null;var frame=S(sID,win);if(!frame)
return null;return frame.contentWindow||(win||window).frames[sID];}
function E(list,Func,start,end){if(!list)
return;if(list.constructor==Array){var len=list.length;for(var i=(start||0),end=end<0?(len+end):(end<len?end:len);i<end;i++)
try{Func(list[i],i,len);}catch(e){}}
else{for(var i in list)
try{Func(list[i],i);}catch(e){}}}
function GetSid(){try{var s=top.g_sid;}catch(e){}
s=s?s:(S("sid")?S("sid").value:"");if(!s){s=(top.location.href.split("?")[1]).split("&");s=s[0].split("=")[1];}
return s;}
function Show(obj,bShow){obj=(typeof(obj)=="string"?S(obj):obj);if(obj)obj.style.display=(bShow?"":"none");}
function fAddEvent(oTarget,sType,fHandler,bRemove){if(!oTarget)
return;if(oTarget.addEventListener){bRemove?oTarget.removeEventListener(sType,fHandler,false):oTarget.addEventListener(sType,fHandler,false);}
else if(oTarget.attachEvent){bRemove?oTarget.detachEvent("on"+sType,fHandler):oTarget.attachEvent("on"+sType,fHandler);}
else{oTarget["on"+sType]=bRemove?null:fHandler;}}
function fPreventDefault(oEvent){if(oEvent){if(oEvent.preventDefault){oEvent.preventDefault();}
else{oEvent.returnValue=false;}}}
function fIsInObj(nObj,oObj){if(!nObj||!oObj)
return false;if(typeof(oObj)=="string"?nObj.id==oObj:nObj==oObj)
return true;return fIsInObj(nObj.parentNode,oObj);}
function Trim(sStr){return sStr.replace(/(^\s*)|(\s*$)/ig,"");}
function StrReplace(s,o,d,mode){return s.replace(new RegExp(RegFilter(o),mode),d);}
function HighLight(filter,head,end){return function(str){return str.replace(new RegExp(["(",RegFilter(filter),")"].join(""),"ig"),[head,"$1",end].join(""));};}
function PutTextareaValue(o,val){if(o.tagName!="TEXTAREA"&&o.tagName!="textarea")return false;o.innerText!=null?o.innerText=val:o.value=val;return true;}
function GetTextareaValue(o){if(o.tagName!="TEXTAREA"&&o.tagName!="textarea")return null;return o.value;}
function HtmlDecode(s){return(s==null)?s:s.replace(/&lt;/g,"<").replace(/&gt;/g,">").replace(/&amp;/g,"&").replace(/&quot;/g,"\"");}
function HtmlEncode(s){return(s==null)?s:s.replace(/&/g,"&amp;").replace(/\"/g,"&quot;").replace(/</g,"&lt;").replace(/>/g,"&gt;");}
function TextToHtml(content){var res="<DIV>"+content.replace((content.indexOf("<BR>")>=0)?/<BR>/ig:/\n/g,"</DIV><DIV>")+"</DIV>";res=res.replace(new RegExp("\x0D","g"),"");res=res.replace(new RegExp("\x20","g"),"&nbsp;");res=res.replace(new RegExp("(<DIV><\/DIV>)*$","g"),"");return res.replace(/<DIV><\/DIV>/g,"<DIV>&nbsp;</DIV>");}
function HtmlToText(content){var res=content.replace(/<\/div>/ig,"\n");res=res.replace(/<\/p>/ig,"\n");return res.replace(/<br>/ig,"\n");}
function OutputEditorLoading(win){win=win||window;return['<div id="HtmlEditorLoading" style="position:absolute;*width:100%;">','<div class="infobar addrtitle" style="margin:1px;padding:2px;border:0;">',!win.IniEditor||!win.S?'<b style="color:red;">编辑器加载失败...请尝试清空缓存然后重新登陆邮箱！</b>':'&nbsp;&nbsp;数据加载中，数据量比较大，可能需要一定时间，请稍候...','</div>','</div>'].join("");}
function IniEditor(noinclude){if(gIsInitEditor==0){StartIniEditor(noinclude);}}
function StartIniEditor(noinclude)
{try
{gIsInitEditor=1;var l=location.href;var snews="";var s="";if(gFrame==1){if(gContentId!=null)s=document.getElementById(gContentId).value;}else{if(gContentId!=null)s=window.parent.document.getElementById(gContentId).value;}
var focusFunc;fEditorInit(s);try{focusFunc();}catch(e){}}
catch(e){setTimeout(function(){if(!gEditorStopCurIni)StartIniEditor(noinclude);},50);return;}}
function PutContent(content){switch(gEditorCurId){case gHtmlId:return fPutContent(content);case gSourceId:return PutTextareaValue(S(gSourceId),content);case gTextId:if(!fPutContent(gIsIE?content:HtmlToText(content)))return PutTextareaValue(S(gTextId),"数据加载失败!");return PutTextareaValue(S(gTextId),fGetPlainContent());}
return false;}
function GetContent(){switch(gEditorCurId){case gHtmlId:return fGetContent();case gSourceId:return GetTextareaValue(S(gSourceId));case gTextId:return GetTextareaValue(S(gTextId));}
return null;}
function fDispToolBar(flag){var tb=S(gEditorToolBarId);if(!tb&&flag==0)return;if(!tb){if(window.fGenToolBarHtml)fLoadEditorToolBarCallBack();}
fDisp(tb,flag);var t=S(gEditorToolBarBtnContainerId);if(t){t=t.childNodes;fDisp(t[0],2);fDisp(t[1],2);}}
function fLoadEditorToolBarCallBack(){if(S(gEditorToolBarId)||!gIsInitEditor)return;if(!S(gHtmlId)){setTimeout("fLoadEditorToolBarCallBack();",100);return;}
var d=document.createElement("div");d.innerHTML=fGenToolBarHtml();S(gHtmlId).parentNode.insertBefore(d,S(gHtmlId));}
function fGenHtml(dat,templ,bCustom){var code=[];for(var i=bCustom?1:0;i<dat.length;i++){var l=bCustom?dat[0].length:dat[i].length;for(var j=0;j<l;j++)
if(templ[j*2+1])templ[j*2+1]=bCustom?dat[i][dat[0][j]]:dat[i][j];code.push(templ.join(""));}
return code.join("");}
function fDisp(obj,flag){obj=(typeof(obj)=="string"?S(obj):obj);if(obj)obj.style.display=(flag==0?"none":(flag==2?(obj.style.display==""?"none":""):""));}
function fIsDisp(obj){obj=(typeof(obj)=="string"?S(obj):obj);if(obj)return obj.style.display!="none";return false;}
function fGetBreakLine(n){return(new Array((n||1)+1)).join(gIsIE?"<div>&nbsp;</div>":"<br>");}
function fPutContent(content){try{F(gHtmlId).document.body.innerHTML=content;fFixHtmlContent();}catch(e){return false;}
return true;}
function fGetContent(){var b=F(gHtmlId).document.body;return b?b.innerHTML:null;}
function fGetPlainContent(){var b=F(gHtmlId).document.body;return b?(b.innerText!=null?b.innerText:b.textContent):null;}
function fOnMenuMouseOver(obj){obj.className="editor_menu_mover";}
function fOnMenuMouseOut(obj){obj.className="editor_menu";}
function fSavePos(){if(document.selection)gEditorTxtRange=F(gHtmlId).document.selection.createRange();}
function fLoadPos(){if(gEditorTxtRange){fSetEditorFocus();gEditorTxtRange.select();gEditorTxtRange=null;}}
function fIndexCreater(a){var idx={};for(var i=a.length-1;i>=0;i--)idx[a[i]]=i;return idx;}
function fSetEditable(d){d=d||F(gHtmlId).document;if(d.designMode&&d.designMode.toString().toLowerCase()=="off")
d.designMode="on";else
d.body.contentEditable=true;try{d.execCommand("useCSS",false,false);}catch(e){}}
function fSetEditorContent(d,content){d.open();d.writeln(['<html>','<head><style>','body {padding:4px 4px;*padding:1px 4px;font:normal 14px Verdana;background:#fff}','body, p, font, div, li { line-height: 160%;}','pre {white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;}','</style></head>','<body>',content,'</body>','</html>'].join(""));d.close();}
function fSetEditorFocus(pos,d){var o=d&&d.parentWindow;var isWindow=true;if(!o){switch(gEditorCurId){case gHtmlId:o=F(gHtmlId);break;case gSourceId:case gTextId:o=S(gEditorCurId);isWindow=false;break;}}
if(isWindow){try{var obj=o.parent.document.activeElement;obj=obj&&obj.tagName=="IFRAME"?obj.contentWindow:null;if(o!=obj)
o.focus();}
catch(e){o.focus();}}
else{o.focus();}
if(typeof(pos)=="number")
{if(gIsIE){var r=o.createTextRange?o.createTextRange():o.document.body.createTextRange();r.moveStart("character",pos);r.collapse(true);r.select();}
else{if(o.document){o.getSelection().collapse(o.document.body,pos);}
else{o.selectionStart=pos;o.selectionEnd=pos;}}}}
function fSetToolBarChangeBtn(){var o=S(gEditorToolBarBtnContainerId);var t=T(["<a onclick='fDispToolBar($parm$);' unselectable='on' title='$title$' style='$style$'>","<input type='button'  style='background:url(",gEditorPath,"images/editoricon.gif) -514px -4px;","width:18px;height:14px;border:none;padding:0;vertical-align:middle!important;vertical-align:auto;'>","$text$","</a>"].join(""));if(o)
o.innerHTML=[t.replace({parm:1,title:"显示文字格式工具条",text:"文字格式↓"}),t.replace({parm:0,title:"隐藏格式编辑工具条",text:"文字格式↑",style:"display:none"})].join("");}
function fFixHtmlContent(d){if(gIsIE){E(GelTags("div",d||F(gHtmlId).document),function(node){var childs=node.childNodes;if(childs.length==1&&node.innerHTML=="&nbsp;")
node.innerHTML="";});}}
function fEditorOnLoad(content,bFocus){S(gHtmlId).hideFocus=true;var d=F(gHtmlId).document;gEditorCurId=gHtmlId;fSetEditorContent(d,content);fSetEditable(d);fFixHtmlContent(d);Show("HtmlEditorLoading",false);}
function fEditorInit(content,bTB,bTBP,bTBPinTB,bTBPSep,bTBPPhoto,bTBPMo,bTBPSnap,bTBPMusic,bFocus,sTBPUi,oTBSet){if(!S(gHtmlId)){return false;}
fEditorOnLoad(content,bFocus);var img=new Image();img.onload=img.onerror=function(){fSetToolBarChangeBtn();fDispToolBar(bTB,bTBPinTB);};img.src=[gEditorPath,"images/editoricon.gif"].join("");
return true;}
function DoProcess(){var c=GetContent();if(c==""||c==null||c==fGetBreakLine(1)||c==fGetBreakLine(1).toUpperCase().replace(/NBSP/g,"nbsp")){return false;}else{if(gFrame==1){document.getElementById(gContentId).value=c;}else{window.parent.document.getElementById(gContentId).value=c;}
return true;}}
function UnDoProcess(){var b=F(gHtmlId).document.body;b.innerHTML=fGetBreakLine(1);}
fAddEvent(window,"load",function(){gIsPageLoadedFinish=true;if(gIsInitEditor==0&&location.href.indexOf("readmail_group")==-1)
IniEditor(window.noinclude?window.noinclude:0);});fAddEvent(window,"unload",function(){})
var gTBPart=["base","style","format","more","html"];var gTBCmds=["bold","italic","underline","fontname","fontsize","forecolor",(gIsFF)?"hilitecolor":"backcolor","alignmode","serial","indent","createlink","picture"];var gTBCmdsIdx=fIndexCreater(gTBCmds);function fGenToolBarHtml(){var commHeadMenu=['<div style="background:url(',gEditorPath,'images/editoricon.gif)  -$left$px 0;width:$w$px;margin:$m$;height:17px;float:left;" unselectable="on"'].join("");var commTail='></div>';var partDisp=[];for(var i=0,len=gTBPart.length;i<len;i++)
{partDisp.push(gEditorToolBarSet[gTBPart[i]]==false?"display:none;":";");}
var dat=[["tb_"+gTBCmds[0],"0","19","0",partDisp[0],"加粗"]
,["tb_"+gTBCmds[1],"20","20","0",partDisp[0],"斜体"]
,["tb_"+gTBCmds[2],"40","20","0",partDisp[0],"下划线"]
,["-","320","3","-1px 3px 0 4px",partDisp[0],"间隔线"]
,["tb_"+gTBCmds[3],"60","20","0 2px",partDisp[1],"选择字体"]
,["tb_"+gTBCmds[4],"80","21","0 2px",partDisp[1],"字体大小"]
,["tb_"+gTBCmds[5],"240","20","0 2px",partDisp[1],"字体颜色"]
,["tb_"+gTBCmds[6],"260","20","0 2px",partDisp[1],"背景颜色"]
,["-","320","3","-1px 4px 0 2px",partDisp[1],"间隔线"]
,["tb_"+gTBCmds[7],"427","21","0 4px 0 0",partDisp[2],"对齐方式"]
,["tb_"+gTBCmds[8],"449","22","0 4px 0 0",partDisp[2],"编号"]
,["tb_"+gTBCmds[9],"470","22","0 4px 0 0",partDisp[2],"缩进"]
,["-","320","3","-1px 3px 0 1px",partDisp[2],"间隔线"]
,["tb_"+gTBCmds[10],"280","22","0",partDisp[3],"增加链接"]
,["tb_"+gTBCmds[11],"322","22","0",partDisp[4],"插入图片"]];var templ=(['<div id="$id$" style="background:url(',gEditorPath,'images/editoricon.gif) -$left$px 0;width:$w$px;margin:$m$;$s$" class="editor_btn" unselectable="on"  title="$title$" onmousedown=fOnTBMouseDown(this) onmouseover=fOnTBMouseOver(this) onmouseout=fOnTBMouseOut(this) onmouseup=fOnTBMouseOver(this)></div>'].join("")).split("$");var code=["<div id='",gEditorToolBarId,"' class='editor_toolbar' unselectable='on'>","<div id='editor_toolbar_comm' style='float:left;margin:0 4px;''>",fGenHtml(dat,templ),"<div id='editor_toolbarplus' style='float:left;'></div>","</div>","<div class='editor_abtn' id='editor_htmlbtn' onclick='fChangeEditor(1);' unselectable='on'  style='",partDisp[4],"' title='编辑HTML源码'>&lt;HTML&gt;</div>","<div class='editor_abtn' id='editor_sourcebtn' style='display:none;' onclick='fChangeEditor();' unselectable='on' title='预览效果'>预览<b>&#187;</b></div>","</div>"];var menuH='<div class="editor_menu" unselectable="on" onmouseover=fOnMenuMouseOver(this) onmouseout=fOnMenuMouseOut(this) para="$v$" ';var menuT='</div>';var colorDat=[[0,0]
,['000000'],['993300'],['333300'],['003300'],['003366'],['000080'],['333399'],['333333']
,['800000'],['FF6600'],['808000'],['008000'],['008080'],['0000FF'],['666699'],['808080']
,['FF0000'],['FF9900'],['99CC00'],['339966'],['33CCCC'],['3366FF'],['800080'],['999999']
,['FF00FF'],['FFCC00'],['FFFF00'],['00FF00'],['00FFFF'],['00CCFF'],['993366'],['C0C0C0']
,['FF99CC'],['FFCC99'],['FFFF99'],['CCFFCC'],['CCFFFF'],['99CCFF'],['CC99FF'],['FFFFFF']];var colorDat2=colorDat.slice(0);for(var i=colorDat2.length-1;i>0;i--)colorDat2[i].push('&nbsp;',gIsIE?14:12,gIsIE?12:10);colorDat2[0]=[0,2,3,0,1];var dat=[[[0,"cc0000","00b085","00b085","663399","00ade5","663399","0066cc","00ade5"]]
,[[2,"eb4200","a90005","a90005","d13800","bc4b00","eb4200","a90005","bc4b00"]]
,[[3,"00d1aa","00a9eb","00bc78","00a957","00cfb7","00ebc3","00bcb2","#00ebc3"]]
,[[1,"0071bc","00a9eb","295caa","00a9eb","0089cf","0089cf","00a9eb","0099d1"]]];var tf="<font unselectable=on color=#$c$>";for(var i=0;i<4;i++)colorDat2.push(['_RFC'+dat[i][0][0],fGenHtml(dat[i],(['<center style="font-size:12px;margin-top:-1;" para=_RFC$i$>',tf,'A</font>',tf,'B</font>',tf,'C</font>',tf,'D</font>',tf,'a</font>',tf,'b</font>',tf,'c</font>',tf,'d</font></center>'].join("")).split("$")),138,136]);dat=[["mutb_"+gTBCmds[3],"0",gIsIE?"3":"0","116"
,[[0,0,1]
,["宋体","宋体"]
,["黑体","黑体"]
,["楷体_GB2312","楷书"]
,["幼圆","幼圆"]
,["Arial","Arial"]
,["Arial Black","Arial Black"]
,["Times New Roman","Times New Roman"]
,["Verdana","Verdana"]]
,[menuH,' style="font:normal 12px $f$">$c$',menuT].join("")]
,["mutb_"+gTBCmds[4],"0",gIsIE?"3":"0","116"
,[[0,1,2]
,[1,"xx-small;","小"]
,[2,"x-small;","中"]
,[4,"medium;","大"]
,[5,"large;line-height:28px;height:26px;","较大"]
,[6,"x-large;line-height:36px;height:34px;","最大"]]
,[menuH,' style="font-size:$s$">$c$',menuT].join("")]
,["mutb_"+gTBCmds[5],"0",gIsIE?"3":"0","150"
,colorDat2
,[menuH,' style="font-size:1px;width:$w$px;height:12px!important;height:14px;height:/**/14px;float:left;"><div unselectable="on" style="width:$w$px;height:10px!important;height:12px;height:/**/12px;background:#$c$;border:1px solid #a6a6a6;">$c$</div>',menuT].join("")]
,["mutb_"+gTBCmds[6],"0",gIsIE?"3":"0","150"
,colorDat
,[menuH,' style="font-size:1px;width:12px!important;width:14px;width:/**/14px;height:12px!important;height:14px;height:/**/14px;float:left;"><div unselectable="on" style="width:10px!important;width:12px;width:/**/12px;height:10px!important;height:12px;height:/**/12px;background:#$c$;border:1px solid #a6a6a6;">&nbsp;</div>',menuT].join("")]
,["mutb_"+gTBCmds[7],"0",gIsIE?"3":"0","100"
,[[0,1,2,3,4,5]
,["justifyleft","100","20","-3px 0 0 0","&nbsp;左对齐","&nbsp;左对齐"]
,["justifycenter","120","20","-3px 0 0 0","&nbsp;居中对齐","&nbsp;居中对齐"]
,["Justifyright","140","20","-3px 0 0 0","&nbsp;右对齐","&nbsp;右对齐"]]
,[menuH,'>',commHeadMenu,commTail,'$c$',menuT].join("")]
,["mutb_"+gTBCmds[8],"0",gIsIE?"3":"0","100"
,[[0,1,2,3,4,5]
,["insertorderedlist","160","20","-3px 0 0 0","&nbsp;数字编号","&nbsp;数字编号"]
,["insertunorderedlist","180","20","-3px 0 0 0","&nbsp;项目编号","&nbsp;项目编号"]]
,[menuH,'>',commHeadMenu,commTail,'$c$',menuT].join("")]
,["mutb_"+gTBCmds[9],"0",gIsIE?"3":"0","100"
,[[0,1,2,3,4,5]
,["indent","220","20","-3px 0 0 0","&nbsp;向右缩进","&nbsp;向右缩进"]
,["outdent","200","20","-3px 0 0 0","&nbsp;向左缩进","&nbsp;向左缩进"]]
,[menuH,'>',commHeadMenu,commTail,'$c$',menuT].join("")]
,["mutb_"+gTBCmds[10],"0",gIsIE?"3":"0","220"
,[[0,1,2]
,["mutb_"+gTBCmds[10]+"_alert","padding:14px 0 10px 0;","请先选择要加入链接的文字<div  unselectable='on' style='margin:10px 0 0 0'><input type=button class='wd2 btn' value=重新选择></div>"]
,["mutb_"+gTBCmds[10]+"_prompt","padding:14px 0 10px 0;","<div unselectable='on' style='margin:0 0 2px 5px;text-align:left;'>请输入链接的目标地址：</div><div unselectable='on'><input id='mutb_"+gTBCmds[10]+"_url' type=text style='width:200px;' class='txt' value='http://' /></div><div style='margin:2px 0 0 5px;font-size:11px;text-align:left;' class='addrtitle'>(例如: http://www.7gz.cn/)</div><div unselectable='on' style='margin-top:5px;'><input id='mutb_"+gTBCmds[10]+"_ok' class='wd1 btn' type=button value=' 确定 '><input class='wd1 btn' type=button value=' 取消 '></div>"]]
,"<div id='$id$' style='display:none;font:12px normal Verdana;width:100%;text-align:center;$s$' unselectable='on'>$c$</div>"]
,["mutb_"+gTBCmds[11],"0",gIsIE?"3":"0","350"
,[[0,1,2]
,["mutb_"+gTBCmds[11]+"_alert","padding:5px 0 0 0;","<div unselectable='on' style='margin:0 0 2px 5px;text-align:left;'></div>"]
,["mutb_"+gTBCmds[11]+"_pic","padding:3px 0 0 0;","<table unselectable='on' width='80%' border='0' cellspacing='0' cellpadding='0'><tr><td width='0' height='0' align='left'></td><td><iframe width=350 height=24 src='"+gEditorPath+"upapi/upload.php' scrolling='no' frameborder='0'></iframe></td></tr><tr><td height='0' align='left'></td><td><input type='text' name='picture' id='picture' style='width:220px;' value='http://'></td></tr></table><div unselectable='on' style='margin-top:5px;'><input id='mutb_"+gTBCmds[11]+"_ok' class='wd1 btn' type=button value=' 确定 '><input class='wd1 btn' type=button value=' 取消 '></div>"]]
,"<div id='$id$' style='display:none;font:12px normal Verdana;width:100%;text-align:center;$s$' unselectable='on'>$c$</div>"]];for(var i=dat.length-1;i>=0;i--){code.push(['<div id="',dat[i][0],'" class="editor_board" offsetLPos="',dat[i][1],'" offsetTPos="',dat[i][2],'" style="width:',dat[i][3],'px;display:none;margin-top:0;" unselectable="on">',fGenHtml(dat[i][4],(dat[i][5]).split("$"),1),'</div>'].join(""));}
fSetTBEvent();return code.join("");}
function fSetTBEvent(){fAddEvent(document,"click",fTBOnClickHandle);fAddEvent(document,"keypress",fTBOnKeyPressHandle);}
function fContinuousTagPos(content,opt){var l=content.length;var tag1=opt?">":"<";var tag2=opt?"<":">";var step=opt?-1:1;var condition=opt?1:l;var status=0;for(var i=opt?l-1:0;step*i<condition;i+=step){var c=content.charAt(i);if(c=="\n"||c=="\r")continue;if(c==tag1){status=1;}
else if(status!=1){break;}
else if(c==tag2){status=0;}}
return i;}
function fTBOnClickHandle(e){var o=e.srcElement||e.target;var tmp=gTBCmdsIdx[o.id.replace(/^tb_/,"")];if(tmp>=0&&tmp<=2){fHideTBMenu();return fTBExecCmd(gTBCmds[tmp]);}
if(tmp>=2&&tmp<=10){if(tmp==10){fSavePos();var f=F(gHtmlId);try{var b=(f.getSelection!=null?!f.getSelection().getRangeAt(0).collapsed:f.document.selection.createRange().htmlText.length>0);}catch(e){var b=true;}
fDisp("mu"+o.id+"_alert",!b);fDisp("mu"+o.id+"_prompt",b);}
return fIsDisp("mu"+o.id)?fHideTBMenu():fDispTBBoard("mu"+o.id);}
if(tmp==11){fSavePos();fDisp("mu"+o.id+"_alert",b);fDisp("mu"+o.id+"_pic",b);return fIsDisp("mu"+o.id)?fHideTBMenu():fDispTBBoard("mu"+o.id);}
for(var i=gTBCmds.length-1;i>=0;i--){if(fIsInObj(o,"mutb_"+gTBCmds[i])){tmp=o.getAttribute("para")?o.getAttribute("para"):o.parentNode.getAttribute("para");if(tmp){fHideTBMenu();if(tmp.indexOf("_RFC")==0)return fRandomFontColor(parseInt(tmp.substr(4)));(i>=7&&i<=9)?fTBExecCmd(tmp):fTBExecCmd(gTBCmds[i],tmp);}
else if(i==10){if(o.type=="button"){fHideTBMenu();fLoadPos();}
if(o.id=="mutb_"+gTBCmds[10]+"_ok"){fCreateLink();}}else if(i==11){if(o.type=="button"&&o.id=="mutb_"+gTBCmds[11]+"_ok"){var UpPic=window.document.getElementById('picture').value;if(UpPic!=""&&UpPic!=null&&UpPic!="http://"){UpPic=UpPic.replace(/\\/g,"/");try{fTBPInsertPic(URLFieldEncode(UpPic));}catch(e){alert(e.description);}}}
fHideTBMenu();fLoadPos();}
return;}}
fHideTBMenu();}
function fTBOnKeyPressHandle(e){var o=e.srcElement||e.target;if(o.id=="mutb_"+gTBCmds[10]+"_url"&&(e.keyCode==13||e.keyCode==10)){fLoadPos();fCreateLink();fHideTBMenu();fPreventDefault(e);}}
function fSetBorderMouse(obj,flag)
{if(obj.title=="间隔线")return;obj.className=(flag==0?"editor_btn_mover":flag==1?"editor_btn_mdown":"editor_btn");}
function fOnTBMouseOver(obj){fSetBorderMouse(obj,0);}
function fOnTBMouseDown(obj){fSetBorderMouse(obj,1);}
function fOnTBMouseOut(obj){fSetBorderMouse(obj,2);}
function fChangeEditor(flag){var d=S("editor_source_span");var h=S(gHtmlId);var c=(gEditorCurId==gHtmlId);if((c&&!flag)||(!c&&flag==1)||gEditorCurId==gTextId)return;if(!d){var d=document.createElement("div");d.id="editor_source_span";d.innerHTML=["<textarea  class=editor_source id='",gSourceId,"' style='height:",(parseInt(h.style.height)+2),"px;font-family:宋体;'></textarea>"].join("");fDisp(d,0);h.nextSibling?h.parentNode.insertBefore(d,h.nextSibling):h.parentNode.appendChild(d);}
var s=S(gSourceId);gEditorCurId=c?gSourceId:gHtmlId;PutContent(c?fGetContent():GetTextareaValue(s));fDisp(h,2);fDisp(d,2);fDisp(S("editor_toolbar_comm"),2);fDisp(S("editor_sourcebtn"),2);fDisp(S("editor_htmlbtn"),2);fDisp(S("editor_format"),2);fDisp(S("editor_formatting"),0);fSetEditorFocus();}
function fDispTBBoard(obj,nLeft){if(obj=="mupicture")return false;obj=(typeof(obj)=="string"?S(obj):obj);var o=S(obj.id.replace(/^mu/,""));var ol=0,ot=0,oh=o.offsetHeight;for(;o;o=o.offsetParent){ol+=o.offsetLeft;ot+=o.offsetTop;}
obj.style.left=ol+parseInt(obj.getAttribute("offsetLPos"));obj.style.top=ot+oh+parseInt(obj.getAttribute("offsetTPos"));fHideTBMenu();fDisp(obj,1);}
function fHideTBMenu(){for(var i=gTBCmds.length-1;i>=0;i--)
fDisp(S("mutb_"+gTBCmds[i]),0);}
function StringReplaceAll(Str,Src,NewStr){if(!Str||Str.length==0)return"";return Str.split(Src).join(NewStr);}
function URLFieldEncode(str){var arr=["%","%25"
,' ',"%20"
,"&","%26"
,"#","%23"
,"+","%2b"
,"-","%2d"];for(var i=0,len=arr.length;i<len;i+=2)
str=StringReplaceAll(str,arr[i],arr[i+1]);return str;}
function fTBPInsertPic(para){fLoadPos();var doc=F(gHtmlId).document;var r=doc.selection?doc.selection.createRange():null;fSetEditorFocus();doc.execCommand("InsertImage",false,para!=null?para:false);if(r!=null){try{r.move("character");r.select();}catch(e){}}}
function fTBExecCmd(type,para){fSetEditorFocus();F(gHtmlId).document.execCommand(type,false,para!=null?para:false);}
function fCreateLink(){var u=S("mutb_"+gTBCmds[10]+"_url").value;if(u){u=!((u.indexOf("://")>1)||(u.indexOf(":\\")>1))?"http://"+u:u;fTBExecCmd(gTBCmds[10],u);}}
function fTrimCR(str,bNn){return bNn?str.replace(/\r/ig,""):str.replace(/\n|\r/ig,"");}
function fRandomFontColor(mode){var f=F(gHtmlId);try{if(!(f.getSelection!=null?!f.getSelection().getRangeAt(0).collapsed:f.document.selection.createRange().htmlText.length>0))return;}catch(e){}
var html=fTrimCR(GetContent());if(f.getSelection!=null){var r=f.getSelection().getRangeAt(0);var code=f.document.createElement("div");code.appendChild(r.cloneContents());code=code.innerHTML;r.deleteContents();f.getSelection().getRangeAt(0).insertNode(f.document.createTextNode("/*=qqmail_selection=*/"));}
else{var r=f.document.selection.createRange();var aSavePoint=[r.offsetLeft,r.offsetTop,fTrimCR(r.text,1).length,f.document.body.scrollTop];var code=r.htmlText;r.pasteHTML("/*=qqmail_selection=*/");}
code=fTrimCR(code);var c=fTrimCR(GetContent());gIsIE?fTBExecCmd("undo"):PutContent(html);c=c.split("/*=qqmail_selection=*/");c[0]=c[0].substring(0,fContinuousTagPos(c[0],1)+1);var p=html.indexOf(code,c[0].length);if(p==-1){var len=c[0].length;var ap=[fContinuousTagPos(code),fContinuousTagPos(code,1)+1];var tmp=code.substring(ap[0],code.length);p=html.indexOf(tmp,len);if(p==-1){tmp=code.substring(0,ap[1]);p=html.indexOf(tmp,len);if(p==-1){tmp=code.substring(ap[0],ap[1]);p=html.indexOf(tmp,len);if(p==-1)return;}}
code=tmp;}
c[0]=html.substring(0,p);c[1]=html.substring(p+code.length,html.length);html=code;code=null;RandomFontColor(html,mode,function(result){var p=[c[0].length,result.length];f.focus();PutContent(c.join(result));setTimeout(function(){if(gIsIE){f.document.body.scrollTop=aSavePoint[3];r=f.document.selection.createRange();r.moveToPoint(aSavePoint[0],aSavePoint[1]);r.moveEnd("character",aSavePoint[2]);r.select();}},0);});}
try{fLoadEditorToolBarCallBack();}catch(e){}
var g_rfc_rgb=[["cc6633","cc0000","663399","0066cc","00ade5","00b085"]
,["124d7e","295caa","0071bc","0089cf","0099d1","00a9eb","00abbc","00a9a4"]
,["7e4312","aa7729","bc4b00","d13800","eb4200","a90005"]
,["00bcb2","00cfb7","00d1aa","00ebc3","00bc78","00a957"]];var g_rfc_color_arr=["<font color=#",""," qq>","","</font>"];function GenColorCode(str,m){m=m?m:0;g_rfc_color_arr[1]=g_rfc_rgb[m][parseInt(Math.random()*1000)%g_rfc_rgb[m].length];g_rfc_color_arr[3]=str;return g_rfc_color_arr.join("");}
var g_tmCharColor=["lt","gt","amp","quot","reg","copy","trade"]
var g_tmCharNoColor=["ensp","emsp","nbsp"];var g_tmCharMaxLen=5;function IsTmChar(str,color){var a=color?g_tmCharColor:g_tmCharNoColor;for(var i=a.length-1;i>=0;i--){if(str==a[i])return true;}
return false;}
var g_rfc_max_once=600;var g_rfc_content=null;var g_rfc_content_l=0;var g_rfc_result=null;var g_rfc_status=0;var g_rfc_font_num=0;var g_rfc_font_pos=null;var g_rfc_tag_pos=0;var g_rfc_del_font=null;var g_rfc_stop=0;var g_rfc_fcallback=null;function RandomFontColor(content,mode,fcallback){if(fcallback==null||content==null)return;fChangeEditor(0);g_rfc_content=content;g_rfc_content_l=content.length;g_rfc_result=new Array();g_rfc_status=0;g_rfc_font_num=0;g_rfc_font_pos=new Array();g_rfc_del_font=new Array();g_rfc_tag_pos=0;g_rfc_stop=0;g_rfc_fcallback=fcallback;mode=mode?mode:0;setTimeout("RandomFontColorPercent("+mode+")",0);}
function RandomFontColorPercent(mode,pos){if(pos==null){if(g_rfc_content_l>=g_rfc_max_once){ModelDialog(1,"随机前景色处理进度","<div style='padding:20px 0 10px 0;'><div style='width:260px;border:1px solid #969696;position:relative;height:12px;background:#fff;'><div id='randcolor_pencent_bar' style='width:0%;border:1px solid #84EE57;background:#C5EDB4;position:absolute;left:-1;top:-1px;font:8px;height:12px;'></div></div></div><div style='align:left;width:260px;'>正在对字体进行随机颜色渲染中...<span id='randcolor_pencent' style='color:#00A2A2;'></span></div>");}
setTimeout("RandomFontColorPercent("+mode+",0)",0);return;}
if(pos>=g_rfc_content_l){for(var i=0;i<g_rfc_font_pos.length;i++)g_rfc_result.push(g_rfc_del_font[i]);if(g_rfc_fcallback){g_rfc_fcallback(g_rfc_result.join(""));}
g_rfc_content=null;g_rfc_result=null;g_rfc_fcallback=null;g_rfc_font_pos=null;g_rfc_del_font=null;return HideModelDialog();}
if(g_rfc_stop==1){g_rfc_content=null;g_rfc_result=null;g_rfc_fcallback=null;g_rfc_font_pos=null;g_rfc_del_font=null;return HideModelDialog();}
var i=pos;for(;i<(g_rfc_max_once+pos)&&i<g_rfc_content_l;i++){var v=g_rfc_content.charAt(i);switch(v){case"　":case" ":case"	":case"\n":case"\r":case"\t":break;case"&":if(g_rfc_status!=0)break;var _a=new Array();var j=i+1;var _l=j+g_tmCharMaxLen+1;_l=_l<g_rfc_content_l?_l:g_rfc_content_l;var _v;for(;j<_l;j++){_v=g_rfc_content.charAt(j);if(_v==";")break;_a.push(_v);}
if(_v==";"){i=j;_a=_a.join("");v="&"+_a+";";if(IsTmChar(_a,0))break;}
v=mode==-1?v:GenColorCode(v,mode);break;case"<":if(g_rfc_status!=0)break;g_rfc_tag_pos=i;g_rfc_status=1;var tag=g_rfc_content.substr(i+1,5).toUpperCase();if(tag=="FONT "||tag=="FONT>"){g_rfc_font_num++;g_rfc_status=2;}
else if(tag=="/FONT"){if(g_rfc_font_num!=0&&g_rfc_font_num==g_rfc_font_pos.slice(-1)){g_rfc_font_pos.pop();g_rfc_del_font.pop();i=i+6;g_rfc_font_num--;g_rfc_status=0;continue;}
if(g_rfc_font_num>0)g_rfc_font_num--;}
break;case">":if(g_rfc_status==0){v=mode==-1?v:GenColorCode(v,mode);}
else{if(g_rfc_status==2&&g_rfc_font_pos.slice(-1)==g_rfc_font_num){g_rfc_del_font.push(g_rfc_result.slice(g_rfc_tag_pos-i).join("")+">");g_rfc_result=g_rfc_result.slice(0,g_rfc_tag_pos-i);g_rfc_status=0;continue;}
g_rfc_status=0;}
break;default:if(g_rfc_status==0)v=mode==-1?v:GenColorCode(v,mode);if(g_rfc_status==2&&v=="q"&&g_rfc_content.charAt(i-1)==" "&&g_rfc_content.charAt(i+1)=="q")g_rfc_font_pos.push(g_rfc_font_num);break;}
g_rfc_result.push(v);}
g_rfc_stop=1;setTimeout("RandomFontColorPercent("+mode+","+i+")",0);}