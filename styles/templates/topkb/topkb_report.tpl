{include file="overall_header.tpl"}
<style>body{ @import url({$dpath}reportes.css); background-attachment:fixed; }</style><table style="width:100%; text-align:center">
<tr>
	<td class="tansparent" style="width:40%;font-size:22px;font-weight:bold;">{$attacker}</td>
	<td class="tansparent" style="font-size:22px;font-weight:bold;">VS</td>
	<td class="tansparent" style="width:40%;font-size:22px;font-weight:bold;">{$defender}</td>
</tr></table>
{$report}
{include file="overall_footer.tpl"}