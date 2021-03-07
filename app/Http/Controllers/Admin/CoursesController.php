<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $items = Course::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $items = Course::latest()->paginate($perPage);
        }

        return view('admin.courses.index', compact('items'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $requestData = $request->all();

        Course::create($requestData);

        return redirect('admin/courses')->with('flash_message', 'New Course Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Course $cr
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Course::findOrFail($id);

        return view('admin.courses.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\course $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Course::findOrFail($id);
        return view('admin.courses.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\course $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Course::findOrFail($id);
        $item->update($request->all());
        return redirect('admin/courses')->with('flash_message', 'Course has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Course $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::destroy($id);

        return redirect('admin/courses')->with('flash_message', 'Course is deleted!');
    }
}
