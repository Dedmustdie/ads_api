<?php
require __DIR__ . '/../utils/DbUtil.php';
function getAdsCount(): array
{
    try {
        global $pdo;
        $res = $pdo->query("SELECT COUNT(*) FROM ads");
        return ['adsCount' => $res->fetchColumn()];
    } catch (Exception $exception) {
        NetUtil::sendError(INTERNAL_SERVER_ERROR_CODE, "Internal server error");
    }
}

function getAds($start, $per_page, $sortByPrice, $sortByTime): array
{
    try {
        global $pdo;
        $start = ($start - 1) * $per_page;
        $orderByString = DbUtil::createOrderByString($sortByPrice, $sortByTime);
        $res = $pdo->query("SELECT * FROM ads $orderByString LIMIT $start, $per_page");
        return $res->fetchAll();
    } catch (Exception $exception) {
        NetUtil::sendError(INTERNAL_SERVER_ERROR_CODE, "Internal server error");
    }
}

function getShortAd($adId): array
{
    try {
        global $pdo;
        $res = $pdo->query("SELECT id, title, price FROM ads where $adId = id");
        return $res->fetch();
    } catch (Exception $exception) {
        NetUtil::sendError(INTERNAL_SERVER_ERROR_CODE, "Internal server error");
    }
}

function getAd($adId): array
{
    try {
        global $pdo;
        $res = $pdo->query("SELECT id, title, price, text FROM ads where $adId = id");
        return $res->fetch();
    } catch (Exception $exception) {
        NetUtil::sendError(INTERNAL_SERVER_ERROR_CODE, "Internal server error");
    }
}

function getImages($adId): array
{
    try {
        global $pdo;
        $res = $pdo->query("SELECT image_name FROM images where $adId = ad_id");
        return $res->fetchAll(PDO::FETCH_COLUMN);
    } catch (Exception $exception) {
        NetUtil::sendError(INTERNAL_SERVER_ERROR_CODE, "Internal server error");
    }
}

function getImage($adId): array
{
    try {
    global $pdo;
    $res = $pdo->query("SELECT image_name FROM images where $adId = images.ad_id");
    return $res->fetchAll();
    } catch (Exception $exception) {
        NetUtil::sendError(INTERNAL_SERVER_ERROR_CODE, "Internal server error");
    }
}

function addAd($title, $text, $price): int
{
    try {
    global $pdo;
    $date = date('Y-m-d H:i:s');
    $pdo->query("INSERT INTO ads (title, text, price, date) VALUES ('$title', '$text', '$price', '$date')");
    return $pdo->lastInsertId();
    } catch (Exception $exception) {
        NetUtil::sendError(INTERNAL_SERVER_ERROR_CODE, "Internal server error");
    }
}

function addImages($ad_id, $images_name): void
{
    try {
    global $pdo;
    $images_path_string = DbUtil::createImagesPathString($ad_id, $images_name);
    $pdo->query("INSERT INTO images (ad_id, image_name) VALUES $images_path_string");
    } catch (Exception $exception) {
        NetUtil::sendError(INTERNAL_SERVER_ERROR_CODE, "Internal server error");
    }
}

function vardump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}
