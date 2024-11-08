<?php
$port = getenv('PORT') ?: 8000;

$app = require_once __DIR__.'/public/index.php';

$httpHost = '0.0.0.0:' . $port;
$httpApp = new React\Http\HttpServer($app);
$httpApp->listen(new React\Socket\Server($httpHost));

echo "Laravel development server started on http://localhost:$port\n";
