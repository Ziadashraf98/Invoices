<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('sections.sections' , compact('sections'));
    }

    public function add_section(Request $request)
    {
        $request->validate([
            'section_name'=>'required|unique:sections|min:10|max:35',
        ]);

        Section::create([
            'section_name'=>$request->section_name,
            'description'=>$request->description,
            'created_by'=>Auth::user()->name,
        ]);

        return back()->with('success' , 'Section Added Successfully');
    }

    public function update_section(Request $request , $id)
    {
        $id = $request->id;
        
        $request->validate([
            'section_name'=>'required|min:10|max:35|unique:sections,section_name,'. $id,
        ]);

        $section = Section::find($id);

        $section->update([
            'section_name'=>$request->section_name,
            'description'=>$request->description,
        ]);

        return back()->with('success' , 'Section Updated Successfully');
    }

    public function delete_section($id)
    {
        Section::find($id)->delete();
        return back()->with('success' , 'Section Deleted Successfully');
    }
}
