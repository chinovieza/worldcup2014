<?php
$colPerRow = 4;
$topNum = 10;
?>
<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">

        <h3>Teams</h3>

        <div class="clear"></div>

    </div> <!-- End .content-box-header -->
    <div class="content-box-content">
        <?
        if (isset($contents) && is_array($contents) && sizeof($contents)>0) {
       	?>
       	<table>
            <tbody>
            	<?
            	$colCheck = $colPerRow + 1;
                $colRun = 0;
            	foreach ($contents as $team) {
            		//$aTeam = "<a href=\"".site_url('/teams/'.$team["id"])."\" alt=\"".$team["name"]."\" title=\"".$team["name"]."\"><img src=\"".site_url('/assets')."/images/team/flag/47/".strtolower($team["short_name"]).".gif\">&nbsp;&nbsp;".$team["name"]."</a>";
            		$aTeam = "<a href=\"".site_url('/teams/'.strtolower($team["short_name"]))."\" alt=\"".$team["name"]."\" title=\"".$team["name"]."\"><img src=\"".site_url('/assets')."/images/team/flag/47/".strtolower($team["short_name"]).".gif\">&nbsp;&nbsp;".$team["name"]."</a>";

            		if ($colRun==0) {
                        echo "<tr>";
                        $colRun = 1;
                    }
                ?>
                    <td><?echo $aTeam;?></td>
                <?
                    $colRun++;
                    if ($colRun==$colCheck){
                        echo "</tr>";
                        $colRun = 0;
                    }
                }
                while(($colRun!=0) && ($colRun<$colCheck)){
                    echo "<td></td>";
                    $colRun++;
                    if ($colRun==$colCheck){
                        echo "</tr>";
                        $colRun = 0;
                    }
                }

            	?>
       	
            </tbody>
        </table>
        <?
    	}
        ?>
    </div>
</div>