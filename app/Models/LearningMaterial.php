<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LearningMaterial extends Model
{
    protected $table = 'learning_materials';

    protected $fillable = [
        'title',
        'description',
        'kategori',
        'video',
        'audio',
        'pdf',
        'learning_guide',
        'package_id',
    ];

    /**
     * Relasi ke Package (many-to-one)
     */
    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Relasi ke UserProgress (one-to-many)
     */
    public function progress(): HasMany
    {
        return $this->hasMany(UserProgress::class, 'material_id');
    }
}
