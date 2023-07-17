<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Infant;
use App\Models\VaccineType;
use App\Models\InfantVaccine;
use Illuminate\Http\Request;
use App\Models\AgeRange;
use App\Models\Country;


use Carbon\Carbon;

use App\Notifications\InfantAssignedNotification;
use App\Notifications\VaccineAdministeredNotification;

class InfantController extends Controller
{
    public function AllInfants()
    {
        

        $infants= Infant::all();

        



        return view('infants.all_infants', compact('infants'));
    }

    public function AddInfant()
    {
        return view('infants.add_infant');
    }

    public function StoreInfant(Request $request)
    {



 


        
        $infant = Infant::create([
            'last_name' => $request->last_name,
            'other_name' => $request->other_name,
            'gender' => $request->gender,
            'age' => $request->age_group,           
            'parent_id' => $request->parent_id,
            'parent_phone' =>  $request->parent_phone,
            'parent_email' =>  $request->parent_email,

        ]);

        $parent_id = $request->parent_id;

        if (!empty($parent_id)) {
            $parent = User::findOrFail($parent_id);
            $parent->phone_number = $request->parent_phone;
            $parent->email = $request->parent_email;
            $parent->save();
        }
    
        
        

        $notification = array(
            'message' => 'Infant  created successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->route('all.infants')->with($notification);
    
    }


    public function EditInfant($id)
    {

        $infant = Infant::findorfail($id);

        


        $vaccines = VaccineType::all();
        $age_range = AgeRange::all();
        $infantvaccines = InfantVaccine::all();
        
         
        

        return view('infants.edit_infant',compact('infant',  'vaccines' ,'age_range' ,'infantvaccines'));
    }

    public function UpdateInfant(Request $request)
    {
        $infant_id= $request->id;

        $infant = Infant::findorfail($infant_id)->update([
            'last_name' => $request->last_name,
            'other_name' => $request->other_name,
            'gender'=> $request->gender,
            'age'=> $request->age_group,
            'parent_phone' =>  $request->parent_phone,
            'parent_email' =>  $request->parent_email,

            'parent_id'=> $request->parent_id,
            
        ]);

        $parent_id = $request->parent_id;

            if (!empty($parent_id)) {
                $parent = User::findOrFail($parent_id);
                $parent->phone_number = $request->parent_phone;
                $parent->email = $request->parent_email;
                $parent->save();
            }



        
        

        $notification = array(
            'message' => 'Infant Updated successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->route('all.infants')->with($notification);
    
    }


    // Vaccine_scheduler

    public function getVaccineSchedule()
    {
        $infants = Infant::all();
        $vaccines = VaccineType::all();
        $infantvaccines = InfantVaccine::all();
        $AgeRangesFromController = AgeRange::all();
        $countries = Country::all();
        $filteredVaccine = VaccineType::all();;

    //     $age = 3; // Replace with the actual age value you want to consider

    //         $agerangesToconsider = $AgeRangesFromController->filter(function ($ageRange) use ($age) {
    //             return ($ageRange->StartAge <= $age && $ageRange->EndAge >= $age) || $ageRange->StartAge > $age ;
    //         })->pluck('id')->toArray();
                    
    //         $recommendedVaccines = $vaccines->whereIn('age_range_id', $agerangesToconsider)->pluck('id')->toArray();

    //  dd($agerangesToconsider,  $recommendedVaccines);

    return view('infants.infants_remaining_vaccines', compact('countries','infants', 'vaccines', 'infantvaccines', 'AgeRangesFromController' , 'filteredVaccine'));

        
    }

    public function schedule(int $infantId)
    {
        $countries = Country::all();
        
                $infants = Infant::findOrFail($infantId);
                $vaccines = VaccineType::all();
                $AgeRangesFromController = AgeRange::all();
                $birthdate = \Carbon\Carbon::createFromDate($infants->age); // Replace with the actual birthdate
                                        $currentDate = \Carbon\Carbon::today();

                                        $age = $currentDate->diffInMonths($birthdate);

                                        $agerangesToconsider = $AgeRangesFromController->filter(function ($ageRange) use ($age) {
                                                         return ($ageRange->StartAge <= $age && $ageRange->EndAge >= $age) || $ageRange->StartAge > $age ;
                                                    })->pluck('id')->toArray();
                                                    $recommendedVaccines = $vaccines->whereIn('age_range_id', $agerangesToconsider);    
                                            //         $recommendedVaccines = $vaccines->whereIn('age_range_id', $agerangesToconsider)->pluck('id')->toArray();
                
                // Check if there is existing data for the infant
                $existingVaccines = InfantVaccine::where('infant_id', $infants->id)->pluck('vaccine_id')->toArray();
               
                // Save the infant-vaccine relationship for new vaccines
                $newVaccines = [];
                foreach ($recommendedVaccines as $vaccine) {
                    if (!in_array($vaccine->id, $existingVaccines)) {
                        $newVaccines[] = [
                            'infant_id' => $infants->id,
                            'vaccine_id' => $vaccine->id,
                            
                        ];
                    }
                }
                
                // Save the new infant-vaccine relationships
                InfantVaccine::insert($newVaccines);

                

                // Redirect or show a success message
                $notification = array(
                    'message' => 'Infant scheduled successfully',
                    'alert-type' => 'success'
                );

                $infants = Infant::with('parent')->get();
            $vaccines = VaccineType::all();
            $infantvaccines = InfantVaccine::all();
               
                $infantvaccines = InfantVaccine::all();
                $filteredVaccine = VaccineType::all();;
                $selectedCountry = Country::all();;

                return view('infants.infant_vaccinations', compact('countries', 'filteredVaccine', 'selectedCountry', 'infants', 'vaccines', 'infantvaccines'))->with($notification);;
                


    }





            public function infantVaccinations(Request $request)
        {
            
           
           
                
            $selectedCountry = Country::all();;
    
            // Retrieve the filtered data based on the selected country
            
            $countries = Country::all();
            // Filter the data based on the selected country ID
            $filteredVaccine = VaccineType::all();;
            
            // Retrieve the infants with their associated data
            $infants = Infant::all();
            $infantvaccines = InfantVaccine::all();
            $vaccines = VaccineType::all();
            
            return view('infants.infant_vaccinations', compact('countries', 'filteredVaccine', 'selectedCountry', 'infants', 'infantvaccines', 'vaccines'));
            
                
            

            
        }

        // Edit  schedule set completed

        public function editInfantVaccinations($id)
    {

        $infants = Infant::findorfail($id);
        $vaccines = VaccineType::all();
        $infantvaccines = InfantVaccine::all();
        return view('infants.edit_infant_vaccination',compact('infants',  'vaccines', 'infantvaccines'));
    }


    public function updateInfantVaccine(Request $request)
    {
        $inva_id = $request->id;
    
        $vaccine = InfantVaccine::find($inva_id);
        $vaccine->update([
            'completed' => $request->has('completed_field'),
            'administration_date' => $request->administration_date,
            'next_due_date' => $request->next_due_date,
        ]);
       
       
      
        $infant = $vaccine->infant;
        

        $users = User::whereIn('role', ['parent', 'admin'])->get();

        foreach ($users as $user) {
            if ($user->role === 'parent' || $user->role === 'admin') {
                if ($vaccine->completed) {
                    // Send notification to parent or admin only when completed is true
                    $user->notify(new VaccineAdministeredNotification($infant, $vaccine, $user));
                }
            }
            }

    
        $notification = [
            'message' => 'Completed successfully',
            'alert-type' => 'success',
        ];
    
        return redirect()->back()->with($notification);
    }

    
    public function InfantFilterByAgeallinfants(Request $request)
    {
        $filterAge = $request->input('filter_age');
        $filterGender = $request->input('filter_gender');
    
        $query = Infant::query();
    
        if ($filterAge) {
            $query->where('age', $filterAge);
        }
    
        if ($filterGender) {
            $query->where('gender', $filterGender);
        }
    
        $infants = $query->latest()->get();
    
       
        return view('infants.all_infants', compact('infants'));
    }
    


    //  for flter country 
    public function FilterInfantVaccinations(Request $request)
{
    $selectedCountry = $request->input('country_id');
    
    // Retrieve the filtered data based on the selected country
    
    $countries = Country::all();
    // Filter the data based on the selected country ID
    $filteredVaccine = VaccineType::where('country_id', $selectedCountry)->get();
    
    // Retrieve the infants with their associated data
    $infants = Infant::all();
    $infantvaccines = InfantVaccine::all();
    $vaccines = VaccineType::all();
    $AgeRangesFromController = AgeRange::all();
    
    return view('infants.infants_remaining_vaccines', compact('countries', 'filteredVaccine', 'selectedCountry', 'infants', 'infantvaccines', 'vaccines' , 'AgeRangesFromController'));
}





public function DeletePermission($id)
    {
        Infant::findorfail($id)->delete();

        $notification = array(
            'message' => 'Infant Deleted successfully',
            'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
    

    }


    public function bulkUpdateInfantVaccinations(Request $request)
{
    $selectedVaccineIds = $request->input('selected_vaccines');
    $nextDueDate = $request->input('next_due_date');

    // Find the InfantVaccine records by the selected IDs and update the next due date
    InfantVaccine::whereIn('id', $selectedVaccineIds)->update(['next_due_date' => $nextDueDate]);

    // Redirect back or perform any other desired action
    $notification = array(
        'message' => 'Next due dates updated successfully.',
        'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    
}





}

