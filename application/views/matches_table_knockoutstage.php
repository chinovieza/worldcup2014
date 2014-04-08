<?
$no = isset($groupStageMatchesNum) ? $groupStageMatchesNum + 1 : 1;
if (isset($contents) && is_array($contents) && sizeof($contents)>0) {
	foreach ($contents as $stageMatches) {
	?>
<div class="content-box">
	
	<div class="content-box-header">
	    <h3><?echo $stageMatches["stage_name"];?></h3>
	    <div class="clear"></div>
	</div> <!-- End .content-box-header -->
	<div class="content-box-content">
		<?
		if (isset($stageMatches["stage_matches"]) && is_array($stageMatches["stage_matches"]) && sizeof($stageMatches["stage_matches"])>0) {
		?>
		<table>
            <thead>
                <tr>
                    <th>Match</th>
                    <th>Date-Time [<?echo $tZone;?>]</th>
                    <th></th>
                    <th>Result</th>
                    <th></th>
                    <th>Venue</th>
                </tr>

            </thead>

            <tfoot>
                <tr>
                    <td colspan="6">
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
			foreach ($stageMatches["stage_matches"] as $rec2) {
				if ($rec2["team_home"]!="") {
	                $sideA = "<a href=\"".$_SERVER["PHP_SELF"]."?show=team&team=".$rec2["team_home"]."\"><img src=\"images/team/flag/19/".strtolower($rec2["hteams"]).".gif\">&nbsp;&nbsp;".$rec2["hteam"]."</a>";
	            } else {
	                $sideA = $rec2["remark_home"];
	            }
	            if ($rec2["team_away"]!="") {
	                $sideB = "<a href=\"".$_SERVER["PHP_SELF"]."?show=team&team=".$rec2["team_away"]."\"><img src=\"images/team/flag/19/".strtolower($rec2["ateams"]).".gif\">&nbsp;&nbsp;".$rec2["ateam"]."</a>";
	            } else {
	                $sideB = $rec2["remark_away"];
	            }
	            $venue = "<a href=\"".$_SERVER["PHP_SELF"]."?show=venue&venue=".$rec2["stadium"]."\">".$rec2["venue_name"]."</a>";
	            $mGmtStmp = mktime ($rec2["mhour"], $rec2["mmin"], $rec2["msec"], $rec2["mmonth"], $rec2["mday"], $rec2["myear"]);
	            $procStmp = $mGmtStmp + ((60*60) * $timeSetting[$getTz]["timezone"]);
	            $matchTime = date("d",$procStmp)."/".date("m",$procStmp)."/".date("Y",$procStmp)." ".date("H",$procStmp).":".date("i",$procStmp);
	            $matchDetail = "-";
		?>
				<tr>
                    <td><?echo $no;?></td>
                    <td><?echo $matchTime;?></td>
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
	</div>
	
</div>
<?
	}
}
?>