<div class="col-md-3">
    <?php if (isset($menu_one_lines)) { ?>
        <ul class="menus">
            <?php foreach ($menu_one_lines as $key => $value) { ?>
                <li class="menu">
                    <a href="<?php echo $value; ?>"><?php echo $key; ?></a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>