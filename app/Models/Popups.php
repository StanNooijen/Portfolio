<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popups extends Model
{
    protected $table = 'popups_table';
    public function details()
    {
        return $this->hasMany(Popups_details::class, 'popup_id', 'id');
    }
}
