<?php
function my_theme_enqueue_styles() {

    $parent_style = 'SuperNews';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

/* Adds the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'supernews_child_theme_setup', 11 );

//add_filter('widget_text', 'do_shortcode');


/**
 * Setup function. All child themes should run their setup within this function. The idea is to add/remove 
 * filters and actions after the parent theme has been set up. This function provides you that opportunity.
 *
 * @since 1.0
 */
function supernews_child_theme_setup() {
	// Add your custom functions here.
}

if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}

/*
 * override supernews theme header
 */
function supernews_header() {
        global $supernews_customizer_all_values;
	    $supernews_header_media_position = $supernews_customizer_all_values['supernews-header-media-position'];
	    if( 'very-top' == $supernews_header_media_position ){
		    supernews_header_markup();
	    }
        ?>
        <header id="masthead" class="site-header">
            <div class="top-header-section clearfix">
                <div class="wrapper">
                    <?php
                    if ( 1 == $supernews_customizer_all_values['supernews-show-date'] ){
                        echo ' <div class="header-date top-block">';
                        supernews_date_display();
                        echo "</div>";
                    }
                    ?>
                    <?php
                    if( has_nav_menu( 'top-menu' ) ){
                        ?>
                        <?php wp_nav_menu(array('theme_location' => 'top-menu','container' => 'div', 'container_class' => 'acmethemes-top-nav top-block', 'depth' => 1 )); ?>
                        <?php
                    }
                    if ( isset( $supernews_customizer_all_values['supernews-header-show-search']) && $supernews_customizer_all_values['supernews-header-show-search'] == 1 ):
                        ?>
                        <div class="header-search top-block">
                            <?php get_search_form(); ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
            </div><!-- .top-header-section -->
            <div class="header-wrapper clearfix">
                <div class="header-container">
	                <?php
	                if( 'above-logo' == $supernews_header_media_position ){
		                supernews_header_markup();
	                }
	                ?>
                    <div class="wrapper site-branding clearfix">
                        <?php if ( 'disable' != $supernews_customizer_all_values['supernews-header-id-display-opt'] ):?>
                        <div class="site-logo">
                            <?php
                            if ( 'logo-only' == $supernews_customizer_all_values['supernews-header-id-display-opt'] ):
                                if ( function_exists( 'the_custom_logo' ) ) :
                                    the_custom_logo();
                                else :
                                    if( !empty( $supernews_customizer_all_values['supernews-header-logo'] ) ):
                                        ?>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                            <img src="<?php echo esc_url( $supernews_customizer_all_values['supernews-header-logo'] ); ?>">
                                        </a>
                                        <?php
                                    endif;/*supernews-header-logo*/
                                endif;
                            else:/*else is title-only or title-and-tagline*/
                                if ( is_front_page() && is_home() ) : ?>
                                    <h1 class="site-title">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                    </h1>
                                <?php else : ?>
                                    <p class="site-title">
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                    </p>
                                <?php endif;
                                if ( 'title-and-tagline' == $supernews_customizer_all_values['supernews-header-id-display-opt'] ):
                                    $description = get_bloginfo( 'description', 'display' );
                                    if ( $description || is_customize_preview() ) : ?>
                                        <p class="site-description"><?php echo implode( "<br/>", explode( ";", esc_html( $description ) ) ); ?></p>
                                    <?php endif;
                                endif;
                            endif; ?>
                        </div><!--site-logo-->
                        <?php endif;?><!--supernews-header-id-display-opt-->
                        <?php
                        if ( (!empty( $supernews_customizer_all_values['supernews-header-main-banner-ads'] ) && 'hide' != $supernews_customizer_all_values['supernews-header-main-show-banner-ads'] ) ||
                             is_active_sidebar( 'supernews-header' ) ):
	                        $supernews_header_main_banner_ads_link = $supernews_customizer_all_values['supernews-header-main-banner-ads-link'];
	                        ?>
                            <div class="header-ads float-right">
		                        <?php
		                        if (!empty( $supernews_customizer_all_values['supernews-header-main-banner-ads'] ) && 'hide' != $supernews_customizer_all_values['supernews-header-main-show-banner-ads'] ){
			                        ?>
                                    <a href="<?php echo esc_url( $supernews_header_main_banner_ads_link ); ?>" target="_blank">
                                        <img src="<?php echo esc_url( $supernews_customizer_all_values['supernews-header-main-banner-ads'] )?>">
                                    </a>
			                        <?php
		                        }

		                        if( is_active_sidebar( 'supernews-header' ) ) :
			                        dynamic_sidebar( 'supernews-header' );
		                        endif;
		                        ?>
                            </div>
                        <?php endif; ?>
                        <div class="clearfix"></div>
                    </div>
                    <?php
                    if( 'above-menu' == $supernews_header_media_position ){
	                    supernews_header_markup();
                    }
                    $supernews_enable_sticky_menu ='';
                    if( 1 == $supernews_customizer_all_values['supernews-enable-sticky-menu'] ) {
	                    $supernews_enable_sticky_menu = ' supernews-enable-sticky-menu ';
                    }
                    ?>
                    <nav id="site-navigation" class="main-navigation <?php echo $supernews_enable_sticky_menu;?> clearfix">
                        <div class="header-main-menu wrapper clearfix">
                            <?php
                            wp_nav_menu(array('theme_location' => 'primary','container' => 'div', 'container_class' => 'acmethemes-nav'));
                            if ( 1 == $supernews_customizer_all_values['supernews-enable-social'] ) {
                                /*Social Sharing*/
                                /**
                                 * supernews_action_social_links
                                 * @since SuperNews 1.0.0
                                 *
                                 * @hooked supernews_social_links -  10
                                 */
                                do_action('supernews_action_social_links');
                                /* Social Links*/
                            }
                           ?>
                        </div>
                        <div class="responsive-slick-menu clearfix"></div>
                    </nav>
                    <?php
                    if( 'below-menu' == $supernews_header_media_position ){
	                    supernews_header_markup();
                    }
                    ?>
                    <!-- #site-navigation -->
                </div>
                <!-- .header-container -->
            </div>
            <!-- header-wrapper-->
        </header>
        <!-- #masthead -->
    <?php
    }
?>
