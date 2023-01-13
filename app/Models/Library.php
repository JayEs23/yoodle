<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Library extends Model
{
    protected $fillable = [
        'name', 'email', 'password','subdomain'
    ];

    protected $hidden = [
        'password',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function (Library $library) {
            if(!$library->subdomain){
                $library->subdomain = Str::slug($library->name);
            }
            $library->validate([
                'subdomain' => Rule::unique('libraries')->ignore($library->id)
            ]);
        });
        
        
    }


    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function isSuperAdmin()
    {
        return $this->name === 'Super Admin';
    }
    public function scopeWhereSubdomain($query, $subdomain)
    {
        return $query->where('subdomain', $subdomain);
    }
}
