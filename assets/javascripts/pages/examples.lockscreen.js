
(function($) {

	'use strict';

	var $document,
		idleTime;

	$document = $(document);

	$(function() {
		$.idleTimer( 600000 ); // ms

		$document.on( 'idle.idleTimer', function() {
			// if you don't want the modal
			// you can make a redirect here
			window.location.href = "pages-lock-screen.php";
		});
	});

}).apply( this, [ jQuery ]);