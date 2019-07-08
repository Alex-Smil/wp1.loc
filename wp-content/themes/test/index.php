<?php get_header(); ?>

<div class = 'container'>
    <div class = 'row'>
        <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <!-- post -->
            <div class="col-md-12">
                <div class="card"">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h5><!-- Выводит в браузер-->
                        <p class="card-text"> <?php the_excerpt(); //the_content(''); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Go somewhere</a><!-- Ссылка на текущий пост -->
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
            <!-- post navigation -->
        <?php else: ?>
            <!-- no posts found -->
            <p>Постов нет ...</p>
        <?php endif; ?>
    </div>
</div>



<?php get_footer(); ?>


