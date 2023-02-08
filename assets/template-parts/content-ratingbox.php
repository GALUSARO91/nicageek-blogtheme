

<form class="col-4 rating-box" id="rating-form">
    <div class="rating-box-content">
        <input id="radio1" type="radio" name="rating" value="5" <?php if($args["rating_data"]==5){echo 'checked';}?>><!--
        --><label for="radio1">★</label><!--
        --><input id="radio2" type="radio" name="rating" value="4" <?php if($args["rating_data"]==4){echo 'checked';}?>><!--
        --><label for="radio2">★</label><!--
        --><input id="radio3" type="radio" name="rating" value="3" <?php if($args["rating_data"]==3){echo 'checked';}?>><!--
        --><label for="radio3">★</label><!--
        --><input id="radio4" type="radio" name="rating" value="2" <?php if($args["rating_data"]==2){echo 'checked';}?>><!--
        --><label for="radio4">★</label><!--
        --><input id="radio5" type="radio" name="rating" value="1" <?php if($args["rating_data"]==1){echo 'checked';}?>><!--
        --><label for="radio5">★</label>
    </div>
    <input type="text" name="user_id" id="" value="<?php echo $args["user_id"];?>" style="display:none">
    <input type="text" name="post" id="" value="<?php echo $args["post_id"];?>" style="display:none">
</form>
