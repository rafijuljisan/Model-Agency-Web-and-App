<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroomingApplication extends Model
{
    protected $fillable = [
        'application_number',
        'batch_id',
        'full_name',
        'phone',
        'whatsapp',
        'email',
        'age',
        'gender',
        'height',
        'weight',
        'address',
        'career_interests',
        'experience_level',
        'payment_method',
        'transaction_id',
        'payment_screenshot',
        'status',
        'payment_status',
        'admin_note',
        'sender_number',
    ];

    protected $casts = [
        'career_interests' => 'array',
    ];

    public function batch()
    {
        return $this->belongsTo(GroomingBatch::class, 'batch_id');
    }
}
