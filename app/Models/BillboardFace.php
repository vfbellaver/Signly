<?php

namespace App\Models;

use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BillboardFace extends Model
{
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

    public function scopeDatatable(Builder $query, $data)
    {
        $limit = $data['limit'];
        $offset = $data['offset'];
        $sort = $data['sort'];
        $order = $data['order'];

        $total = $query->count();

        $query = $query->limit($limit)->offset($offset);

        if ($sort) {
            $query = $query->orderBy($sort, $order);
        }

        return [
            'rows' => $query->get(),
            'total' => $total
        ];
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'billboard_name' => $this->billboard->name
        ]);
    }

}
