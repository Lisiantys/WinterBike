<?php

namespace App\Models;

use App\Models\Type;
use App\Models\User;
use App\Models\Region;
use App\Models\Comment;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Region(){
        return $this->belongsTo(Region::class);
    }

    public function Department(){
        return $this->belongsTo(Department::class);
    }

    public function Type(){
        return $this->belongsTo(Type::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favoritedByUsers(){
        return $this->belongsToMany(User::class, 'favorites', 'event_id', 'user_id');
    }
    
    protected $fillable = [
        'name', 'image_path', 'beginningDate', 'endDate', 'address',
        'email', 'phone', 'website', 'facebook', 'description', 'staffMessage',
        'department_id', 'region_id',
        'type_id', 'user_id',
    ];
}
