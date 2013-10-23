<?php

function mf_maker_list() {

	$json = file_get_contents( 'makers.json' );

	$makers = json_decode( $json );

	var_dump( $makers[0] );
	$project_name = 'Project Name';
	$project_description = 'Project Description';
	$output = '';
	foreach ( $makers as $maker ) {
		$output .= '<div>';
		$output .= '<h2>' . $maker->$project_name . '</h2>';
		$output .= '<div class="media">';
		$output .= '<a class="pull-left" href="' . $maker->WebURL . '">';
		$output .= '<img class="media-object" style="max-width:200px" src="' . $maker->URL . '">';
		$output .= '</a>';
		$output .= '<div class="media-body">';
		$output .= '<p>' . $maker->$project_description . '</p>';
		$output .= '</div>';
		$output .= '</div>';

		$output .= '</div>';
	}
	return $output;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Makers</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="http://getbootstrap.com/2.3.2/assets/css/bootstrap.css" rel="stylesheet">
</head>
<body>

	<div class="container">

		<div class="span8 offset2">

			<h1>Makers</h1>
			<?php echo mf_maker_list(); ?>
		</div>

	</div>

</body>
</html>
</html>