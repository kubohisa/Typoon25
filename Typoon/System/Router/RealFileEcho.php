<?php

$extensions = [
    "html" => "text/html",
    "css" => "text/css",
    "js" => "application/javascript",
    "json" => "application/json",
    "xml" => "application/xml",
    "jpg" => "image/jpeg",
    "jpeg" => "image/jpeg",
    "png" => "image/png",
    "gif" => "image/gif",
    "svg" => "image/svg+xml",
    "ico" => "image/vnd.microsoft.icon",
    "woff" => "font/woff",
    "woff2" => "font/woff2",
    "ttf" => "font/ttf",
    "otf" => "font/otf",
    "eot" => "application/vnd.ms-fontobject",
    "mp4" => "video/mp4",
    "webm" => "video/webm",
    "ogg" => "audio/ogg",
    "mp3" => "audio/mpeg",
    "wav" => "audio/wav",
    "pdf" => "application/pdf",
    "zip" => "application/zip",
    "tar" => "application/x-tar",
    "rar" => "application/x-rar-compressed",
    "txt" => "text/plain",
    "csv" => "text/csv",
    "md" => "text/markdown",

    "pdf" => "application/pdf",
    "htm" => "text/html",
    // 必要に応じて追加
]; // https://www.abe-tatsuya.com/techblog/article/15

//
$ext = pathinfo($_SERVER["REQUEST_URI"], PATHINFO_EXTENSION);

// 拡張子がphpならエラーページへ
if ($ext === "php") {
    errorPage(404);
    exit;
}

// MIME-Type をヘッダーに設定
$mimeType = $extensions[$ext] ?? "application/octet-stream"; // 未定義の場合はデフォルト値
header("Content-Type: $mimeType");

// ファイルの内容を出力
readfile("." . $_SERVER["REQUEST_URI"]);
exit;
