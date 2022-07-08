<?php the_field(''); ?>
<?php the_sub_field(''); ?>

<?php
if( have_rows('vstrechi') ):while ( have_rows('vstrechi') ) : the_row(); ?>
    <div class="let__item" >
        <a class="item__img" href="<?php the_sub_field('vstrechi_link'); ?>">
            <img src="<?php the_sub_field('vstrechi_img'); ?>" alt="">
            <?php if( get_sub_field('vstrechi_srusl') ): ?>
                <div class="let__true"><img src="<?php the_field('galochka'); ?>" alt="check"></div>
            <?php endif; ?>
        </a>
        <div class="item__title"><?php the_sub_field('vstrechi_title'); ?></div>
        <div class="item__date"><?php the_sub_field('vstrechi_date'); ?></div>        
    </div>
<?php endwhile; endif; ?>






<?php 
if( have_rows('benefits') ): $i = 1; while ( have_rows('benefits') ) : the_row(); ?>
    <div class="benefit__item" >
        <div class="benefit__star">0<?php echo($i)?></div>
        <div class="benefit__text"><?php the_sub_field('benefits-text'); ?></div>
    </div>
<?php $i++; endwhile; endif; ?>