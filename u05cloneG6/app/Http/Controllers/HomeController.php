<?php

namespace App\Http\Controllers;

use App\Models\Admin\cmdb_reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::id())
        {
            $usertype = Auth()->user()->role;
            $allReviews = cmdb_reviews::with('userReviewsRelationship', 'movieReviewsRelationship')->get();

            if($usertype == '0')
            {
                return view('layouts.show', compact('allReviews'));
            }

            else if($usertype == '1')
            {
                return view('dashboard');
            }

            else {
                return redirect()->back();
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
