<?php

header('Content-type: application/json; charset=utf-8');

class controller
{
    public static function getAd($id, $fields): void
    {

        if (in_array('text', $fields)) {
            $res = getAd($id);
        } else {
            $res = getShortAd($id);
        }
        if (in_array('images', $fields)) {
            $res["images_name"] = getImages($res['id']);
        }

        if (empty($res)) {
            NetUtil::sendError(NOT_FOUND_CODE, "Ad not found ");
        }

        unset($res['id']);
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }

    public static function getCount(): void
    {
        echo json_encode(getAdsCount(), JSON_UNESCAPED_UNICODE);
    }

    public static function add($title, $text, $price, $images_name): void
    {
        if ($title == "" || $text == "" || $price == "" ||
            strlen($title) > MAX_TITLE_LENGTH || strlen($text) > MAX_TEXT_LENGTH ||
            strlen($price) > MAX_PRICE_LENGTH ||
            !is_numeric($price)) {
            NetUtil::sendError(NOT_FOUND_CODE, "Wrong parameters");
        }

        if (empty($images_name)) {
            addAd($title, $text, $price);
            netUtil::sendSuccess(SUCCESS_CODE, "Adding ad successfully");
        } else {
            if (count($images_name) > MAX_IMAGES_COUNT) {
                NetUtil::sendError(NOT_FOUND_CODE, "Wrong number of pictures");
            }
            addImages(addAd($title, $text, $price), $images_name);
            netUtil::sendSuccess(SUCCESS_CODE, "Adding ad successfully");
        }
    }

    public static function getAds($page, $sortByPrice, $sortByTime, $perPage): void
    {
        if ($page < 1 || $perPage < 1) {
            NetUtil::sendError(NOT_FOUND_CODE, "Wrong parameters");
        }
        $res = getAds($page, $perPage, $sortByPrice, $sortByTime);
        if (empty($res)) {
            NetUtil::sendError(NOT_FOUND_CODE, "Ads not found");
        }
        NetUtil::sendSuccess(SUCCESS_CODE, $res);
    }
}