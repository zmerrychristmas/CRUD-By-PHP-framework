<?php
    $url = isset($url) ? $url : site_url();
    $user_name = isset($user) ? $user->user_name : '';
    $user_email = isset($user) ? $user->user_email : '';
?>
<div class="col-md-9">
    <h2><?php echo $action; ?></h2>
    <?php echo validation_errors(); ?>
    <div class="row">
        <div class="col-md-9 messages" id="messages">

        </div>
        <div class="col-md-9">
            <form class="form" action="<?php echo $url; ?>" method="POST" id="user-form">
                  <div class="form-group">
                    <label for="user_name">Name<span class="require">(*)</span>:</label><span class="alert-message"></span>
                    <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $user_name; ?>" placeholder="User name" />
                  </div>
                  <div class="form-group">
                    <label for="user_email">Email address<span class="require">(*)</span>:</label><span class="alert-message"></span>
                    <input type="email" class="form-control" id="user_email" name="user_email" value="<?php echo $user_email; ?>" placeholder="User email" />
                  </div>
                  <button type="submit" class="btn btn-default" id="submit" name='submit' value="submit">Submit</button>
            </form>
        </div>
        <div class="clearfix"></div>
    </div>
</div>