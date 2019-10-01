<?php
function my_theme_enqueue_styles() {

    $parent_style = 'twentysixteen-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

// Shortcode for Google Analytics Cookie Opt-Out
function mm_ga_cookie_optout() {
	return '<a onclick="alert(\'Google Analytics wurde deaktiviert\');" href="javascript:gaOptout()" rel="nofollow">Google Analytics deaktivieren</a>';
}
add_shortcode('mm_ga_cookie_optout', 'mm_ga_cookie_optout');
// End - Shortcode for Google Analytics Cookie Opt-Out

// Add Google Analytics opt-out to Head
function wg_opt_out(){
	?><script>
	var gaProperty = 'UA-44178125-1';
	var disableStr = 'ga-disable-' + gaProperty;
	if (document.cookie.indexOf(disableStr + '=true') > -1) {
		window[disableStr] = true;
	}
	function gaOptout() {
		document.cookie = disableStr + '=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
		window[disableStr] = true;
	}
	</script><?php
}
add_action( 'wp_head', 'wg_opt_out', 1 );
// End - Add Google Analytics opt-out to Head

// Add Google Analytics to Head
function googleanalytics() { ?>
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-44178125-1', 'auto');
	ga('send', 'pageview');
	</script>
<?php }
add_action( 'wp_head', 'googleanalytics', 2 );
// End - Add Google Analytics to Head
function exclude_category( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$query->set( 'cat', '-784' );
		}
	}
add_action( 'pre_get_posts', 'exclude_category' );


?>