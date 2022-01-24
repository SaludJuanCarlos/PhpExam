<?php

namespace App\Http\Controllers;

use App\Models\Cdr;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CdrController extends Controller
{
    public function index(Request $request) 
    {
        //dump($request->all());
        $search = false;
        $fromDate = false;
        $toDate = false;
        $dst = false;
        $prefer = true;

        $queryDate = "CAST(calldate AS date)";
        if ($request->has('fromDate') && $request->has('toDate') && $request->input('fromDate')  != '' && $request->input('toDate') != ''){
            $fromDate = true;
            $toDate = true;
        }
         if ($request->has('search') && $request->input('search') != ''){
            $search = true;
        }
         if ($request->has('dst') && $request->input('dst') != ''){
            $dst = true;
        }

         if ($request->has('prefer') && $request->input('prefer') == 0){
            $prefer = false;
        }



        $cdr = Cdr::query()
        //->orderByRaw("RAND()")
        ->when($search, function($query)use ($request){
            $query->where('src', "{$request->input('search')}");
        })
        ->when($fromDate && $toDate, function($query)use ($request){
             $query->whereBetween('calldate', ["{$request->input('fromDate')}", "{$request->input('toDate')}"]);
        })
        ->when($dst, function($query)use ($request){
            $query->where('dst', 'like', "%{$request->input('dst')}%");
        })
        ->when($dst && $prefer, function($query)use ($request){
            $query->where('dst', '=', "{$request->input('dst')}");
        })

        ->limit(100)
        
        ->get();

        return Inertia::render('cdr/Index', [
            'cdr' => $cdr
        ]);
    }
}
