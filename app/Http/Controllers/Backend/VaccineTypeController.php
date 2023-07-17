<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Models\VaccineType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Builder\Property;
use App\Notifications\NewVaccineNotification;

use App\Models\Country;
use App\Models\AgeRange;

use App\Models\User;



class VaccineTypeController extends Controller
{
    //

    public function AllType()
    {
        $types= VaccineType::latest()->get();
        $notifications = Auth::user()->notifications;
        $notificationCount = $notifications->count();
        $countries = Country::all();
        $ageranges = AgeRange::all();
        return view('backend.type.all_type',compact('types' , 'notifications', 'notificationCount','countries','ageranges'));
    }

    public function AddType()
    {
        $notifications = Auth::user()->notifications;
        $notificationCount = $notifications->count();
        $countries = Country::all();
        $ageranges = AgeRange::all();
                return view('backend.type.add_type' ,compact('notifications', 'notificationCount' ,'countries','ageranges'));
    }
    
    public function StoreType(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:vaccines|max:200',
            'dose_number' => 'required|max:10',
            'recommended_age' => 'required',
            'side_effects' => 'required',
           
            
        ]);
    
        $vaccine = VaccineType::create([
            'name' => $request->name,
            'dose_number' => $request->dose_number,
            'age_range_id' => $request->recommended_age,
            'side_effects' => $request->side_effects,
            'description' => $request->description,
            'country_id' => $request->country,
            'storage_requirements' => $request->storage_requirements,
        ]);
    
        $doctors = User::where('role', 'doctor')->get();
        
        foreach ($doctors as $doctor) {
            $doctor->notify(new NewVaccineNotification($vaccine));
        }
    

        $notification = [
            'message' => 'Vaccine Created successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->route('all.type')->with($notification);
    }
    
    

    public function EditType($id)
    {
        $types = VaccineType::findorFail($id);
        $countries = Country::all();
        $ageranges = AgeRange::all();
        return view('backend.type.edit_type', compact('types','countries','ageranges'));
    }

    public function UpdateType(Request $request)
    {

        

       $pid = $request->id;



       VaccineType::findOrFail($pid)->update([

           'name' => $request->name,
            'dose_number' => $request->dose_number,
            'age_range_id' => $request->recommended_age,
            'side_effects' => $request->side_effects,
            'description' => $request->description,
            'country_id' => $request->country,
            'storage_requirements' => $request->storage_requirements,
        

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
