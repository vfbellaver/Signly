<?php

namespace App\Models;

use App\Helper\DataViewer;
use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Model;

class BillboardFace extends Model
{
    use DataViewer;

    const TYPE_STATIC = 'Static';
    const TYPE_DIGITAL = 'Digital';

    const READS_LEFT = 'Left';
    const READS_RIGHT = 'Right';
    const READS_ACROSS = 'Across';

    const FACING_NORTH = 'North';
    const FACING_SOUTH = 'South';
    const FACING_EAST = 'East';
    const FACING_WEST = 'West';

    protected $fillable = [
        'code',
        'label',
        'facing',
        'rate_card',
        'monthly_impressions',
        'duration',
        'is_illuminated',
        'height',
        'width',
        'reads',
        'notes',
        'max_ads',
        'photo_url',
        'lights_on',
        'lights_off',
        'type',
        'billboard_id',
        'team_id',
        'slug',
    ];

    protected $casts = [
        'rate_card' => 'float',
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
