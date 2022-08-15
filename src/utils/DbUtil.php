<?php

class DbUtil
{
    public static function createOrderByString($sortByPrice, $sortByTime) : string
    {
        $orderString = "";
        $sortByPriceFlag = "DESC";
        $sortByTimeFlag = "DESC";
        if ($sortByPrice == 1) {
            $sortByPriceFlag = "";
        }
        if ($sortByTime == 1) {
            $sortByTimeFlag = "";
        }

        if ($sortByPrice != 0) {
            if ($sortByTime != 0) {
                $orderString = "ORDER BY price $sortByPriceFlag, date $sortByTimeFlag";
            } else {
                $orderString = "ORDER BY price $sortByPriceFlag";
            }
        } elseif($sortByTime != 0) {
            $orderString = "ORDER BY date $sortByTimeFlag";
        }
        return $orderString;
    }

    public static function createImagesPathString($ad_id, $images_name) : string
    {
        $images_path_string = "";
        for ($index = 0; $index < sizeof($images_name); $index++) {
            if ($index == sizeof($images_name) - 1) {
                $images_path_string .= "('$ad_id', '$images_name[$index]')";
            } else {
                $images_path_string .= "('$ad_id', '$images_name[$index]'), ";
            }
        }
        return $images_path_string;
    }


}