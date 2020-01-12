var animatedcollapse={divholders:{},divgroups:{},lastactiveingroup:{},preloadimages:[],show:function(divids){if(typeof divids=="object"){for(var i=0;i<divids.length;i++)
this.showhide(divids[i],"show")}
else
this.showhide(divids,"show")},hide:function(divids){if(typeof divids=="object"){for(var i=0;i<divids.length;i++)
this.showhide(divids[i],"hide")}
else
this.showhide(divids,"hide")},toggle:function(divid){if(typeof divid=="object")
divid=divid[0]
this.showhide(divid,"toggle")},addDiv:function(divid,attrstring){this.divholders[divid]=({id:divid,$divref:null,attrs:attrstring})
this.divholders[divid].getAttr=function(name){var attr=new RegExp(name+"=([^,]+)","i")
return(attr.test(this.attrs)&&parseInt(RegExp.$1)!=0)?RegExp.$1:null}
this.currentid=divid
return this},showhide:function(divid,action){var $divref=this.divholders[divid].$divref
if(this.divholders[divid]&&$divref.length==1){var targetgroup=this.divgroups[$divref.attr('groupname')]
if($divref.attr('groupname')&&targetgroup.count>1&&(action=="show"||action=="toggle"&&$divref.css('display')=='none')){if(targetgroup.lastactivedivid&&targetgroup.lastactivedivid!=divid)
this.slideengine(targetgroup.lastactivedivid,'hide')
this.slideengine(divid,'show')
targetgroup.lastactivedivid=divid}
else{this.slideengine(divid,action)}}},slideengine:function(divid,action){var $divref=this.divholders[divid].$divref
var $togglerimage=this.divholders[divid].$togglerimage
if(this.divholders[divid]&&$divref.length==1){var animateSetting={height:action}
if($divref.attr('fade'))
animateSetting.opacity=action
$divref.animate(animateSetting,$divref.attr('speed')?parseInt($divref.attr('speed')):500,function(){if($togglerimage){$togglerimage.attr('src',($divref.css('display')=="none")?$togglerimage.data('srcs').closed:$togglerimage.data('srcs').open)}
if(animatedcollapse.ontoggle){try{animatedcollapse.ontoggle(jQuery,$divref.get(0),$divref.css('display'))}
catch(e){alert("An error exists inside your \"ontoggle\" function:\n\n"+e+"\n\nAborting execution of function.")}}})
return false}},generatemap:function(){var map={}
for(var i=0;i<arguments.length;i++){if(arguments[i][1]!=null){map[arguments[i][0]]=arguments[i][1]}}
return map},init:function(){var ac=this
jQuery(document).ready(function($){animatedcollapse.ontoggle=animatedcollapse.ontoggle||null
var urlparamopenids=animatedcollapse.urlparamselect()
var persistopenids=ac.getCookie('acopendivids')
var groupswithpersist=ac.getCookie('acgroupswithpersist')
if(persistopenids!=null)
persistopenids=(persistopenids=='nada')?[]:persistopenids.split(',')
groupswithpersist=(groupswithpersist==null||groupswithpersist=='nada')?[]:groupswithpersist.split(',')
jQuery.each(ac.divholders,function(){this.$divref=$('#'+this.id)
if((this.getAttr('persist')||jQuery.inArray(this.getAttr('group'),groupswithpersist)!=-1)&&persistopenids!=null){var cssdisplay=(jQuery.inArray(this.id,persistopenids)!=-1)?'block':'none'}
else{var cssdisplay=this.getAttr('hide')?'none':null}
if(urlparamopenids[0]=="all"||jQuery.inArray(this.id,urlparamopenids)!=-1){cssdisplay='block'}
else if(urlparamopenids[0]=="none"){cssdisplay='none'}
this.$divref.css(ac.generatemap(['height',this.getAttr('height')],['display',cssdisplay]))
this.$divref.attr(ac.generatemap(['groupname',this.getAttr('group')],['fade',this.getAttr('fade')],['speed',this.getAttr('speed')]))
if(this.getAttr('group')){var targetgroup=ac.divgroups[this.getAttr('group')]||(ac.divgroups[this.getAttr('group')]={})
targetgroup.count=(targetgroup.count||0)+1
if(jQuery.inArray(this.id,urlparamopenids)!=-1){targetgroup.lastactivedivid=this.id
targetgroup.overridepersist=1}
if(!targetgroup.lastactivedivid&&this.$divref.css('display')!='none'||cssdisplay=="block"&&typeof targetgroup.overridepersist=="undefined")
targetgroup.lastactivedivid=this.id
this.$divref.css({display:'none'})}})
jQuery.each(ac.divgroups,function(){if(this.lastactivedivid&&urlparamopenids[0]!="none")
ac.divholders[this.lastactivedivid].$divref.show()})
if(animatedcollapse.ontoggle){jQuery.each(ac.divholders,function(){animatedcollapse.ontoggle(jQuery,this.$divref.get(0),this.$divref.css('display'))})}
var $allcontrols=$('a[rel]').filter('[rel^="collapse["], [rel^="expand["], [rel^="toggle["]')
$allcontrols.each(function(){this._divids=this.getAttribute('rel').replace(/(^\w+)|(\s+)/g,"").replace(/[\[\]']/g,"")
if(this.getElementsByTagName('img').length==1&&ac.divholders[this._divids]){animatedcollapse.preloadimage(this.getAttribute('data-openimage'),this.getAttribute('data-closedimage'))
$togglerimage=$(this).find('img').eq(0).data('srcs',{open:this.getAttribute('data-openimage'),closed:this.getAttribute('data-closedimage')})
ac.divholders[this._divids].$togglerimage=$(this).find('img').eq(0)
ac.divholders[this._divids].$togglerimage.attr('src',(ac.divholders[this._divids].$divref.css('display')=="none")?$togglerimage.data('srcs').closed:$togglerimage.data('srcs').open)}
$(this).click(function(){var relattr=this.getAttribute('rel')
var divids=(this._divids=="")?[]:this._divids.split(',')
if(divids.length>0){animatedcollapse[/expand/i.test(relattr)?'show':/collapse/i.test(relattr)?'hide':'toggle'](divids)
return false}})})
$(window).bind('unload',function(){ac.uninit()})})},uninit:function(){var opendivids='',groupswithpersist=''
jQuery.each(this.divholders,function(){if(this.$divref.css('display')!='none'){opendivids+=this.id+','}
if(this.getAttr('group')&&this.getAttr('persist'))
groupswithpersist+=this.getAttr('group')+','})
opendivids=(opendivids=='')?'nada':opendivids.replace(/,$/,'')
groupswithpersist=(groupswithpersist=='')?'nada':groupswithpersist.replace(/,$/,'')
this.setCookie('acopendivids',opendivids)
this.setCookie('acgroupswithpersist',groupswithpersist)},getCookie:function(Name){var re=new RegExp(Name+"=[^;]*","i");if(document.cookie.match(re))
return document.cookie.match(re)[0].split("=")[1]
return null},setCookie:function(name,value,days){if(typeof days!="undefined"){var expireDate=new Date()
expireDate.setDate(expireDate.getDate()+days)
document.cookie=name+"="+value+"; path=/; expires="+expireDate.toGMTString()}
else
document.cookie=name+"="+value+"; path=/"},urlparamselect:function(){window.location.search.match(/expanddiv=([\w\-_,]+)/i)
return(RegExp.$1!="")?RegExp.$1.split(","):[]},preloadimage:function(){var preloadimages=this.preloadimages
for(var i=0;i<arguments.length;i++){if(arguments[i]&&arguments[i].length>0){preloadimages[preloadimages.length]=new Image()
preloadimages[preloadimages.length-1].src=arguments[i]}}}}