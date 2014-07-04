<?php
	// Setup our default assets to load.
	Assets::add_js(array( 'bootstrap.min.js','lib/handsontable/jquery.handsontable.full.js','jquery.dataTables.js' ));
	Assets::add_css( array('bootstrap.min.css', 'bootstrap-responsive.min.css','handsontable.css','bootstrap-dataTables.css'));
			
	$inline  = '$(".dropdown-toggle").dropdown();';
	$inline .= '$(".tooltips").tooltip();';
	$inline .= '$(".login-btn").click(function(e){ e.preventDefault(); $("#modal-login").modal(); });';
	$inline .= '//$("#data-table").dataTable();';

	Assets::add_js( $inline, 'inline' );

	Template::block('header', 'parts/head');

	Template::block('topbar', 'parts/topbar');
?>
