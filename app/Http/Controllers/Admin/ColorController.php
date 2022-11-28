<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{
    public function index() {
        $colors = Color::all();
        return view('admin.colors.index',compact('colors'));
    }
    public function create() {
        return view('admin.colors.create');
    }
    public function store(ColorFormRequest $request) {

        $validate = $request->validated();

        Color::create($validate);
        
        return redirect('admin/colors')->with('message', 'Added color');
    }
    
    public function edit(Color $color) {
        return view('admin.colors.edit',compact('color'));
    }
    public function update(ColorFormRequest $request, Color $color) {
        $validate = $request->validated();
        $validate['status'] = empty($validate['status'])?'0':'1';

        $color->update($validate);

        return redirect('admin/colors')->with('message', 'Updated color');
    }
    public function delete(Color $color) {
        $color->delete();

        return redirect('admin/colors')->with('message', 'Color deleted');
    }
}
