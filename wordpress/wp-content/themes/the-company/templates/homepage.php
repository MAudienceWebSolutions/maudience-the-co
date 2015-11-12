<?php
/* Template Name: Home */
get_header();
the_post();

get_template_part( 'fragments/home-intro' );
get_template_part( 'fragments/home-services' );
get_template_part( 'fragments/home-features' );
get_template_part( 'fragments/home-logos' );

get_footer();