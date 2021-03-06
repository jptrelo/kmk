<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ares
 */

get_header(); 

$ares_options = ares_get_options();
$alternate_blog = isset( $ares_options['blog_layout_style'] ) && $ares_options['blog_layout_style'] == 'masonry' ? true : false;

?>

<div id="primary" class="content-area">

    <main id="main" class="site-main index">
  
        <div class="container-fluid">

            <div class="page-content row">

                <!-- <div class="col-md-<?php echo $ares_options['ares_blog_layout'] == 'col2r' && is_active_sidebar(1) ? '8' : '12'; ?> site-content item-page"> -->
                <div class="col-md-12 companies-row">

                    <?php if ( have_posts() ) :
                    
                        if ( $alternate_blog ) : ?>

                            <div id="ares-alt-blog-wrap">

                                <div id="masonry-blog-wrapper">

                                    <div class="grid-sizer"></div>
                                    <div class="gutter-sizer"></div>

                        <?php endif;
                    
                        while ( have_posts() ) : the_post();

                            if ( $alternate_blog ) :
                                    
                                get_template_part('template-parts/content', 'posts-alt' );
                                    
                            else : ?>
                                <div class="col-md-2 col-sm-3 col-xs-6">
                                    <div onClick="location.href='<?php the_permalink(); ?>'" class="item-post">

                                        <?php if ( $ares_options['ares_blog_featured'] == 'on' && has_post_thumbnail() ) : ?>

                                            <div class="post-thumb col-sm-12">

                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('large'); ?>
                                                </a>

                                            </div>

                                        <?php endif; ?>

                                        <!-- <div class="col-sm-<?php echo $ares_options['ares_blog_featured'] == 'on' && has_post_thumbnail() ? '8' : '12'; ?> <?php echo has_post_thumbnail() ? '' : 'text-left'; ?>"> -->
                                        <div class="col-sm-12">

                                            <h2 class="post-title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>

                                            <div class="post-content">
                                                <h6 class="post-category">
                                                    <?php $categories = get_the_category(); ?>
                                                    <?php if ( ! empty( $categories ) ) : ?>

                                                        <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                                                            <?php echo esc_html( $categories[0]->name ); ?>
                                                        </a>

                                                    <?php endif; ?>
                                                </h6>
                                                <!-- <?php   $excerpt = the_excerpt();
                                                        echo substr($excerpt, 1, 50); 
                                                    ?> -->
                                            </div>

                                            <!-- <div class="text-right">
                                                <a class="ares-button button-primary" href="<?php the_permalink(); ?>">
                                                    <?php _e( 'Read More', 'ares' ); ?>
                                                </a>
                                            </div>   -->

                                        </div>

                                    </div>
                                </div>  
                            <?php endif;

                        endwhile;
                                    
                        if ( $alternate_blog ) : ?>

                                </div>
                                
                            </div>

                        <?php endif; ?>

                        <div class="pagination-links">
                            <?php echo the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
                        </div>
                    
                    <?php else : ?>
                    
                        <?php get_template_part('template-parts/content', 'none'); ?>
                    
                    <?php endif; ?>
                    
                </div>
                    
                <?php if ( $ares_options['ares_blog_layout'] == 'col2r' && is_active_sidebar(1) ) : ?>

                    <div class="col-md-3 col-sm-12 col-xs-12 avenue-sidebar" style="display:none;">
                        <?php get_sidebar(); ?>
                    </div>

                <?php endif; ?>
            </div>
            
            <div class="clear"></div>
            
        </div>

    </main>
    
</div>

<?php get_footer();
