<?php

namespace App\Libs;

use App\Models\Price;

class PriceLibs {
    static function set ($type, $relatedEntity, $datas)
    {
        return Self::__setNewPrice($type, $relatedEntity, $datas);
    }

    static function replace ($type, $relatedEntity, $datas)
    {
        if (Self::__updateOldPrice($type, $relatedEntity, isset($datas['startDate']) ? $datas['startDate'] : null )) {
            return Self::__setNewPrice($type, $relatedEntity, $datas);
        };
    }

    static function find ($type, $relatedEntity)
    {
        return Price::where('relatedEntityType', '=', $type)->where('relatedEntityId', '=', $relatedEntity)->get();
    }

    static private function __setNewPrice ($type, $relatedEntity, $datas)
    {
        // $type => 0 : room, 1: products/services
        $newPrices['relatedEntityId'] = $relatedEntity;
        $newPrices['relatedEntityType'] = $type;
        $newPrices['startDate'] = isset($datas['startDate']) ? $datas['startDate'] : time();
        $newPrices['amounts'] = [
            'public' => $datas['amounts']['public'],
            'member' => isset($datas['amounts']['member']) ? $datas['amounts']['member'] : null,
            'co' => isset($datas['amounts']['co']) ? $datas['amounts']['co'] : null,
        ];



        $price = Price::create($newPrices);

        return $price->fresh();

    }

    static private function __updateOldPrice ($type, $relatedEntity, $date)
    {
        $oldPrice = Price::
            where('relatedEntityId', '=', $relatedEntity)
            ->where('relatedEntityType', '=', $type)
            ->whereNull('endDate')
            ->first();

        if ($oldPrice) {
            return $oldPrice->update(['endDate' => isset($date) ? $date : time()]);
        };

        return true;
    }


}
