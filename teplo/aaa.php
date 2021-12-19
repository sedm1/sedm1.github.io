<?php
if( have_rows('quest__item') ): while ( have_rows('quest__item') ) : the_row(); ?>
    <div class="quest__item" data-aos="fade-down" data-aos-duration="800">
        <div class="quest__ok"><img src="<?php the_sub_field("ok__img");?>" alt="ok"></div>
        <div class="quest__text"><?php the_sub_field("quest__text");?></span></div>
    </div>
<?    endwhile; endif; ?>