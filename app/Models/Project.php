<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ["type_id", "title", "image", "text"];

    // Relations


    public function teches() {
        return $this->belongsToMany(Tech::class);
    }


    public function type() {
        return $this->belongsTo(Type::class);
    }



    // ...



    public function getAbstract($max = 50) {
        return substr($this->text, 0, $max) . "...";
    }

    public static function generateSlug($title) {

        $possible_slug = Str::of($title)->slug('-');
        
        $projects = Project::where('slug', $possible_slug)->get();

        $original_slug = $possible_slug;
        $i = 2;

        while(count($projects)) {
            $original_slug = $possible_slug . "-" . $i;
            $projects = Project::where('slug', $possible_slug)->get();
            $i++;
        }

        return $possible_slug;
    }
}
