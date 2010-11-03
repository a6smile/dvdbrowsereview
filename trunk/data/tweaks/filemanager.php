<?php

$fileman1 = new Tweak( 'File Manager' );
$fileman1->addInterface ('filemanager');
$fileman1->Author('TinyBrowser. Repackaged by Andrew & Tikakino');
$fileman1->Description( 'tinybrowser' );

function filemanager() {
?>

<script language="javascript" type="text/javascript" src="tweaks/tinymce/jscripts/tiny_mce/plugins/tinybrowser/tb_standalone.js.php"></script>

<BODY onLoad=tinyBrowserPopUp('file');>

<?php
}
?>

