<?php

$json = file_get_contents( 'makers.json' );

$makers = json_decode( $json );

var_dump( $makers );