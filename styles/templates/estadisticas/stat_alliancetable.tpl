<tr>
	<th style="width:60px;">{$st_position}</th>
	<th>{$st_alliance}</th>	
	<th>{$st_members}</th>
	<th>{$st_points}</th>
	<th>{$st_per_member}</th>
	<th>{$escudo}</th>
</tr>
{foreach name=RangeList item=RangeInfo from=$RangeList}
<tr class="semi_remarcado">
	<td>
	<a class="tooltip" name="{if $RangeInfo.ranking == 0}
	<span style='color:#87CEEB'>*</span>
	{elseif $RangeInfo.ranking < 0}
	<span style='color:red'>{$RangeInfo.ranking}</span>
	{elseif $RangeInfo.ranking > 0}
	<span style='color:green'>+{$RangeInfo.ranking}</span>
	{/if}">{$RangeInfo.rank}</a>
	</td>
	
	<td><a href="game.php?page=alliance&amp;mode=ainfo&amp;a={$RangeInfo.id}" target="ally"{if $RangeInfo.id == $CUser_ally} style="color:lime"{/if}>{$RangeInfo.name}</a></td>

	<td>{$RangeInfo.members}</td>
	
	<td>{$RangeInfo.points}</td>
	
	<td>{$RangeInfo.mppoints}</td>
	
		<td><img class="tooltip" name="<img src={$RangeInfo.imagen}  width=100 height=100 />" src="{$RangeInfo.imagen}" width="40" height="40" /></td>	
</tr>
{/foreach}