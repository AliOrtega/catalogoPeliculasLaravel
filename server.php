<?php

require __DIR__ . '/vendor/autoload.php';

$port = getenv('PORT') ?: 8000;

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$httpHost = '0.0.0.0:' . $port;
$httpApp = new React\Http\HttpServer(function (Psr\Http\Message\ServerRequestInterface $request) use ($kernel) {
    $request = \Illuminate\Http\Request::createFromBase($request);
    $response = $kernel->handle($request);

    return new React\Http\Message\Response(
        $response->getStatusCode(),
        $response->headers->all(),
        $response->getContent()
    );
});

$socket = new React\Socket\Server($httpHost, $loop);
$httpApp->listen($socket);

echo "Laravel development server started on http://localhost:$port\n";

$loop->run();
