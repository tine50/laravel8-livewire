<?php

namespace App\Models;

use App\Models\Article;
use App\Models\DureeLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tarification extends Model
{
    use HasFactory;

    public function dureeLocation()
    {
        return $this->belongsTo(DureeLocation::class, 'duree_location_id', 'id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
