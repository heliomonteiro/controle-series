<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];
    //protected $with = ['temporadas']; // Para trazer o relacionamento com temporadas sempre que der um get() no model

    public function temporadas()
    {
        return $this->hasMany(Season::class, 'series_id');
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function(Builder $queryBuilder){
            $queryBuilder->orderBy('nome','asc');
        });
    }

    /*
    public function scopeActive(Builder $query)
    {
        return $query->where('id','>', 5);
    }
    */

}
