<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

class Comment extends Model
{
    use HasFactory;

    protected $fillable=['content','articles_id'];

public function Article(){

    return $this->belongsTo(Article::class, 'articles_id');

}

public function user(){
    return $this->belongsTo(User::class);
}
}
