<?php

namespace App\Libs;

use App\Models\Price;

class PriceLibs {
    static function set ($type, $relatedEntity, $datas)
    {
        Self::__setNewPrice($type, $relatedEntity, $datas);
    }

    static function replace ($type, $relatedEntity, $datas)
    {
        Self::__updateOldPrice($type, $relatedEntity);

        Self::__setNewPrice($type, $relatedEntity, $datas);
    }

    static private function __setNewPrice ($type, $relatedEntity, $datas)
    {
        // $type => 0 : room, 1: products/services
        $newPrices['relatedEntityId'] = $relatedEntity;
        $newPrices['relatedEntityType'] = $type;
        $newPrices['startDate'] = new \Datetime();
        $newPrices['amounts'] = $datas;
        return Price::create($newPrices);
    }

    static private function __updateOldPrice ($type, $relatedEntity)
    {
        $oldPrice = Price::
            where('relatedEntityId', '=', $relatedEntity)
            ->where('relatedEntityType', '=', $type)
            ->whereNull('endDate')
            ->first();

        if ($oldPrice) {
            $oldPrice->update(['endDate' => new \Datetime()]);
        };
    }


}
