<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    //
    public function index(){
        // return 'index';
        Session::put('page', 'index');
        $data['page_name'] = 'الرئيسية';
        $data['page_about'] = 'من-نحن';
        $data['page_contact'] = 'اتصل-بنا';
        $data['page_news'] = 'كل-الاخبار';
        $data['page_posts'] = 'كل-المقالات';
        // $data['webDetails'] = Setting::first();
        // $data['meta_keywords'] = $data['webDetails']['meta_keywords'];
        // $data['meta_description'] = $data['webDetails']['meta_description'];
        //For Status online Or Offline//
        // if ($data['webDetails']->status ==  'OffLine') {
        //     return view('website.comingsoon', $data);
        // }
        // end all page
        // end only home page
        $data['countries'] = Country::select('*')->active()->get();
        return view('website.index', $data);
    }

    public function cooked(){
        // cooker detail and menu
    }

    public function detail($id){
        // food detail 
        // return $id;
        Session::put('page', 'detail');
        $data['page_name'] = 'تفاصيل';
        $data['detail'] = Menu::where('id', $id)->with('country')->with('state')->with('section')->with('category')->with('food')->with('qtype')->with('cooker')->first();
        return view('website.detail', $data);
    }

    public function getStates(Request $request)
    {
        $states = DB::table('states')
            ->where('country_id', $request->country)
            ->get();

        if (count($states) > 0) {
            return response()->json($states);
        }
    }
    public function getCities(Request $request)
    {
        $cities = DB::table('cities')
            ->where('state_id', $request->state)
            ->get();
        if (count($cities) > 0) {
            return response()->json($cities);
        }
    }

    public function search(Request $request)
    {
        // return $request->all();
        Session::put('page', 'البحث');
        $data['page_name'] = 'البحث';
        $data['countries'] = Country::select('*')->active()->get();
        if (isset($_REQUEST['search']) && !empty($_REQUEST['search'])) {
            $search = $_REQUEST['search'];
            $country = $_REQUEST['country'];
            $state = $_REQUEST['state'];
            $foods = Menu::orderBy('id', 'Asc')
            ->with('country')
            ->with('state')
            ->with('section')
            ->with('food')
            ->with('qtype')
            ->with('cooker')
            ->where('description', 'like', '%' . $search . '%')
                ->orWhere('meta_keywords', 'like', '%' . $search . '%')
                ->orWhere('meta_description', 'like', '%' . $search . '%')
                ->where('country_id', $country)
                ->where('state_id', $state)
                ->where('status', 1)
                ->paginate(12);
            // if(count($foods) > 0){
            //     return count($foods);
            // }else{return 'no';}
            $data['foods'] = $foods;
        }

        return view('website.search', $data);
    }
}
