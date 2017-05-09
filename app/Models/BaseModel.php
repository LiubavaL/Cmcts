<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BaseModel extends Model{

    /**
     * Insert each item as a row. Does not generate events.
     *
     * @param  array  $items
     *
     * @return bool
     */
    public function insertAll(array $items)
    {
        $now = Carbon::now();
        $items = collect($items)->map(function (array $data) use ($now) {
            return array_merge([
                'created_at' => $now,
                'updated_at' => $now,
            ], $data);
        })->all();

        return \DB::table($this->getTable())->insert($items);
    }
}