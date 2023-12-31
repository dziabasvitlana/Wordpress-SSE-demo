![logo](https://upsite.top/wp-content/uploads/2023/12/UPsiteLogo_800x800-150x150.png, "UPsite Top - IT development company from Ukraine creates and supports custom WordPress plugins" )
+ [**UPsite Top** custom WordPress plugins creates and supports](https://upsite.top/wordpress-development/)
# Wordpress SSE ( Server Sent Events ) demo plugin
The purpose of creating SSE example plugin is to demonstrate a practical solution for using SSE technology when creating WordPress plugins
### Dependencies
+ [Woocommerce](https://woocommerce.com/download/)
### Process description
WordPress hook processing generates an Event sent to the browser
```php
add_action( 'my_action', 'my_function');
function my_function() {
    ... // Event sending
}

```
And browser listens for this event
```js
const evtSource = new EventSource(sourceTarget);
evtSource.addEventListener( "myEvent", function( event ) {
	... // Event handing
});

```
### Video denonstration
[![video](https://upsite.top/wp-content/uploads/2023/12/sse_git_caption.png)](https://youtu.be/PrwtrKyzWYY)
