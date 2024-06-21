<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class FilterService
{
    private $request;
    private $query;

    public function __construct($request , $query)
    {
        $this->request = $request;
        $this->query = $query;
    }

    public function search(Request $request)
    {
        $keys = Redis::keys('*');
        $matchingKeys = [];
        foreach ($keys as $key) {
            $strippedKey = str_replace('redis_', '', $key);
            $value = Redis::get($strippedKey);
            if (strpos($value, $request->search) !== false) {
                $matchingKeys[] = $strippedKey;
            }
        }
        $matchingLinks = Link::whereIn('short_url', $matchingKeys)->pluck('id');
         $this->query->whereIn('id', $matchingLinks);
    }

}
