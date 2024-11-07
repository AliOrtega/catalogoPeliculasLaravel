<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller {
    public function index() {
        return Movie::all();
    }

    public function show($id) {
        return Movie::find($id);
    }

    public function store(Request $request) {
        return Movie::create($request->all());
    }

    public function update(Request $request, $id) {
        $movie = Movie::find($id);
        $movie->update($request->all());
        return $movie;
    }

    public function destroy($id) {
        Movie::destroy($id);
    }
}