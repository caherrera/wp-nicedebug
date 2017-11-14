<?php
/**
 * Created by PhpStorm.
 * User: carlosherrera
 * Date: 14/11/17
 * Time: 11:27 AM
 */
/**
 *
 * @param bool $var
 * @param bool $showHtml
 * @param bool $showFrom
 * @param bool $showType
 *
 * @return string|void
 */
function nicedebug( $var = false, $showHtml = false, $showFrom = true, $showType = false ) {
	if ( ! WP_NICEDEBUG ) {
		return;
	}
	$echo       = array();
	$calledFrom = debug_backtrace();
	$path       = '/' . ( ( str_replace( ABSPATH, '', $calledFrom [0] ['file'] ) ) );
	$line       = ( $calledFrom [0] ['line'] );

	$echo[] = '<div class="nicedebug">';
	if ( $showFrom ) {

		$echo[] = '<strong style="font-weight: bold;">' . ( $path ) . '</strong>';
		$echo[] = ' (line <strong>' . ( $line ) . '</strong>)';
	}
	$echo[] = "\n<pre class=\"nicedebug-block\" style=\"margin-bottom:20px;max-width: 99%;word-wrap: break-word; \">\n";

	if ( $showType ) {
		ob_start();
		var_dump( $var );
		$var = ob_get_clean();
		$mix = html_entity_decode( strip_tags( $var ) );
	} else {
		$var = $mix = print_r( $var, true );
	}
	if ( $showHtml ) {
		$var = str_replace( '<', '&lt;', str_replace( '>', '&gt;', $var ) );
	}
	$echo[] = $var . "\n</pre>\n";
	$echo[] = '</div>';


	if ( WP_NICEDEBUG_DISPLAY >= '1' ) {
		echo implode( '', $echo );
	}
	nicedebug_save_to_file( 'debug', $path, $line, $mix );

	return implode( '', $echo );

}

/**
 * @param $type
 * @param $path
 * @param $line
 * @param $echo
 */
function nicedebug_save_to_file( $type, $path, $line, $echo ) {

	if ( WP_NICEDEBUG && WP_NICEDEBUG_LOG ) {
		$log_file = WP_CONTENT_DIR . '/nicedebug.log';
		try {
			$f = fopen( $log_file, 'a' );
			fprintf( $f, "%s\t%s\t%s\t%s\t%s\n", date( 'Y-m-d H:i:s' ), $type, $path, $line, $echo );
			fclose( $f );
		} catch ( Exception $e ) {

		}
	}
}