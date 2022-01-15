<?php

namespace App\Models;

use App\Models\Article;
use App\Models\TypeArticle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProprieteArticle extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo(TypeArticle::class, 'type_article_id', 'id');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_propriete', 'propriete_article_id', 'article_id');
    }
}
