<?php

namespace App\Models;

use App\Helper\DataViewer;
use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Model;

class BillboardFace extends Model
{
    use DataViewer;

    const READS = ['Left' => 'Left', 'Right' => 'Right', 'Across' => 'Across'];
    const TYPE = ['Static' => 'Static', 'Digital' => 'Digital'];

    protected $fillable = [
        'code',
        'label',
        'hard_cost',
        'monthly_impressions',
        'duration',
        'is_illuminated',
        'height',
        'width',
        'reads',
        'notes',
        'max_ads',
        'photo',
        'lights_on',
        'lights_off',
        'type',
        'billboard_id',
        'team_id',
    ];

    protected $casts = [
        'hard_cost' => 'float',
        'max_ads' => 'int',
        'duration' => 'int',
        'team_id' => 'int',
        'is_illuminated' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        if (auth()->check()) {
            static::addGlobalScope(new TeamScope(auth()->user()->team));
        }
    }

    public function billboard()
    {
        return $this->belongsTo(Billboard::class);
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'billboard_name' => $this->billboard->name
        ]);
    }

}
