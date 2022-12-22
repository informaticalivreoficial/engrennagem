<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Arquivo extends Model
{
    use HasFactory;

    protected $table = 'arquivos';

    protected $fillable = [
        'titulo', 'content', 'slug', 'arquivo', 'views', 'status', 'thumb', 'tipo'
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
            $post = Arquivo::where('titulo', $this->titulo)->first(); 
            if(!empty($post) && $post->id != $this->id){
                $this->attributes['slug'] = Str::slug($this->titulo) . '-' . $this->id;
            }else{
                $this->attributes['slug'] = Str::slug($this->titulo);
            }            
            $this->save();
        }
    }
}