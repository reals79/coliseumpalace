<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

use App\Content;
use App\ContentMain;
use App\ContentAbout;
use App\ContentSimple;
use App\Slideshow;
use App\Gallery;
use App\Video;
use App\Settings;
use App\Apartment;
use App\ApartmentType;
use App\Building;
use App\CommercialArea;
use App\News;

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
        $descriptionsMain = ContentSimple::where('content_id', -5)->first();

        $data = compact('slideshow', 'contents', 'contentsMain', 'descriptionsMain');

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
        $apartmentTypes = View::make('_partials.apartment_types')->render();

        $content = ContentAbout::where(['content_id' => -4])->first();
        $contentsMain = ContentMain::where('content_id', -2)->get();
        $data = compact('content', 'contentsMain', 'apartmentTypes');
        
        return view('content', $data);
    }

    public function apartment(ApartmentType $apartmentType, $building_id = 0, Apartment $apartment = null)
    {
        $buildings = Building::all();
        if ($building_id) {
            $apartments = $apartmentType->apartments()->where('building_id', $building_id)->get();
        } else {
            $apartments = $apartmentType->apartments;
        }

        if (!$apartment) {
            $apartment = $apartments->first();
        }
        if ($apartment) {
            $total_areas = explode(',', $apartment->total_area);
            $number_apartments = explode(',', $apartment->number_apartment);
            $floors = explode(',', $apartment->floor);
            $prices = explode(',', $apartment->price);
            $sold_apartments = explode(',', $apartment->sold_apartment);
        }
        $data = compact('apartmentType', 'building_id', 'buildings', 'apartments', 'apartment', 'total_areas', 'number_apartments', 'floors', 'prices', 'sold_apartments');
        
        return view('apartment', $data);
    }

    public function commercial($building_id = 0, CommercialArea $commercial_area = null)
    {
        $content = ContentSimple::where('content_id', -6)->first();

        $buildings = Building::all();
        if ($building_id) {
            $commercials = CommercialArea::where('building_id', $building_id)->get();
        } else {
            $commercials = CommercialArea::all();
        }

        if (!$commercial_area) {
            $commercial_area = $commercials->first();
        }

        $data = compact('content', 'building_id', 'buildings', 'commercials', 'commercial_area');
        
        return view('commercial-area', $data);
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

    public function news(Request $request, News $news = null)
    {
        $is_news_list = false;

        if (!$news) {
            $news = News::all();
            $is_news_list = true;
        }
        $data = compact('news', 'is_news_list');

        return view('news', $data);
    }

}
