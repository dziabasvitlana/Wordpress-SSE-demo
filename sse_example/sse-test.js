(function( $ ) {

	const evtSource = new EventSource( SseData.sseTarget, {
		withCredentials: true,
	});
	evtSource.addEventListener( "processing", function( event ) {
		$('#sse_processing').html(event.data);
	});
	evtSource.addEventListener( "refunded", function( event ) {
		$('#sse_refunded').html(event.data);
	});
	
})( jQuery );
