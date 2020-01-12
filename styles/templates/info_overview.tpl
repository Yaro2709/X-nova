{if $GateFleetList}<form action="" method="post">{/if}
    <div id="info_name" style="display:none;">{$name}</div>
<table>
<tbody>
<tr>
	<td colspan="3">
	<table>
		<tr>
			<td><img src="styles/theme/{$Raza_skin}/gebaeude/{$id}.png" /></td>
			<td class="contenido_info">{$description}
			{if $RapidFire}
			<br /><br />		
			{$tipo_nave}
			<div style="padding: 2px 2px 2px 2px;">
			{foreach item=RapidFireTo key=RapidFireToName from=$RapidFire.to}
			{$in_rf_again} {$RapidFireToName} <span style="color:#00ff00">{$RapidFireTo}</span><br />
			{/foreach}
			{foreach item=RapidFireFrom key=RapidFireFromName from=$RapidFire.from}
			{$in_rf_from} {$RapidFireFromName} <span style="color:#ff0000">{$RapidFireFrom}</span><br />
			{/foreach}
			{$GateFleetList}
			<br />
			</div>
			{/if}
			</td>
		</tr>
	</table>
	</td>
</tr>

{if $ProductionTable}

<tr>
<td class="transparent" colspan="3"><hr></td>
</tr>
<tr>
	<td colspan="3">
		<table width="100%">
		<tr  align="center"><th class="repetido" style="padding-top: 5px;paddig-bottom: 7px;">{$in_level}</th>{if $id != 4}<th class="repetido">{if $id == 12}{$in_prod_energy}{else}{$in_prod_p_hour}{/if}</th><th class="repetido">{$in_difference}</th>{/if}<th class="repetido">{if $id == 12}{$in_used_deuter}{elseif $id == 4}{$in_prod_energy}{else}{$in_used_energy}{/if}</th><th class="repetido">{$in_difference}</th></tr>
		{foreach item=LevelRow from=$ProductionTable}
		<tr align="center"><td>{if $Level == $LevelRow.BuildLevel}<span style="color:#ff0000">{$LevelRow.BuildLevel}</span>{else}{$LevelRow.BuildLevel}{/if}</td>{if $id != 4}<td>{$LevelRow.prod}</td><td>{$LevelRow.prod_diff}</td>{/if}<td>{$LevelRow.need}</td><td>{$LevelRow.need_diff}</td></tr>
		{/foreach}
		</table>
	</td>
</tr>

{elseif $FleetInfo}

<tr>
<td class="transparent" colspan="3"><hr /></td>
</tr>
{foreach key=Name item=content from=$FleetInfo}
<tr>
<td>{$Name}</td>
<td>
{if is_array($content)}{$content.0}{if $content.0 != $content.1} <span style="color:yellow">({$content.1})</span>{/if}{else}{$content}{/if}
{/foreach}
</td>
</tr>
{elseif $gate_fleets}
{include file="info_gatelist.tpl"}
{elseif $missiles}
{/if}
</tbody>
</table>