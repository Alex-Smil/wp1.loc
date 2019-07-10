<?php
/**
 * Created by PhpStorm.
 * User: Smile
 * Date: 07.07.2019
 * Time: 22:38
 */
?>

<?php get_header(); ?>

<div class = 'container'>
    <div class = 'row'>
        <?php while(have_posts()) : the_post(); ?>
            <!-- post -->
            <div class="col-md-12">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <!-- Так как это единственная статья использ. h1-->
                        <h1 class="card-title"><?php the_title(); ?></h1><!-- Выводит в браузер-->
                        <!-- здесь вместо the_excerpt() использ. the_content()-->
                        <p class="card-text"> <?php the_content(''); ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>