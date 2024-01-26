<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class HomePageController extends Controller
{
    function index(){
        $categoriesResponse = Http::withToken('patk4xlby0dNCs0H6.4c74dbffe964672a98d983a65b6f7e5f9e03e3f4e9a84614f92a5678c02b45f9')
            ->get('https://api.airtable.com/v0/appDOp0y8DxquxoKc/tbliZWZwdvObWTo6u');
        $categories = json_decode($categoriesResponse, true);

        $itemsResponse = Http::withToken('patk4xlby0dNCs0H6.4c74dbffe964672a98d983a65b6f7e5f9e03e3f4e9a84614f92a5678c02b45f9')
            ->get('https://api.airtable.com/v0/appDOp0y8DxquxoKc/tblxWnYRxyQaXKU12');
        $items = json_decode($itemsResponse, true);
        foreach ($items['records'] as &$item){
            $priceSlash = $item['fields']['Price_Slash'];
            $item['fields']['Price_Slash_Thousand'] = number_format($priceSlash, 0, ',', '.');
            $priceNormal = $item['fields']['Price'];
            $item['fields']['Price_Thousand'] = number_format($priceNormal, 0, ',', '.');
        };
        // dd($items);

        return view('index',compact('categories','items'));

    }
}
