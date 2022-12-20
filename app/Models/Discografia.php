<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Discografia extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'titulo', 'ficha_tecnica', 'slug', 'link', 'tags', 'status', 'thumb', 
        'letras', 'views', 'apple_music', 'itunes', 'music', 'deezer', 'spotify'
    ];

    /**
     * Scopes
    */
    public function scopeAvailable($query)
    {
        return $query->where('status', 1);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('status', 0);
    }

    /**
     * Relacionamentos
    */

    /**
     * Accerssors and Mutators
    */
    public function cover()
    {       
        if(empty($this->thumb) || !Storage::disk()->exists($this->thumb)) {
            return url(asset('backend/assets/images/image.jpg'));
        }
        return Storage::url($this->thumb);
    }

    public function setSlug()
    {
        if(!empty($this->titulo)){
            $post = Discografia::where('titulo', $this->titulo)->first(); 
            if(!empty($post) && $post->id != $this->id){
                $this->attributes['slug'] = Str::slug($this->titulo) . '-' . $this->id;
            }else{
                $this->attributes['slug'] = Str::slug($this->titulo);
            }            
            $this->save();
        }
    }
}