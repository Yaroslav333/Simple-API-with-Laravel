<?php
/**
 * Created by PhpStorm.
 * User: yaroslav
 * Date: 21.06.18
 * Time: 19:33
 */

namespace App\Traits;


trait Orderable
{

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeOldestFirst($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

}