<div class="name">
<?php $text = get_the_content(); 
if ( $text != '' ){ ?><div class="triangle"><i class="fa fa-caret-right" aria-hidden="true"></i></div><?php } ?>
<p><span class="person"><?php the_title(); ?></span><br>
    <span class="italic"><?php the_field('title'); ?></span></p>

 <?php if ( $text != '' ){ ?>
        <div class='texte'>
            <?php the_content(); ?>
        </div>
    <?php } ?>
    
</div>
