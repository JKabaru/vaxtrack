<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Models\VaccineType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Builder\Property;


class VaccineTypeController extends Controller
{
    //

    public function AllType()
    {
        $types= VaccineType::latest()->get();
        return view('backend.type.all_type',compact('types'));
    }

    public function AddType()
    {
                return view('backend.type.add_type');
    }

    public function StoreType(Request $request)
    {

        $request -> validate([
            'name' => 'required|unique:vaccine_types|max:200',
            'recommended_age' => 'required',
            'side_effects' => 'required',
            'vaccine_icon' => 'required'

       ]);

       VaccineType::insert([

        'name' => $request->name,
        'recommended_age' => $request->recommended_age,
        'vaccine_icon' => $request->vaccine_icon,
        'side_effects' => $request->side_effects,

       ]);

       $notification = array(
        'message' => 'Vaccine Created successfully',
        'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification);


    }

    public function EditType($id)
    {
        $types = VaccineType::findorFail($id);
        return view('backend.type.edit_type', compact('types'));
    }

    public function UpdateType(Request $request)
    {

        

       $pid = $request->id;



       VaccineType::findOrFail($pid)->update([

        'name' => $request->name,
        'recommended_age' => $request->recommended_age,
        'vaccine_icon' => $request->vaccine_icon,
        'side_effects' => $request->side_effects,

       ]);

       $notification = array(
        'message' => 'Edit was successfull',
        'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification);


    }

    public function DeleteType($id)
    {

        VaccineType::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
    
    }


}
