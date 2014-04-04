<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <? $this->load->view('section_head') ?>
</head>
<body>
    <div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->

        <? $this->load->view('section_sidebar') ?>

        <div id="main-content"> <!-- Main Content Section with everything -->

            <? $this->load->view('section_maintop') ?>

            <?//-- contents --//?>
            <? $this->load->view('content_matches_table', $matches_data) ?>
            <?//-- end contents --//?>

            <? $this->load->view('section_mainfooter') ?>

        </div> <!-- End #main-content -->

    </div>
</body>
</html>
