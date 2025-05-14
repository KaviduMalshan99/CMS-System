<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

protected $fillable = [
    'customer_name',
    'contact_number',
    'inquiry_source',
    'description',
    'assigned_to_user_id',
    'status',
];

public function assignedUser()
{
    return $this->belongsTo(User::class, 'assigned_to_user_id');
}
}
