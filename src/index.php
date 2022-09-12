<?php
require __DIR__ . '/config.php';
require __DIR__ . '/const/constants.php';
require __DIR__ . '/utils/NetUtil.php';
require __DIR__ . '/database/db_config.php';
require __DIR__ . '/database/db_func.php';
require __DIR__ . '/utils/RoutesUtil.php';
require __DIR__ . '/service/Controller.php';

RoutesUtil::route(GET_AD_PATTERN, function () {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $adId = explode('/', $path);
    Controller::getAd(end($adId), $_GET['fields'] ?? []);
});

RoutesUtil::route(GET_COUNT_PATTERN, function () {
    Controller::getCount();
});
RoutesUtil::route(ADD_AD_PATTERN, function () {
    $postData = json_decode(file_get_contents('php://input'), true);
    Controller::add($postData['title'] ?? '', $postData['text'] ?? '', $postData['price'] ?? '', $postData['images'] ?? '');
});

RoutesUtil::route(GET_ADS_PATTERN, function () {
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $page = explode('/', $path);
    Controller::getAds(end($page), $_GET['isPriceSort'] ?? 0, $_GET['isTimeSort'] ?? 0, $_GET['perPage'] ?? 0);
});

RoutesUtil::execute();
