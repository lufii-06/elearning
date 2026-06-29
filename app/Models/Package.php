<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'price',
        'is_free',
        'kategori',
        'thumbnail',
        'sort_order',
    ];

    protected $casts = [
        'is_free'    => 'boolean',
        'price'      => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Relasi ke LearningMaterial (one-to-many)
     */
    public function materials(): HasMany
    {
        return $this->hasMany(LearningMaterial::class);
    }

    /**
     * Accessor: harga terformat (Rp 50.000)
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Accessor: label gratis/tidak
     */
    public function getIsFreeLabelAttribute(): string
    {
        return $this->is_free ? 'Ya' : 'Tidak';
    }

    /**
     * Accessor: URL thumbnail lengkap
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return null;
    }
}
