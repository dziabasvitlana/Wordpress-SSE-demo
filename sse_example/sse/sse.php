<?php
// SSE headers
header('Cache-Control: no-store');
header('Content-Type: text/event-stream');
header('Content-Encoding: none');
header('X-Accel-Buffering: no');

ob_end_flush();

while( true ) {
	
	$new = file_get_contents( 'sse.json' );
	
	// Check if Old data exist and New data have changes
	if( isset( $old ) && $new != $old ) {
		
		$old_data = json_decode( $old, true );
		
		foreach( json_decode( $new, true ) as $key => $value ) {
			
			// If event data changed
			if( ! isset( $old_data[$key] ) || $old_data[$key] != $value ) {
				
				// Sent Event
				echo "event: " . $key . "\n";
				echo "data: " . $value . "\n\n";
				flush();
			}
		}
	}
	
	$old = $new;

	if( connection_aborted() ) {
		
		break;
	}
	
	// Once per second
	sleep(1);
}

