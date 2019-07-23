<?php
/**
 * Created by PhpStorm.
 * User: Smile
 * Date: 17.07.2019
 * Time: 17:10
 */

    /* Если right-sidebar не содержит виджетов, контент займет 12 колонок */
    if (!is_active_sidebar('right-sidebar')){
        return ;
    }
?>

<div class="col-md-3">
    <?php dynamic_sidebar('right-sidebar'); ?>
</div>

