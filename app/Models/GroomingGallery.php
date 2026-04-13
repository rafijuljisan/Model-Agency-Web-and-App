<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroomingGallery extends Model
{
    protected $table = 'grooming_gallery';
    protected $fillable = ['title', 'image', 'category', 'batch_id', 'is_featured', 'sort_order'];

    public function batch()
    {
        return $this->belongsTo(GroomingBatch::class, 'batch_id');
    }
}