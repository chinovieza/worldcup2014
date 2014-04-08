<div class="content-box"><!-- Start Content Box -->

    <div class="content-box-header">

        <h3>MATCHES</h3>

        <ul class="content-box-tabs">
<?
    $ulTab1Cls = "";
    $ulTab2Cls = "";
    if ($getTab==1) {
        $ulTab1Cls = "class=\"default-tab\"";
    } else if ($getTab==2) {
        $ulTab2Cls = "class=\"default-tab\"";
    }
?>
            <li><a href="#tab1" <?echo $ulTab1Cls;?>>Group Stage</a></li> <!-- href must be unique and match the id of target div -->
            <li><a href="#tab2" <?echo $ulTab2Cls;?>>Knockout Stage</a></li>
        </ul>

        <div class="clear"></div>

    </div> <!-- End .content-box-header -->

    <div class="content-box-content">
	    <?
	    if ($getTab==1) {
	        $tab1Cls = "tab-content default-tab";
	    } else {
	        $tab1Cls = "tab-content";
	    }
		?>
        <div class="<?echo $tab1Cls;?>" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
    		<? $this->load->view('matches_table_groupstage', $group_stage) ?>
        </div>

        <?
        if ($getTab==2) {
            $tab2Cls = "tab-content default-tab";
        } else {
            $tab2Cls = "tab-content";
        }
        ?>
        <div class="<?echo $tab2Cls;?>" id="tab2">
            <? $this->load->view('matches_table_knockoutstage', $knockout_stage) ?>
        </div>
    </div>
</div>
