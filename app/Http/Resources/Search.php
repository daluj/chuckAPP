<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Search extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->resource['id'],
            'url'   => $this->resource['url'],
            'value' => $this->resource['value']
        ];
    }
}
