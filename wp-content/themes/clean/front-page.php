<?php get_header(); ?>

    <?php if ( get_theme_mod('clean_home_category') )  : ?>
        <div id="fh5co-portfolio">
            <!--делаем кастомный запрос-->
            <?php $query = new WP_Query( array(
                'category_name' => get_theme_mod('clean_home_category'),
                'posts_per_page' => 4
            ) ); ?>

            <?php if($query->have_posts()) : $i = 1; while($query->have_posts()) : $query->the_post(); ?>

                <?php get_template_part('template-parts/content', 'preview'); ?>

                <?php $i++; endwhile; ?>
            <?php else: ?>
                <!-- no posts found -->
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
        <div class="clearfix"></div>
    <?php endif; ?>

    <!--Данную часть кода лучше выносить в отдельный файл (13:20 урок 5 часть 2)-->
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
        <!-- post navigation -->
    <?php else: ?>
        <!-- no posts found -->
    <?php endif;?>

<?php get_footer();
