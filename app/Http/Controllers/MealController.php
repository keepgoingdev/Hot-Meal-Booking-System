<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Meal::paginate(30);
        return view('meals.index', compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|string',
           'serving_size' => 'required|string',
           'calories' => 'integer|required',
           'store' => 'required|string',
           'image'  => 'required|image'
        ]);

        $meal = new Meal();
        foreach(Meal::$isFields as $field) {
            if($request->has($field)) {
                $request->merge([$field => true]);
            } else {
                $request->merge([$field => false]);
            }
        }
        $meal->fill($request->all());
        try {
            \Storage::disk('public')->putFileAs('img/food', $request->file('image'), time().'_'.$request->file('image')->getClientOriginalName());
            $meal->image = time().'_'.$request->file('image')->getClientOriginalName();
        } catch (\Exception $e) {
            session()->flash('message', 'There has been an error with the file upload. - ' . $e->getMessage());
            return redirect()->back()->withInput();
        }

        $meal->save();
        session()->flash('message', 'Saved!');
        return redirect('/admin/meals');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        return view('meals.edit', compact('meal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'serving_size' => 'required|string',
            'calories' => 'integer|required',
            'store' => 'required|string',
            'image'  => 'nullable|image'
        ]);

        foreach(array_merge(Meal::$isFields, ['is_enabled']) as $field) {
            if($request->has($field)) {
                $request->merge([$field => true]);
            } else {
                $request->merge([$field => false]);
            }
        }
        $meal->fill($request->all());
        
        if($request->image) {
        
            try {
                $l = \Storage::disk('public')->putFileAs('img/food', $request->file('image'), time() . '_' . $request->file('image')->getClientOriginalName());
                
                $meal->image = time() . '_' . $request->file('image')->getClientOriginalName();
                
            } catch (\Exception $e) {
                session()->flash('message', 'There has been an error with the file upload. - ' . $e->getMessage());
                return redirect()->back()->withInput();
            }
        } 
        $meal->save();
        session()->flash('message', 'Saved!');
        return redirect('/admin/meals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
