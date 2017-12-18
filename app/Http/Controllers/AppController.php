<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

use App\Content;
use App\ContentMain;
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
        $contentsMain = ContentMain::where('content_id', -2)->get();

        $data = compact('slideshow', 'contents', 'contentsMain');

        return view('home', $data);
    }

    public function content(Content $content)
    {
        $apartmentTypes = View::make('_partials.apartment_types')->render();

        $is_calculator = str_contains($content->descr, '%calculator%');
        
        $content->descr = preg_replace('/%apartments%/', $apartmentTypes, $content->descr);
        $content->descr = preg_replace('/%(calculator|apartments)%/', '', $content->descr);
        $data = compact('content', 'is_calculator');
        
        return view('content', $data);
    }

    public function about(Request $request)
    {
        $content = Content::where(['content_id' => -4])->first();
        $contentsMain = ContentMain::where('content_id', -2)->get();
        $data = compact('content', 'contentsMain');
        
        return view('content', $data);
    }

    public function apartment(ApartmentType $apartmentType, Apartment $apartment = null)
    {
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
        $data = compact('apartmentType', 'apartments', 'apartment', 'total_areas', 'number_apartments', 'floors', 'prices');
        
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
