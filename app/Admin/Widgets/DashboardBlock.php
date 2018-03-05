<?php
namespace App\Admin\Widgets;

use AdminTemplate;
use SleepingOwl\Admin\Widgets\Widget;

use App\ApartmentType;
use App\Apartment;
use App\Building;

class DashboardBlock extends Widget
{
    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml()
    {
        $apartmentTypes = ApartmentType::all();

        $apartmentsStat = [];
        $totalAvailable = 0;
        $totalSolded = 0;
        foreach ($apartmentTypes as $apartmentType) {
            $available = 0;
            $solded = 0;
            foreach ($apartmentType->apartments as $apartment) {
                $number_apartment = 0;
                $sold_apartment = 0;
                if (!empty($apartment->number_apartment))
                    $number_apartment = count(explode(',', $apartment->number_apartment));
                if (!empty($apartment->sold_apartment))
                    $sold_apartment = count(explode(',', $apartment->sold_apartment));

                $available += $number_apartment - $sold_apartment;
                $solded += $sold_apartment;
            }
            $totalAvailable += $available;
            $totalSolded += $solded;
            $apartmentsStat[] = ['name' => $apartmentType->name, 'available' => $available, 'solded' => $solded, 'type' => 'apartment'];
        }
        $totalsStat = ['available' => $totalAvailable, 'solded' => $totalSolded];

        $buldings = Building::all();
        foreach ($buldings as $bulding) {
            $available = 0;
            $solded = 0;
            foreach ($bulding->apartments as $apartment) {
                $number_apartment = 0;
                $sold_apartment = 0;
                if (!empty($apartment->number_apartment))
                    $number_apartment = count(explode(',', $apartment->number_apartment));
                if (!empty($apartment->sold_apartment))
                    $sold_apartment = count(explode(',', $apartment->sold_apartment));

                $available += $number_apartment - $sold_apartment;
                $solded += $sold_apartment;
            }
            $apartmentsStat[] = ['name' => $bulding->name, 'available' => $available, 'solded' => $solded, 'type' => 'bulding'];
        }


        return view('admin.dashboard', [
            'apartmentsStat' => $apartmentsStat,
            'totalsStat' => $totalsStat,
        ]);
    }
    /**
     * @return string|array
     */
    public function template()
    {
        return AdminTemplate::getViewPath('dashboard');
    }
    /**
     * @return string
     */
    public function block()
    {
        return 'block.top';
    }
}