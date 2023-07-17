<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\User;
use App\Models\Infant;
use App\Models\VaccineType;
use App\Models\InfantVaccine;
use Illuminate\Support\Facades\DB;



class VaccinationCompletionRatesController extends Controller
{
    public function index()
    {
        $vaccines = VaccineType::getAllVaccines();

        $completionRates = [];
        foreach ($vaccines as $vaccine) {
            $totalVaccinations = InfantVaccine::where('vaccine_id', $vaccine->id)->count();
            $completedVaccinations = InfantVaccine::where('vaccine_id', $vaccine->id)->where('completed', true)->count();
            $completionRate = $totalVaccinations > 0 ? ($completedVaccinations / $totalVaccinations) * 100 : 0;

            $completionRates[$vaccine->name] = $completionRate;
        }

        return view('reports.vaccination-completion-rates', compact('completionRates'));
    }

    public function ageBasedAnalysis()
    {
        

                            $infants = Infant::all();

                            foreach ($infants as $infant) {
                                $parent = $infant->parent;
                               
                                $vaccines = $infant->infantVaccines;
                                $completionRate = 0;
                                foreach ($vaccines as $vaccine) {
                                    $administrationDate = $vaccine->administration_date;
                                    $dosage = $vaccine->dosage;
                                    $completed = $vaccine->completed;
                                    if ($completed && $administrationDate) {
                                        $completionRate += 1;
                                    }
                                }
                                $overallCompletionRate = 0;
                        if (count($vaccines) > 0) {
                            $completionRate = 0;
                            foreach ($vaccines as $vaccine) {
                                $administrationDate = $vaccine->administration_date;
                                $dosage = $vaccine->dosage;
                                $completed = $vaccine->completed;
                                if ($completed && $administrationDate) {
                                    $completionRate += 1;
                                }
                            }
                            $overallCompletionRate = $completionRate / count($vaccines);
                        }
                                
                                $parentCompletionRates[$parent->name] = $completionRate;
                               
                            }
                            
                            $topParents = collect($parentCompletionRates)->sortByDesc('value');
                            
                            
                            $topParents = [];
                            foreach ($parentCompletionRates as $parentName => $completionRate) {
                                $parentDetails = new stdClass();
                                $parentDetails->name = $parentName;
                                $parentDetails->number_of_infants = count($parent->infants);
                            
                                $parentDetails->total_vaccines = count((array) $parent->infantVaccines);
                                $parentDetails->average_completion_rate = $completionRate;
                                $topParents[] = $parentDetails;
                            }

                           


                        

                                
    
        return view('reports.age_based_analysis', compact('parentCompletionRates' ,  'topParents' ));
    }
    
    
    
    

    public function completionRateByAge()
{
   
    $ageGroups = Infant::select('age')->distinct()->orderBy('age')->pluck('age');

    $completionRates = [];
    
    foreach ($ageGroups as $ageGroup) {
        $completedVaccines = InfantVaccine::whereHas('vaccine', function ($query) use ($ageGroup) {
            $query->where('age_range_id', $ageGroup);
        })->where('completed', true)->count();
    
        $pendingVaccines = InfantVaccine::whereHas('vaccine', function ($query) use ($ageGroup) {
            $query->where('age_range_id', $ageGroup);
        })->where('completed', false)->count();
    
        $totalVaccines = $completedVaccines + $pendingVaccines;
    
        $completionRate = $totalVaccines > 0 ? (($completedVaccines / $totalVaccines) * 100) : 0;
        $completionRate = round($completionRate, 2); // Calculate completion rate percentage
    
        $completionRates[$ageGroup] = $completionRate;
    }
    

    
   
    return view('reports.completion-rate-by-age', compact('completionRates'));
}


public function parentAndDoctorAnalysis()
{
        $infants = Infant::all();

        foreach ($infants as $infant) {
            $parent = $infant->parent;
           
            $vaccines = $infant->infantVaccines;
            $completionRate = 0;
            foreach ($vaccines as $vaccine) {
                $administrationDate = $vaccine->administration_date;
                $dosage = $vaccine->dosage;
                $completed = $vaccine->completed;
                if ($completed && $administrationDate) {
                    $completionRate += 1;
                }
            }
            $overallCompletionRate = 0;
    if (count($vaccines) > 0) {
        $completionRate = 0;
        foreach ($vaccines as $vaccine) {
            $administrationDate = $vaccine->administration_date;
            $dosage = $vaccine->dosage;
            $completed = $vaccine->completed;
            if ($completed && $administrationDate) {
                $completionRate += 1;
            }
        }
        $overallCompletionRate = $completionRate / count($vaccines);
    }
            
    if ($parent !== null) {
        $parentCompletionRates[$parent->name] = $completionRate;
    }
    
            
        }
        
        $topParents = collect($parentCompletionRates)->sortByDesc('value');
       
        if ($parent !== null) {
        $topParents = [];
        foreach ($parentCompletionRates as $parentName => $completionRate) {
            $parentDetails = new stdClass();
            $parentDetails->name = $parentName;
           
            
                $parentDetails->number_of_infants = count($parent->infants);
            
           
            $parentDetails->total_vaccines = count((array) $parent->infantVaccines);
            $parentDetails->average_completion_rate = $completionRate;
            $topParents[] = $parentDetails;
        }
    }

        



        return view('reports.parent-doctor-analysis', compact('parentCompletionRates',  'topParents' ));
}



    
}
