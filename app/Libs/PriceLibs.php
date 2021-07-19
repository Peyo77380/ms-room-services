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
        if (Self::__updateOldPrice($type, $relatedEntity, $datas['startDate'])) {
            return Self::__setNewPrice($type, $relatedEntity, $datas);
        };
    }

    static private function __setNewPrice ($type, $relatedEntity, $datas)
    {
        // $type => 0 : room, 1: products/services
        $newPrices['relatedEntityId'] = $relatedEntity;
        $newPrices['relatedEntityType'] = $type;
        $newPrices['startDate'] = $datas['startDate'] ? $datas['startDate'] : time();
        $newPrices['amounts'] = [
            'public' => $datas['public'],
            'member' => $datas['member'] ? $datas['member'] : null,
            'co' => $datas['co'] ? $datas['co'] : null,
        ];
        return Price::create($newPrices);
    }

    static private function __updateOldPrice ($type, $relatedEntity, $date)
    {
        $oldPrice = Price::
            where('relatedEntityId', '=', $relatedEntity)
            ->where('relatedEntityType', '=', $type)
            ->whereNull('endDate')
            ->first();

        if ($oldPrice) {
            return $oldPrice->update(['endDate' => $date ? $date : time()]);
        };
    }


}
