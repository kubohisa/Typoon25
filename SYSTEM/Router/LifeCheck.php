<?php

header('Content-Type: application/json');

http_response_code(200);

echo json_encode([
    'status' => 'OK',
    'timestamp' => date('Y-m-d H:i:s')
]);

exit;
