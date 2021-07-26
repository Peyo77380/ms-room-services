<?php

namespace App\Libs;

use App\Models\Price;
use phpDocumentor\Reflection\Types\Self_;

class PriceLibs {
    static function set ($type, $relatedEntity, $datas)
    {
        return Self::__setNewPrice($type, $relatedEntity, $datas);
    }

    static function replace ($type, $relatedEntity, $datas)
    {
        if (Self::__updateOldPrice(
            $type,
            $relatedEntity,
            isset($datas['startDate']) ? $datas['startDate'] : null
            ))
            {
            return Self::__setNewPrice($type, $relatedEntity, $datas);
        };

        return ['error' => true];

    }

    static function find ($type, $relatedEntity)
    {
        return Price::where('relatedEntityType', '=', $type)
            ->where('relatedEntityId', '=', $relatedEntity)
            ->get();
    }

    static private function __setNewPrice ($type, $relatedEntity, $datas)
    {
        // $type => 0 : room, 1: products, 2:services, 3 : booking/room
        $newPrices['relatedEntityId'] = $relatedEntity;
        $newPrices['relatedEntityType'] = $type;
        $newPrices['startDate'] = isset($datas['startDate']) ? $datas['startDate'] : time();

        if ($type == 0) {
            $newPrices['amounts'] = Self::__prepareRoomPricesList($datas['amounts']);
        } else {
            $newPrices['amounts'] = Self::__prepareMainPricesList($datas['amounts']);
        }


        $price = Price::create($newPrices);

        if($new = $price->fresh()) {
            return $new;
        }

        return ['error' => true];
    }

    static private function __prepareMainPricesList ($prices)
    {
        return [
            'public' => $prices['public'],
            'member' => isset($prices['member']) ? $prices['member'] : null,
            'co' => isset($prices['co']) ? $prices['co'] : null,
        ];
    }

    static private function __prepareRoomPricesList ($prices)
    {
        return [
            'hourly' => Self::__prepareMainPricesList($prices['hourly']),
            'halfDaily' => Self::__prepareMainPricesList($prices['halfDaily']),
            'daily' => Self::__prepareMainPricesList($prices['daily'])
        ];
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
