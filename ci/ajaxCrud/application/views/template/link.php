<?php
    $link = isset($link) != NULL ? $link : [];
    // Include css
    if (isset($link['style'])) {
        echo '<!-- Include Style here-->' . "\n\t\t";
        foreach ($link['style'] as $key => $value) {
            echo '<link rel="stylesheet" type="text/css" href="'. '/public/assets/css/' . $value . '">';
            echo "\n\t\t";
        }
    }
    // Include script
    if (isset($link['script'])) {
        echo '<!-- Include Script here-->' . "\n\t\t";
        foreach ($link['script'] as $sc_key => $sc_value) {
            echo '<script rel="tex/javascript" src="'. '/public/assets/js/' . $sc_value . '"></script>';
            echo "\n\t\t";
        }
    }

    // Inner Style
    if (isset($style)) {
        echo '<!-- Intener style -->';
        echo '<style>' . "\n\t\t\t";
        echo $style . "\n\t\t";
        echo '</style>' . "\n";
    }

    // Inner Script
    if (isset($script)) {
        echo '<!-- Intener script -->';
        echo '<script type="text/javascript">' . "\n\t\t\t";
        echo $script . "\n\t\t";
        echo '</script>' . "\n";
    }
?>