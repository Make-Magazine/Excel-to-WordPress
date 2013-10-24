<?php
/**
 * Function for the Mini Maker Faire import script
 */

/**
 * Concatenate maker name
 */
function mf_full_name( $maker ) {
	return $maker->FirstName . " " . $maker->LastName;
}

/**
 * Get the JSON of all of the Makers
 */
function mf_get_maker_json() {
	$json = file_get_contents( 'makers.json' );
	$makers = json_decode( $json );
	return $makers;
}

/**
 * With all of the Makers, loop through each one of them.
 */
function mf_item_loop( $makers ) {
	$output = '';
	$i = 1;
	foreach ( $makers as $maker ) {
		$output .= mf_maker_item( $maker, $i );
		$i++;
	}
	return $output;
}

/**
 * Generate a block of content inside each of the posts, with buttons and stuff for Twitter and homepage.
 */
function mf_maker_content( $maker ) {
	$output = '';
	$output .= '<div class="the-maker">';
	$output .= '<div class="media">';
	if ( !empty( $maker->URL ) ) {
		$output .= ( !empty( $maker->WebURL ) ) ? '<a class="pull-left alignleft" href="' . $maker->WebURL . '">' : '';
		$output .= '<img class="media-object" style="max-width:200px" src="' . $maker->URL . '">';
		$output .= ( !empty( $maker->WebURL ) ) ? '</a>' : '';
	}
	$output .= '<div class="media-body">';
	$output .= '<p>' . $maker->ProjectDescription . '</p>';
	$output .= '<div class="maker">';
	$output .= '<h3>Maker: ' . mf_full_name( $maker ) . '</h3>';
	$output .= ( !empty( $maker->ORG ) ) ? '<h4>' . $maker->ORG . '</h4>' : '';
	$output .= '<div class="social">';
	$output .= ( !empty( $maker->Twitter ) ) ? '<a class="btn button twitter" href="' . esc_url( 'http://twitter.com/' . $maker->Twitter ) . '">@' . $maker->Twitter . '</a> ' : '';
	$output .= ( !empty( $maker->WebURL ) ) ? ' <a class="btn button website" href="' . esc_url( $maker->WebURL ) . '"><i class="icon-home"></i> Website</a>' : '';
	$output .= ( filter_var( !empty( $maker->Email ), FILTER_VALIDATE_EMAIL ) ) ? ' <a class="btn button website" href="mailto:' . $maker->Email . '"><i class="icon-envelope"></i> Email</a>' : '';
	$output .= '</div><!-- .social -->';
	$output .= '</div><!-- .maker -->';
	$output .= '</div><!-- .media-body -->';
	$output .= '</div><!-- .media -->';
	$output .= '</div><!-- .the-maker -->';
	return $output;
}

/**
 * Build a category 
 */
function mf_category_creator( $maker ) {
	$cats = $maker->Category;
	$output = '';
	$exploded = explode(',', $cats);
	foreach ( $exploded as $category ) {
		$output .= '<category domain="category" nicename="' . sanitize_title( $category ) . '"><![CDATA[' . trim( $category ) . ']]></category>';
	}
	return $output;
}

function mf_maker_item( $maker, $i ) {
	$output = '<item>';
		$output .= '<title>' . esc_html( $maker->ProjectName ) . '</title>';
		$output .= '<pubDate>' . date("D\, j M Y G:i:s ") . '+0000</pubDate>';
		$output .= '<dc:creator><![CDATA[mini]]></dc:creator>';
		$output .= '<description></description>';
		$output .= '<content:encoded><![CDATA[' . ent2ncr( mf_maker_content( $maker ) ) . ']]></content:encoded>';
		$output .= '<excerpt:encoded><![CDATA[' . ent2ncr( $maker->ProjectDescription ) . ']]></excerpt:encoded>';
		$output .= '<wp:post_date>' . date( "Y-m-d G:i:s" ) . '</wp:post_date>';
		$output .= '<wp:post_date_gmt>' . gmdate( "Y-m-d G:i:s" ) . '</wp:post_date_gmt>';
		$output .= '<wp:comment_status>open</wp:comment_status>';
		$output .= '<wp:ping_status>open</wp:ping_status>';
		$output .= '<wp:post_name>' . sanitize_title( $maker->ProjectName ) . '</wp:post_name>';
		$output .= '<wp:status>publish</wp:status>';
		$output .= '<wp:post_parent>0</wp:post_parent>';
		$output .= '<wp:menu_order>0</wp:menu_order>';
		$output .= '<wp:post_type>page</wp:post_type>';
		$output .= '<wp:post_password></wp:post_password>';
		$output .= '<wp:is_sticky>0</wp:is_sticky>';
		$output .= mf_category_creator( $maker );
	$output .= '</item>';
	return $output;
}