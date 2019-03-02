<?php

namespace App\source\Tools;


class Basics
{

    public static function collectionToArray($collection)
    {
        if (count($collection) > 0) {
            $collection = $collection->toArray();
        } else {
            $collection = [];
        }
        return $collection;
    }
}
