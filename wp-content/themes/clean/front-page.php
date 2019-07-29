<?php get_header(); ?>

    <?php if ( is_front_page() && get_theme_mod('clean_home_category') )  : ?>
        <div id="fh5co-portfolio">
            <!--делаем кастомный запрос-->
            <?php $query = new WP_Query( array(
                'category_name' => get_theme_mod('clean_home_category')
            ) ); ?>

            <?php if($query->have_posts()) : $i = 1; while($query->have_posts()) : $query->the_post(); ?>

                <?php if (has_post_thumbnail()) { // если лого есть, то использ. его адрес
                    $img_url = get_the_post_thumbnail_url();
                } else { // если лого нет, то картинка по умолч.
                    $img_url = get_template_directory_uri() . '/assets/images/moon.jpg';
                }?>

                <div class="fh5co-portfolio-item <?php if ($i % 2 === 0) { echo 'fh5co-img-right'; } ?>">
                    <div class="fh5co-portfolio-figure animate-box" style="background-image: url(<?php echo $img_url; ?>);"></div>
                    <div class="fh5co-portfolio-description">
                        <h2><?php the_title(); ?></h2>
                        <?php the_content(''); ?>
                        <p><a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('Read more', 'clean'); ?></a></p>
                    </div>
                </div>
                <?php $i++; endwhile; ?>
            <?php else: ?>
                <!-- no posts found -->
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    <?php endif; ?>

    <!--Данную часть кода лучше выносить в отдельный файл (13:20 урок 5 часть 2)-->
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
        <!-- post navigation -->
    <?php else: ?>
        <!-- no posts found -->
    <?php endif;?>

<?php get_footer();
