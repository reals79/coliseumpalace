<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;
use App\Slideshow;
use App\Gallery;
use App\Video;
use App\Settings;
use App\Apartment;
use App\ApartmentType;

class AppController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slideshow = Slideshow::all();
        $contents = Content::where('on_mainpage', true)->get();

        $data = compact('slideshow', 'contents');

        return view('home', $data);
    }

    public function content(Content $content)
    {
        $is_calculator = str_contains($content->descr, '%calculator%');
        
        $content->descr = str_replace('%calculator%', '', $content->descr);        
        $data = compact('content', 'is_calculator');
        
        return view('content', $data);
    }

    public function apartment(ApartmentType $apartmentType, Apartment $apartment = null)
    {
        $apartmentTypes = ApartmentType::all();
        $apartments = $apartmentType->apartments;
        if (!$apartment) {
            $apartment = $apartments->first();
        }
        if ($apartment) {
            $total_areas = explode(',', $apartment->total_area);
            $number_apartments = explode(',', $apartment->number_apartment);
            $floors = explode(',', $apartment->floor);
            $prices = explode(',', $apartment->price);
        }
        $data = compact('apartmentTypes', 'apartmentType', 'apartments', 'apartment', 'total_areas', 'number_apartments', 'floors', 'prices');
        
        return view('apartment', $data);
    }

    public function gallery(Gallery $gallery = null)
    {
        $is_gallery_list = false;

        if (!$gallery) {
            $gallery = Gallery::all();
            $is_gallery_list = true;
        }

        $data = compact('gallery', 'is_gallery_list');

        return view('gallery', $data);
    }

    public function video()
    {
        $videos = Video::all();

        $data = compact('videos');

        return view('video', $data);
    }

    public function getSettings()
    {
        $settings = Settings::all();

        return response()->json($settings);
    }

}
