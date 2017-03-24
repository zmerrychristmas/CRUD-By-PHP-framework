<!DOCTYPE html>
<html>
    <head>
        <title><?php $title = isset($title) ? $title : 'Code Igniter'; echo $title; ?></title>
        <?php if(isset($link)) echo trim($link) . "\n"; ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php if(isset($header)) echo $header; ?>
                <?php if(isset($left)) echo $left; ?>
                <?php if(isset($content)) echo $content; ?>
                <?php if(isset($footer)) echo $footer; ?>
            </div>
        </div>
    </body>
</html>