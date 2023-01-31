<?php 
        $commentbox_args=[
            'class_container' => 'comment-form',
            'class_form' => '',
            'class_submit'=>'btn btn-outline-success',
            'label_submit' => 'Enviar',
            'comment_field' => '<div class="row my-3 justify-content-center">
            <textarea class="col-8" name="comment" id="" cols="4" rows="10" placeholder="Write comment!!!"></textarea>
            </div>',
            'comment_notes_after' => '<div class="row my-3 gx-5 justify-content-end pe-5">',
            'submit_field' => '<div class ="col-2">%1$s</div><div class ="col-2">%2$s</div></div>'
        ];
        comment_form($commentbox_args);

    $args = array(
        'status' => 'approve',
    );
    
    // The comment Query
    $comments_query = new WP_Comment_Query();
    $comments       = $comments_query->query( $args );
    
    // Comment Loop
    if ( $comments ) { ?>
        <section class="comment-section">
            <ul class="list-group">
                <?php   wp_list_comments( [
                        'reverse_top_level' => true,
                        'style' => 'ul'
                    ], $comments);
                ?> 
            </ul>
        </section>

    <?php
    } else {
        echo 'No comments found.';
    }


;?>