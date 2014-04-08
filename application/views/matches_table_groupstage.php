<?
if (isset($contents) && is_array($contents) && sizeof($contents)>0) {
?>
<table>
    <thead>
        <tr>
            <th>Match</th>
            <th>Date-Time [<?echo $tZone;?>]</th>
            <th>Group</th>
            <th></th>
            <th>Result</th>
            <th></th>
            <th>Venue</th>
        </tr>

    </thead>

    <tfoot>
        <tr>
            <td colspan="7">
                <div class="bulk-actions align-left">
                    Timezone :
                    <?
                    if (isset($timeSetting)) {
                    	for ($i=1; $i<=3; $i++) {
                    ?>
                    <a href="<?echo $_SERVER["PHP_SELF"]."?show=match&tab=".$getTab."&tz=".$i;?>"><?echo strtoupper($timeSetting[$i]["name"])?></a>
                    <?
                    		if ($i<3) echo "|";
                		}
                	}
                    ?>
                </div>
                <div class="clear"></div>
            </td>
        </tr>
    </tfoot>

    <tbody>
    	<?
    	$no = 1;
    	foreach ($contents as $rec) {
    		$sideA = "<a href=\"".$_SERVER["PHP_SELF"]."?show=team&team=".$rec["team_home"]."\"><img src=\"".site_url('/assets')."/images/team/flag/19/".strtolower($rec["hteams"]).".gif\">&nbsp;&nbsp;".$rec["hteam"]."</a>";
    		$sideB = "<a href=\"".$_SERVER["PHP_SELF"]."?show=team&team=".$rec["team_away"]."\"><img src=\"".site_url('/assets')."/images/team/flag/19/".strtolower($rec["ateams"]).".gif\">&nbsp;&nbsp;".$rec["ateam"]."</a>";
    		$venue = "<a href=\"".$_SERVER["PHP_SELF"]."?show=venue&venue=".$rec["stadium"]."\">".$rec["venue_name"]."</a>";
    		$matchGroup = "<a href=\"".$_SERVER["PHP_SELF"]."?show=group&group=".$rec["mgroup"]."\">".$rec["mgroup"]."</a>";
    		$mGmtStmp = mktime ($rec["mhour"], $rec["mmin"], $rec["msec"], $rec["mmonth"], $rec["mday"], $rec["myear"]);
    		$procStmp = $mGmtStmp + ((60*60) * $timeSetting[$getTz]["timezone"]);
    		$matchTime = date("d",$procStmp)."/".date("m",$procStmp)."/".date("Y",$procStmp)." ".date("H",$procStmp).":".date("i",$procStmp);
            $teamHomeScore = isset($rec["teamHomeScore"]) ? $rec["teamHomeScore"] : 0;
            $teamAwayScore = isset($rec["teamAwayScore"]) ? $rec["teamAwayScore"] : 0;
            if ($rec["match_status"]==4) {
                $matchDetail = "<a href=\"".$_SERVER["PHP_SELF"]."?show=match&match=".$rec["id"]."\"><b>".$teamHomeScore." - ".$teamAwayScore."</b></a>";
            } else {
                $matchDetail = "<a href=\"".$_SERVER["PHP_SELF"]."?show=match&match=".$rec["id"]."\">V</a>";
            }
		?>
		<tr>
	        <td><?echo $no;?></td>
	        <td><?echo $matchTime;?></td>
	        <td><?echo $matchGroup;?></td>
	        <td><?echo $sideA;?></td>
	        <td><?echo $matchDetail;?></td>
	        <td><?echo $sideB;?></td>
	        <td><?echo $venue;?></td>
	    </tr>
		<?  
			$no++;  		
    	}
    	?>
    </tbody>
</table>
<?
}
?>