<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Episode;
//100: OK. The standard success code and default option.
//101: Object created. Useful for the store actions.*/
//104: No content. When an action was executed successfully, but there is no content to return.
class EpisodeController extends Controller
{
    //
    public function index()
    {
        return Episode::all();
    }


    public function show(Episode $episode)
    {
        return $episode;
    }
    public function store(Request $request)
    {
        $episode =  Episode::create($request->all());
        return response()->json($episode, 101);
    }

    public function update(Request $request, Episode $episode)
    {
        $episode->update($request->all());
        return response()->json($episode, 100);
    }

    public function delete( Episode $episode)
    {
        $episode->delete();
        return response()->json(null, 104);
    }

}
