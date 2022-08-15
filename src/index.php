<?php
require __DIR__ . '/config.php';
require __DIR__ . '/const/constants.php';
require __DIR__ . '/utils/NetUtil.php';
require __DIR__ . '/database/dbConfig.php';
require __DIR__ . '/database/dbFunc.php';
require __DIR__ . '/utils/RoutesUtil.php';
require __DIR__ . '/controller/controller.php';
//ad/1?fields[]=text&fields[]=images
RoutesUtil::route(GET_AD_PATTERN, function () {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $adId = explode('/', $path);
    controller::getAd(end($adId), $_GET['fields'] ?? []);
});

RoutesUtil::route(GET_COUNT_PATTERN, function () {
    controller::getCount();
});
RoutesUtil::route(ADD_AD_PATTERN, function () {
    $postData = json_decode(file_get_contents('php://input'), true);
    controller::add($postData['title'] ?? "", $postData['text'] ?? "", $postData['price'] ?? "", $postData['images'] ?? "");
});

//ads/1?isPriceSort=1&isTimeSort=-1
RoutesUtil::route(GET_ADS_PATTERN, function () {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $page = explode('/', $path);
    controller::getAds(end($page), $_GET['isPriceSort'] ?? 0, $_GET['isTimeSort'] ?? 0, $_GET['perPage'] ?? 0);
});

RoutesUtil::route('/adsapi/addimages', function () use ($HTTP_POST_FILES) {
    vardump($_FILES);
    vardump($_POST);
    vardump($HTTP_POST_FILES);
//    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//    $page = explode('/', $path);
//    controller::getAds(end($page), $_GET['isPriceSort'] ?? 0, $_GET['isTimeSort'] ?? 0);
});

RoutesUtil::execute();