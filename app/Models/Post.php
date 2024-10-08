<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //protected $table = 'post';
    use HasFactory;
    protected $guarded = [];
    protected $with = ['category', 'author'];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');  // 'user_id' é a chave estrangeira
    }
    //comentario associado ao post
    public function comments()
    {
        return $this->hasMany(Comment::class);  
    }

    public function scopeFilter($query, array $filters){
        //post::newQuery()->filter
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) => //pra retornar só um post que tenha as verificacoes (title or body e slug)
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%') //se bater cm a busca
            )
        );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn ($query) =>
                $query->where('slug', $category) //achar posta associado a uma categoria
            )
        );

        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author', fn($query) =>
                $query->where('username', $author)
    )
);

        
    }
}
//http://172.18.0.1:8088/index.php?route=/database/structure&db=blog