<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "institutions";
    protected $fillable = [
        'nome',
        'abrev',
        'imagem'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function pgs()
    {
        return $this->hasMany(Pg::class);
    }
}
