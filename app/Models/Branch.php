<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bank_id',
        'address',
        'lat',
        'lng',
        'phone',
        'email',
        'api_id',
    ];

    /**
     * @param $latitude
     * @param $longitude
     * @param $bankId
     * @return Collection sorted by distance
     */
    static function getNearestBranches($latitude, $longitude, $bankId = null)
    {
        $step = 2;
        $nearestBranches = Branch::queryNearestBranches($latitude, $longitude, $bankId, $step);

        // if in radius of $step branches had not find
        while (count($nearestBranches) == 0) {
            $step += 2;
            $nearestBranches = Branch::queryNearestBranches($latitude, $longitude, $bankId, $step);
        }

        // sort by distance
        $nearestBranches = $nearestBranches->sortBy(function ($item) {
            return [$item->distance['lat'], $item->distance['lng']];
        });

        return collect($nearestBranches);
    }

    /**
     * @param $latitude
     * @param $longitude
     * @param $bankId
     * @param $step
     * @return mixed
     * Find branches between $latitude and $latitude by step
     */
    private static function queryNearestBranches($latitude, $longitude, $bankId, $step)
    {

        $query = Branch::whereBetween('lat', [$latitude - $step, $latitude + $step])
            ->whereBetween('lng', [$longitude - $step, $longitude + $step]);

        if ($bankId !== null) {
            $query->where('bank_id', $bankId);
        }

        $nearestBranches = $query->get();

        foreach ($nearestBranches as $branch) {
            $branch->distance = [
                'lat' => abs($latitude - $branch->lat),
                'lng' => abs($latitude - $branch->lng),
            ];
        }

        return $nearestBranches;
    }
}
