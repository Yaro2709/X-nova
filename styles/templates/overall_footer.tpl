{$cron}
<script type="text/javascript">
var serverTime = new Date({$date.0}, {$date.1 - 1}, {$date.2}, {$date.3}, {$date.4}, {$date.5});
var localTime = new Date();
localTS = localTime.getTime();
var ServerTimezoneOffset = {$date.6} + localTime.getTimezoneOffset()*60;
var Gamename	= document.title;
var Ready		= "{$ready}";
var Skin		= "{$dpath}";
var Lang		= "{$lang}";
var head_info	= "{$fcm_info}";
var auth		= {$authlevel};
</script>
<script type="text/javascript" src="{$cd}scripts/jQuery.js?v={$REV}"></script>
<script type="text/javascript" src="{$cd}scripts/base.js?v={$REV}"></script>
{foreach item=scriptname from=$scripts}
<script type="text/javascript" src="{$cd}scripts/{$scriptname}.js?v={$REV}"></script>
{/foreach}
<script type="text/javascript">
var timerHandler = new TimerHandler();
function UhrzeitAnzeigen()
{
    var Sekunden = serverTime.getSeconds();
    serverTime.setSeconds(Sekunden+1);
    if(document.getElementById("servertime"))
		document.getElementById("servertime").innerHTML = getFormatedDate(serverTime.getTime(), '[M] [D] [d] [H]:[i]:[s]');
}
UhrzeitAnzeigen();
setInterval("UhrzeitAnzeigen()", 1000);

{$execscript}

{if $ga_active}
var _gaq = _gaq || [];
_gaq.push(['_setAccount', '{$ga_key}']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
{/if}
{if $debug == 1}
onerror = handleErr;
{/if}
</script>
<script type="text/javascript" src="./scripts/gate.js"></script>
</div>
</body>
</html>