<?php

namespace App\Http\Controllers;

use App\AdmitCard;
use Illuminate\Http\Request;

class AdmitCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $admitCards = AdmitCard::all();
        return view('admin.admit_card.index',compact('admitCards'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(AdmitCard $admitCard)
    {
        //
    }

    public function edit(AdmitCard $admitCard)
    {
        //
    }

    public function update(Request $request, AdmitCard $admitCard)
    {
        //
    }

    public function destroy(AdmitCard $admitCard)
    {
        //
    }
}
