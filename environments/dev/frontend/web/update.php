<?php
echo "\n";
echo `git reset --hard`;
echo `git pull`;

# clear runtime
cleardir('../runtime');

# clear assets
cleardir('assets');

# clear css
//cleardir('css');

# compile sass compass
//echo "\ncompiling sass compass...\n";
//echo `compass compile`;
//rrmdir('.sass-cache');

# assets-prod.php
echo "\nremoving assets-prod.php...";
if (file_exists('../config/assets-prod.php')) {
    if (unlink('../config/assets-prod.php')) {
        echo "\nassets-prod.php removed\n";
    }
} else {
    echo "\nno assets-prod.php exists\n";
}

# done
echo "\ndone\n\n";

# helper functions

function cleardir($dir) {
    echo "\nclearing " . basename($dir) . "...";
    $errors = 0;
    foreach (glob($dir . '/*') as $match) {
        if (is_dir($match)) {
            if (!rrmdir($match)) {
                $errors++;
            }
        } else {
            if (!unlink($match)) {
                $errors++;
            }
        }
    }
    if ($errors === 0) {
        echo "\n" . basename($dir) . " cleared\n";
    }
}

function rrmdir($dir) {
    $errors = 0;
    foreach (glob($dir . '/*') as $match) {
        if (is_dir($match)) {
            if (!rrmdir($match)) {
                $errors++;
            }
        } else {
            if (!unlink($match)) {
                $errors++;
            }
        }
    }
    if (!rmdir($dir)) {
        $errors++;
    }
    return $errors === 0 ? true : false;
}
