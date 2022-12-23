<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'titulo', 'content', 'url', 'link', 'endereco', 'status', 'thumb', 'cliques', 'data', 'time'
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

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = (!empty($value) ? $this->convertStringToDate($value) : null);
    }

    // public function getDataAttribute($value)
    // {
    //     if (empty($value)) {
    //         return null;
    //     }
    //     return date('d/m/Y', strtotime($value));
    // }
    
    public function setUrl()
    {
        if(!empty($this->titulo)){
            $post = Agenda::where('titulo', $this->titulo)->first(); 
            if(!empty($post) && $post->id != $this->id){
                $this->attributes['url'] = Str::slug($this->titulo) . '-' . $this->id;
            }else{
                $this->attributes['url'] = Str::slug($this->titulo);
            }            
            $this->save();
        }
    }

    private function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return null;
        }
        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }
}
