<?php
/*
@package HOSPITAL-CMS
This file is for archive page of  custom post type
1, departments
2. facilities
3. private_insurences
4. goverment_schemes

*/

get_header();
?>

<header> 
    <div class = "hospital-title">
        <h1>
            <?php
                $cur_post_type_object = get_post_type_object(get_post_type());//this get the post_type obkect
                echo($cur_post_type_object->label);//echos it as title of archive page
            ?> 
        </h1>
    </div><!--end of .hospital-title -->
</header>
<div id="primary class = "hospital-content-area-without-sidebar>
    <main role='main'>
        <?php if(have_posts()):	?>
            <div style="clear: both;"></div><!-- dummy div for clear floats-->

                <?php 	while ( have_posts() ) : the_post();?>

                    <div class="hospital-archive-post">
                        <article>
                            <?php the_post_thumbnail(array(240, 112));
                            the_title( sprintf( '<h2 class="hospital-entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                            ?>
                        </article>
                    </div>
                <?php endwhile  ?>

            <?php endif; ?>
        
    </main> <!--end of main-->   
</div><!--end of .hospital-content-area-without-sidebar  -->


<?php




get_footer();