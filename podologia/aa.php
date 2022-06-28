<?php echo get_template_directory_uri(); ?>
<?php the_field("") ?>
<?php the_sub_field("") ?>
<?php if( have_rows('photos') ):while ( have_rows('photos') ) : the_row();?>
    <div class="photo__item"><img src="<?php the_sub_field("photos-item") ?>" alt="photo__item"></div>
<?php endwhile; endif; ?>

