<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class preparation_checklist extends Model
{
    protected $table = 'preparation_checklist';
    protected $guarded = [];

    public function checklist()
    {
        return $this->belongsTo(checklist::class, 'checklist_id', 'id'); // foreign key
    }
}
