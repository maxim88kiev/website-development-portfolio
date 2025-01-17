<?php
error_reporting(-1);
ini_set('display_errors', 1);


define('_JEXEC', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . 'administrator/components/com_lasercity/helpers/libraries/image_conversions.php';

function getDirContents($dir, $filter = '', &$results = array())
{
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);

        if (!is_dir($path)) {
            if (empty($filter) || preg_match($filter, $path)) $results[] = $path;
        } elseif ($value != "." && $value != "..") {
            getDirContents($path, $filter, $results);
        }
    }

    return $results;
}

//$images = getDirContents($_SERVER['DOCUMENT_ROOT'] . 'images', '/^((?!(jpg|png)).)*\.(jpg|png)$/');
//$images = getDirContents($_SERVER['DOCUMENT_ROOT'] . 'images', '(_2x\.)');
$images = getDirContents($_SERVER['DOCUMENT_ROOT'] . 'images', '(jpg|png)');
//$images = getDirContents($_SERVER['DOCUMENT_ROOT'] . 'images');
//$images = getDirContents($_SERVER['DOCUMENT_ROOT'] . 'images', '([0-9]{2,3}x)');
//$images = getDirContents($_SERVER['DOCUMENT_ROOT'] . 'images', '(_retina)');

/*echo '<pre>';
print_r($images);
echo '</pre>';*/

/*foreach ($images as $image) {
    unlink($image);
}*/

/*echo '<pre>';
print_r($images);
echo '</pre>';*/

/*foreach ($images as $image) {
    $imageConversion = new ImageConversion($image);
    $dimensions = array(
        array(
            'width' => 262,
            'height' => 198,
            'quality' => 100
        ),
        array(
            'width' => 90,
            'height' => 68,
            'quality' => 100
        )
    );
    $imageConversion->convert($dimensions, ['jpg', 'webp'], true);
}*/

/*$imageConversion = new ImageConversion('placehold.jpg');

$dimensions = array(
    array(
        'width' => 262,
        'height' => 198,
        'quality' => 100
    ),
    array(
        'width' => 90,
        'height' => 68,
        'quality' => 100
    )
);*/

/*$imageConversion->convert($dimensions, ['jpg', 'webp'], true);
foreach ($dimensions as $dimension):  */ ?><!--
    <img src="/poligon/placehold.jpg_<? /*= $dimension['width'] . 'x' . $dimension['height'] . '.jpg' */ ?>" alt="">
    <img src="/poligon/placehold.jpg_<? /*= ($dimension['width'] * 2) . 'x' . ($dimension['height'] * 2) . '.jpg' */ ?>" alt="">
    <img src="/poligon/placehold.jpg_<? /*= $dimension['width'] . 'x' . $dimension['height'] . '.webp' */ ?>" alt="">
    <img src="/poligon/placehold.jpg_<? /*= ($dimension['width'] * 2) . 'x' . ($dimension['height'] * 2) . '.webp' */ ?>" alt="">
    <br>
<?php /*endforeach; */ ?>


<img src="/poligon/placehold.jpg" alt="">-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @keyframes rotate {
            from {
                transform: rotate(360deg);
            }
        }
        @keyframes rotate_i {
            from {
                transform: rotate(-360deg);
            }
        }
        
        body {
            background: #000;
            display: flex;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            height: 100vh;
            padding: 0;
            margin: auto;
            overflow: hidden;
        }

        #text {
            font-size: 72px;
            animation: rotate_i 5s linear infinite;
        }

        #text > span {
            animation: rotate_i 1ms linear infinite;
        }
    </style>
</head>
<body>

<span id="text"></span>

<script>
    //const matList = JSON.parse('["\u0411\u041b\u042f\u0414\u042c","\u0415\u0411\u0410\u0422\u042c","\u0415\u0431\u043b\u044f","\u0401\u0411","\u041f\u0418\u0417\u0414\u0410","\u0425\u0423\u0419","\u0411\u041b\u042f!","\u0411\u041b\u042f\u0414\u0418\u0410\u0414\u0410","\u0411\u041b\u042f\u0414\u0418\u041d\u0410","\u0411\u041b\u042f\u0414\u0418\u0421\u0422\u041e\u0421\u0422\u042c","\u0411\u041b\u042f\u0414\u041e\u0413\u041e\u041d","\u0411\u041b\u042f\u0414\u041e\u0421\u041b\u041e\u0412\u041d\u0418\u041a","\u0411\u041b\u042f\u0414\u0421\u041a\u0418\u0419","\u0411\u041b\u042f\u0414\u0421\u0422\u0412\u041e","\u0411\u041b\u042f\u0425\u041e\u041c\u0423\u0414\u0418\u042f","\u0412\u0417\u0411\u041b\u042f\u0414","\u0412\u041f\u0418\u0417\u0414\u042f\u0427\u0418\u041b","\u0412\u042b\u0411\u041b\u042f\u0414\u041e\u0412\u0410\u041b","\u0412\u042b\u0411\u041b\u042f\u0414\u041e\u041a","\u0412\u042b\u0415\u0411\u041e\u041d","\u0412\u042b\u0401\u0411\u042b\u0412\u0410\u0415\u0422\u0421\u042f","\u0413\u041b\u0423\u041f\u0418\u0417\u0414\u0418","\u0413\u041e\u041b\u041e\u0401\u0411\u0418\u0426\u0410","\u0413\u0420\u0415\u0411\u041b\u042f\u0414\u042c","\u0414\u0415\u0420\u042c\u041c\u041e\u0425\u0415\u0420\u041e\u041f\u0418\u0417\u0414\u041e\u041a\u0420\u0410\u0422","\u0414\u0415\u0420\u042c\u041c\u041e\u0425\u0415\u0420\u041e\u041f\u0418\u0417\u0414\u041e\u041a\u0420\u0410\u0422\u0418\u042f","\u0414\u041e\u0415\u0411\u0410\u041b\u0421\u042f","\u0415\u0411\u0410\u041b\u041e","\u0415\u0411\u0410\u041d\u0401\u0428\u042c\u0421\u042f","\u0415\u0411\u0410\u041d\u0423\u041b","\u0415\u0411\u0410\u041d\u0423\u041b\u0421\u042f","\u0415\u0411\u0410\u0428\u0418\u0422","\u0401\u0411\u041a\u041e\u0421\u0422\u042c","\u0401\u0411\u041d\u0423\u041b?","\u0416\u0418\u0414\u041e\u0401\u0411","\u0416\u0418\u0414\u041e\u0401\u0411\u041a\u0410","\u0416\u0418\u0414\u041e\u0401\u0411\u0421\u041a\u0418\u0419","\u0417\u0410\u0415\u0411\u0410\u041b","\u0417\u0410\u0415\u0411\u0418\u0421\u042c!","\u0417\u0410\u0415\u0411\u0426\u041e\u0412\u042b\u0419","\u0417\u0410\u0401\u0411","\u0418\u0417\u042a\u0415\u0411\u041d\u0423\u041b\u0421\u042f","\u0418\u0421\u041f\u0418\u0417\u0414\u0415\u041b\u0421\u042f","\u041a\u041e\u0417\u041b\u041e\u0401\u0411","\u041a\u041e\u0417\u041b\u041e\u0401\u0411\u0418\u041d\u0410","\u041a\u041e\u0417\u041b\u041e\u0401\u0411\u0418\u0429\u0415","\u041a\u041e\u0421\u041e\u0401\u0411\u0418\u0422\u0421\u042f","\u041c\u041d\u041e\u0413\u041e\u041f\u0418\u0417\u0414\u041d\u0410\u042f","\u041d\u0410\u0411\u041b\u042f\u0414\u041e\u0412\u0410\u041b","\u041d\u0410\u0415\u0411\u0410\u0428\u0418\u041b\u0421\u042f","\u041d\u0410\u0415\u0411\u041d\u0423\u041b\u0421\u042f","\u041e\u0411\u0415\u0420\u0411\u041b\u042f\u0414\u042c","\u041e\u0411\u042a\u0415\u0411\u0410\u041b","\u041e\u0411\u042a\u0415\u0411\u0410\u0422\u0415\u041b\u042c\u0421\u0422\u0412\u041e","\u041e\u0414\u041d\u041e\u0425\u0423\u0419\u0421\u0422\u0412\u0415\u041d\u041d\u041e","\u041e\u041f\u0418\u0417\u0414\u041e\u0423\u041c\u0415\u041b","\u041e\u0421\u041a\u041e\u0422\u041e\u0401\u0411\u0418\u041b\u0421\u042f","\u041e\u0421\u0422\u041e\u0415\u0411\u0410\u041b","\u041f\u0401\u0417\u0414\u042b","\u041f\u0418\u0417\u0414\u0410\u0411\u041e\u041b","\u041f\u0418\u0417\u0414\u0410\u0422\u042b\u0419","\u041f\u0418\u0417\u0414\u0415\u041b\u042f\u041a\u0410\u0415\u0422","\u041f\u0418\u0417\u0414\u0415\u0426","\u041f\u0418\u0417\u0414\u0415\u0426\u041a\u0418\u0419","\u041f\u0418\u0417\u0414\u041e\u0411\u041b\u041e\u0428\u041a\u0410","\u041f\u0418\u0417\u0414\u041e\u0411\u0420\u0410\u0422","\u041f\u0418\u0417\u0414\u041e\u0411\u0420\u0410\u0422\u0418\u042f","\u041f\u0418\u0417\u0414\u041e\u0412\u041b\u0410\u0414\u0415\u041b\u0415\u0426","\u041f\u0418\u0417\u0414\u041e\u0414\u0423\u0428\u0418\u0415","\u041f\u0418\u0417\u0414\u041e\u0401\u0411\u0418\u0429\u041d\u041e\u0421\u0422\u042c","\u041f\u0418\u0417\u0414\u041e\u041c\u0410\u041d\u0418\u042f","\u041f\u0418\u0417\u0414\u041e\u041f\u041b\u042f\u0421\u041a\u0410","\u041f\u0418\u0417\u0414\u0420\u0418\u041a","\u041f\u041e\u0414\u041f\u0418\u0417\u0414\u042b\u0412\u0410\u0415\u0422","\u041f\u041e\u0414\u042a\u0401\u0411\u041a\u0410","\u041f\u041e\u0414\u042a\u0401\u0411\u041a\u0418","\u041f\u041e\u0415\u0411\u0415\u041d\u042c","\u0420\u0410\u0421\u041f\u0418\u0417\u0414\u041e\u0428\u0418\u041b","\u0420\u0410\u0421\u041f\u0418\u0417\u0414\u042f\u0419","\u0421\u041a\u041e\u0422\u041e\u0401\u0411","\u0421\u041a\u041e\u0422\u041e\u0401\u0411\u0418\u041d\u0410","\u0421\u041e\u0421\u0418\u0425\u0423\u0419\u0421\u041a\u0418\u0419","\u0421\u041f\u0418\u0417\u0414\u0418\u041b","\u0421\u0422\u0420\u0410\u0425\u041e\u0401\u0411\u0418\u0429\u0415","\u0422\u0420\u0415\u041f\u0415\u0417\u0414\u041e\u041d","\u0422\u0420\u0415\u041f\u0415\u0417\u0414\u041e\u041d\u0418\u0422","\u0423\u0415\u0411\u0410\u041b\u0421\u042f","\u0423\u0401\u0411\u0418\u0429\u0415","\u0423\u0401\u0411\u0418\u0429\u0415\u041d\u0421\u041a\u0418","\u0425\u0418\u0422\u0420\u041e\u0412\u042b\u0415\u0411\u0410\u041d\u041d\u042b\u0419","\u0425\u0423\u0415\u0414\u0418\u041d","\u0425\u0423\u0415\u041b\u0415\u0421","\u0425\u0423\u0415\u041c\u0410\u041d","\u0425\u0423\u0401\u0412\u041e","\u0425\u0423\u0419\u041d\u042f","\u0428\u0410\u0420\u041e\u0401\u0411\u0418\u0422\u0421\u042f","\u0411\u0415\u0417 \u041f\u0418\u0417\u0414\u042b!","\u0411\u0415\u0417 \u041f\u0418\u0417\u0414\u042b?!","\u0411\u041b\u042f \u0411\u0423\u0414\u0423!","\u0411\u041b\u042f\u0414\u0415\u041c\u0423\u0414\u0418\u041d\u042b\u0419 \u041f\u0418\u0417\u0414\u041e\u041f\u0420\u041e\u0401\u0411","\u0412\u0414\u0420\u0423\u0413, \u041e\u0422\u041a\u0423\u0414\u0410 \u041d\u0418 \u0412\u041e\u0417\u042c\u041c\u0418\u0421\u042c, \u041f\u041e\u042f\u0412\u0418\u041b\u0421\u042f \u0412 \u0420\u041e\u0422 \u0415\u0411\u0418\u0421\u042c!","\u0412 \u041f\u0418\u0417\u0414\u0423  \u0412 \u041f\u0418\u0417\u0414\u0423!","\u0412\u042b\u0421\u0428\u0418\u0419 \u041f\u0418\u0417\u0414\u0415\u0426!","\u0413\u041e\u041b\u041e\u0412\u041a\u0410 \u041e\u0422 \u0425\u0423\u042f!","\u0414\u0410 \u0415\u0411\u0410\u041b \u042f!","\u0414\u0410 \u0425\u0423\u0419 \u0415\u0413\u041e \u041d\u0415 \u0412\u041e\u0417\u042c\u041c\u0401\u0422!","\u0415\u0411\u0410\u041b\u042c\u041d\u0418\u041a \u0420\u0410\u0417\u0418\u041d\u0423\u041b","\u0415\u0411\u0410\u041b\u042c\u041d\u042b\u0419 \u0421\u0422\u0410\u041d\u041e\u041a","\u0415\u0411\u0401\u0422 \u0412 \u0420\u041e\u0422 \u0418 \u0412 \u0416\u041e\u041f\u0423","\u0401\u0411\u0410\u041d\u042b\u0419 \u0421\u0422\u041e\u0421!","\u0401\u0411  \u0422\u0412\u041e\u042e \u041c\u0410\u0422\u042c!","\u0417\u0410\u0415\u0411\u0401\u0428\u042c \u041c\u0401\u0420\u0422\u0412\u041e\u0413\u041e!","\u0417\u0410\u041f\u0420\u041e\u0421\u0422\u041e \u0425\u0423\u0419!","\u0417\u0410 \u041f\u0420\u041e\u0421\u0422\u041e \u0425\u0423\u0419","\u041a\u0410\u041a \u0401\u0411 \u0422\u0412\u041e\u042e \u041c\u0410\u0422\u042c!","\u041a\u041e\u0413\u0414\u0410 \u0422\u042b \u041f\u0418\u0417\u0414\u0418\u0428\u042c, \u042f \u041e\u0422\u0414\u042b\u0425\u0410\u042e!","\u041c\u0410\u041b\u041e\u0415\u0411\u0423\u0429\u0418\u0419  \u0424\u0410\u041a\u0422\u041e\u0420","\u041d\u0410\u0421\u0422\u0420\u0415\u041b\u042f\u041b\u0418  \u041f\u041e \u041f\u0418\u0417\u0414\u042e\u041b\u042f\u0422\u041e\u0420\u0423","\u041d\u0415 \u041f\u0418\u0417\u0414\u0415\u0422\u042c \u0411\u042b\u041b\u0410 \u041a\u041e\u041c\u0410\u041d\u0414\u0410!","\u0410\u041f\u041f\u0415\u0422\u0418\u0422 \u041f\u0420\u0418\u0425\u041e\u0414\u0418\u0422 \u0412\u041e \u0412\u0420\u0415\u041c\u042f \u041f\u0418\u0417\u0414\u042b","\u0411\u042b\u0412\u0410\u0415\u0422 \u0420\u041e\u0414\u0418\u041d\u0410  \u041c\u0410\u0422\u042c, \u0410 \u0411\u042b\u0412\u0410\u0415\u0422 \u0418 \u0401\u0411 \u0415\u0401 \u041c\u0410\u0422\u042c","\u0412\u0415\u041b\u0418\u041a\u0410 \u0414\u0415\u041d\u0415\u0413 \u041a\u0423\u0427\u0410 \u0425\u0423\u0419 \u041d\u0410\u0414\u041e\u041a\u0423\u0427\u0418\u0422","\u0412\u0415\u0420\u041d\u0410\u042f \u0416\u0415\u041d\u0410 \u0422\u041e\u041b\u042c\u041a\u041e  \u0425\u0423\u0415\u041c \u041f\u041e\u0422\u0415\u0428\u0410\u0415\u0422\u0421\u042f","\u0412\u0415\u0421\u041d\u041e\u0419 \u0418 \u0429\u0415\u041f\u041a\u0410 \u041e \u0429\u0415\u041f\u041a\u0423 \u0422\u0420\u0401\u0422\u0421\u042f,  \u0412\u0415\u0421\u041d\u041e\u0419 \u0418 \u041a\u041e\u0411\u042b\u041b\u0410 \u0421 \u041a\u041e\u041c\u0410\u0420\u041e\u041c \u0415\u0411\u0401\u0422\u042c\u0421\u042f","\u0414\u0415\u0412\u042f\u0422\u042c \u0413\u0420\u0410\u041c\u041c\u041e\u0412 \u0412 \u041b\u041e\u0411 \u0421\u0412\u0418\u041d\u0426\u0410,  \u0422\u041e \u041d\u0410\u0413\u0420\u0410\u0414\u0410 \u041c\u041e\u041b\u041e\u0414\u0426\u0410","\u0414\u041b\u042f \u0422\u041e\u0413\u041e \u0418 \u0429\u0423\u041a\u0410, \u0427\u0422\u041e\u0411\u042b \u0412 \u041c\u041e\u0420\u0415 \u0415\u0411\u041b\u041e\u0422\u041e\u0420\u0413\u041e\u0412\u041b\u042f \u041d\u0415 \u041f\u0420\u041e\u0426\u0412\u0415\u0422\u0410\u041b\u0410","\u0415\u0421\u041b\u0418  \u0417\u0410 \u0420\u0423\u041b\u0401\u041c \u041f\u0418\u0417\u0414\u0410, \u042d\u0422\u041e \u0411\u0420\u0410\u0422\u0426\u042b \u041d\u0415 \u0415\u0417\u0414\u0410","\u041a\u0422\u041e \u041c\u041d\u041e\u0413\u041e \u041f\u0418\u0417\u0414\u0418\u0422, \u0422\u041e\u0422 \u041c\u0410\u041b\u041e \u0416\u0418\u0412\u0401\u0422","\u041a\u0422\u041e \u0421 \u0412\u041e\u0414\u041a\u041e\u0419 \u0414\u0420\u0423\u0416\u0415\u041d  \u0422\u041e\u041c\u0423 \u0425\u0423\u0419 \u041d\u0415 \u041d\u0423\u0416\u0415\u041d","\u041d\u0415\u0412\u0415\u0417\u0423\u0427\u0415\u041c\u0423 \u041b\u042e\u0411\u041e\u0419 \u041f\u0418\u0417\u0414\u0415\u0426  \u0412\u0421\u0422\u0420\u0415\u0427\u041d\u042b\u0419","\u041f\u041e \u0417\u0410\u0421\u041b\u0423\u0413\u0410\u041c \u041c\u041e\u041b\u041e\u0414\u0426\u0410 \u0411\u0423\u0414\u0415\u0422 \u041c\u0415\u0420\u0410 \u041f\u0418\u0417\u0414\u0415\u0426\u0410","\u041f\u041e\u0421\u0410\u0414\u0418\u0412 \u0417\u0410 \u0420\u0423\u041b\u042c \u041f\u0418\u0417\u0414\u0423, \u0416\u0414\u0418 \u041f\u0418\u0417\u0414\u0415\u0426, \u0410 \u041d\u0415 \u0415\u0417\u0414\u0423","\u0411\u0420\u0410\u041d\u0418\u0422\u042c\u0421\u042f","\u0411\u0420\u0410\u041d\u042c","\u0412\u042b\u0420\u0410\u0416\u0410\u0415\u0422\u0421\u042f","\u0412\u042b\u0420\u0410\u0416\u0410\u0415\u0422\u0421\u042f \u041c\u0410\u0422\u041e\u041c","\u0413\u041d\u0401\u0422","\u0417\u0410\u0413\u0418\u0411\u0410\u0415\u0422","\u0417\u0410\u0413\u0418\u0411\u0410\u0415\u0422, \u0410\u0416 \u0423\u0428\u0418 \u0412\u042f\u041d\u0423\u0422","\u0418 \u041d\u0410\u0425\u0423\u0419 \u0418 \u0417\u0410\u0425\u0423\u0419","\u041a\u041b\u0410\u0421\u0421\u0418\u0427\u0415\u0421\u041a\u041e\u0415 \u0421\u041b\u041e\u0412\u041e \u0418\u0417 \u0422\u0420\u0401\u0425 \u0411\u0423\u041a\u0412","\u041a\u0420\u0415\u041f\u041a\u0418\u0415 \u0412\u042b\u0420\u0410\u0416\u0415\u041d\u0418\u042f","\u041a\u0420\u0415\u041f\u041a\u041e \u0412\u042b\u0420\u0410\u0417\u0418\u041b\u0421\u042f","\u041a\u0420\u0415\u041f\u041a\u041e\u0415 \u0421\u041b\u041e\u0412\u041e","\u041a\u0420\u041e\u0415\u0422 \u041c\u0410\u0422\u041e\u041c, \u041a\u0410\u041a \u0421\u0410\u041f\u041e\u0416\u041d\u0418\u041a","\u041c\u0410\u0422","\u041c\u0410\u0422\u0415\u0420\u0418\u0422\u042c\u0421\u042f","\u041c\u0410\u0422\u0415\u0420\u0418\u0422\u042c\u0421\u042f, \u041a\u0410\u041a \u0421\u0410\u041f\u041e\u0416\u041d\u0418\u041a","\u041c\u0410\u0422\u0415\u0420\u041d\u0410\u042f \u0411\u0420\u0410\u041d\u042c","\u041c\u0410\u0422\u0415\u0420\u041d\u042b\u0415 \u0412\u042b\u0420\u0410\u0416\u0415\u041d\u0418\u042f","\u041c\u0410\u0422\u0415\u0420\u041d\u042b\u0415 \u0421\u041b\u041e\u0412\u0410","\u041c\u0410\u0422\u0415\u0420\u0429\u0418\u041d\u0410","\u041c\u0410\u0422\u0415\u0420\u0429\u0418\u041d\u041d\u0418\u041a","\u041c\u0410\u0422\u0415\u0420\u0429\u0418\u041d\u041d\u0418\u0426\u0410","\u041c\u0410\u0422\u041d\u042b\u0415 \u0421\u041b\u041e\u0412\u0410","\u041c\u0410\u0422\u041e\u041c \u041a\u0420\u041e\u0415\u0422","\u041c\u0410\u0422\u041e\u041c \u041a\u0420\u041e\u0415\u0422, \u0410\u0416 \u0423\u0428\u0418 \u0412\u042f\u041d\u0423\u0422","\u041c\u0410\u0422\u041e\u041c \u041a\u0420\u041e\u0415\u0422 \u0411\u0415\u041b\u042b\u0419 \u0421\u0412\u0415\u0422","\u041c\u0410\u0422\u042e\u0413","\u041c\u0410\u0422\u042e\u0413\u0410\u0415\u0422","\u041c\u0410\u0422\u042e\u0413\u0410\u0415\u0422\u0421\u042f","\u041c\u0410\u0422\u042e\u0413\u0410\u041d","\u041c\u0410\u0422\u042e\u0413\u041d\u0423\u041b\u0421\u042f","\u041c\u0410\u0422\u042e\u041a","\u041c\u0410\u0422\u042e\u041a\u0410\u0415\u0422","\u041c\u0410\u0422\u042e\u041a\u0410\u0415\u0422\u0421\u042f","\u041c\u0410\u0422\u042e\u041a\u041d\u0423\u041b\u0421\u042f","\u041c\u041d\u041e\u0413\u041e\u0422\u041e\u0427\u0418\u0415","\u041c\u041d\u041e\u0413\u041e\u042d\u0422\u0410\u0416\u041d\u041e\u0421\u0422\u042c","\u041d\u0415\u0426\u0415\u041d\u0417\u0423\u0420\u041d\u0410\u042f \u0411\u0420\u0410\u041d\u042c","\u041d\u0415\u0426\u0415\u041d\u0417\u0423\u0420\u041d\u042b\u0415 \u0412\u042b\u0420\u0410\u0416\u0415\u041d\u0418\u042f","\u041d\u0415\u0426\u0415\u041d\u0417\u0423\u0420\u0429\u0418\u041d\u0410","\u041e\u0411\u041b\u041e\u0416\u0418\u041b","\u041e\u0411\u041e\u041a\u0420\u042b\u0422\u042c \u041c\u0410\u0422\u041e\u041c","\u041e\u0411\u0420\u0423\u0413\u0410\u0422\u042c","\u041e\u0411\u0420\u0423\u0413\u0410\u0422\u042c \u041c\u0410\u0422\u041e\u041c","\u041e\u0421\u041a\u041e\u0420\u0411\u041b\u0415\u041d\u0418\u0415","\u041e\u0421\u041a\u041e\u0420\u0411\u0418\u0422\u042c","\u041f\u041b\u041e\u0429\u0410\u0414\u041d\u0410\u042f \u0411\u0420\u0410\u041d\u042c","\u041f\u041e\u0414\u0417\u0410\u0411\u041e\u0420\u041d\u0410\u042f \u0411\u0420\u0410\u041d\u042c","\u041f\u041e\u041a\u0420\u042b\u0412\u0410\u0415\u0422 \u041c\u0410\u0422\u041e\u041c","\u041f\u041e\u041a\u0420\u042b\u0422\u042c \u041c\u0410\u0422\u041e\u041c","\u041f\u041e\u041d\u041e\u0421\u0418\u0422\u0415\u041b\u042c\u041d\u042b\u0415 \u0421\u041b\u041e\u0412\u0410","\u041f\u041e\u0421\u041b\u0410\u041b \u041d\u0410 \u0422\u0420\u0418 \u0411\u0423\u041a\u0412\u042b","\u041f\u041e\u0421\u041b\u0410\u041b \u041d\u0410 \u0422\u0420\u0418 \u0412\u0415\u0421\u0401\u041b\u042b\u0425 \u0411\u0423\u041a\u0412\u042b","\u041f\u041e\u0421\u041b\u0410\u041b \u041f\u041e  \u041c\u0410\u0422\u0423\u0428\u041a\u0415","\u041f\u041e\u0425\u0410\u0411\u0429\u0418\u041d\u0410","\u0420\u0423\u0413\u0410\u0415\u0422\u0421\u042f","\u0420\u0423\u0413\u0410\u0415\u0422\u0421\u042f, \u041a\u0410\u041a \u0421\u0410\u041f\u041e\u0416\u041d\u0418\u041a","\u0420\u0423\u0413\u0410\u0415\u0422\u0421\u042f \u041c\u0410\u0422\u041e\u041c","\u0420\u0423\u0413\u0410\u041d\u042c","\u0420\u0423\u0413\u0410\u0422\u0415\u041b\u042c\u0421\u0422\u0412\u041e","\u0421\u041b\u041e\u0412\u041e \u0418\u0417 \u0422\u0420\u0401\u0425 \u0411\u0423\u041a\u0412","\u0422\u0420\u0418 \u0412\u0415\u0421\u0401\u041b\u042b\u0425 \u0411\u0423\u041a\u0412\u042b"," \u0423\u0428\u0418 \u0412\u042f\u041d\u0423\u0422","\u0425\u0423\u042f\u041c\u0418 \u041e\u0411\u041b\u041e\u0416\u0418\u041b","\u042d\u0412\u0424\u0415\u041c\u0418\u0417\u041c"]');
    const interval = function () {
        const color = function () {
            let result = '#';
            const symbols = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'];
            while (result.length < 7) {
                let index = Math.floor(Math.random() * symbols.length);
                result += symbols[index];
            }
            return result;
        };
        const textBlock = document.getElementById('text');
        textBlock.innerHTML = '';
        const text = 'тоді ладно!'; //matList[Math.floor(Math.random() * matList.length)];//
        for (let symbol of text) {
            const span = document.createElement('span');
            span.textContent = Math.floor(Math.random() * 2) === 1 ? symbol.toUpperCase() : symbol.toLowerCase();
            span.style.color = color();
            textBlock.appendChild(span);
        }
    };
    setInterval(interval, 1000);
</script>
</body>
</html>