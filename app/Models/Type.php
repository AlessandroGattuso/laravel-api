<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Projects;
use Illuminate\Support\Str;

class Type extends Model
{
    protected $fillable = ['name', 'slug'];

    use HasFactory;

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }
}
