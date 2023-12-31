<?php
/**
 * Add event to the sse.data file
 */
add_action( 'woocommerce_before_shop_loop', 'sse_before_shop_loop' );
function sse_before_shop_loop() {
			
	// Add new HTML module to the Shop page before Shop loop
	?>
	<div style ="margin: 20px; font-size: 150%;">
		<div style ="color: blue;">New Purchase <span id="sse_processing"></span></div>
		<div style ="color: red;">New Refund <span id="sse_refunded"></span></div>
	</div>
	<?php
	
	// Localize and enqueue sse-test.js
	wp_localize_script( 'sse-test', 'SseData', array(
		
		'sseTarget'	=> plugin_dir_url( __FILE__ ) . 'sse/sse.php', // sse.php File path
	) );
	
	wp_enqueue_script( 'sse-test' );
}

/**
 * Add event to the sse.data file
 */
add_action( 'woocommerce_order_status_changed', 'sse_status_changed', 10, 3 );
function sse_status_changed( $order_id, $old_status, $new_status ) {
			
	if( 'processing' == $new_status || 'refunded' == $new_status ) {
		
		// Get current events data array
		$data = json_decode( file_get_contents( plugin_dir_path( __FILE__ ) . 'sse/sse.json' ), true );
		
		if( ! is_array( $data ) ) {
			
			$data = array();
		}
		
		$order = wc_get_order( $order_id );
		
		// Add or change new event data ( HTML line for display in the Shop psge )
		$data[$new_status] = $order->get_date_modified()
			. ' ' . $order->get_billing_first_name()
			. ' ' . $order->get_billing_last_name()
			. ' ' . $order->get_total();
		
		// Save changed data to the sse.json
		$file = fopen( plugin_dir_path( __FILE__ ) . 'sse/sse.json', 'w'); 
		fwrite( $file, json_encode( array_merge( $data ) ) );
		fclose( $file );
	}
}
