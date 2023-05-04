<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    public function User(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name', 'image_path', 'beginningDate', 'endDate', 'address',
        'email', 'phone', 'website', 'facebook', 'description',
        'department_id', 'region_id',
        'type_id', 'user_id',
    ];
}
