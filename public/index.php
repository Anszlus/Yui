<?php

require __DIR__ . '/../app/init.php';

$app = new Yui();

require __DIR__ . '/../app/routers.php';

$app->run();