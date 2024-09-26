<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Import only once
use App\Models\Material; // Assuming you're using the Material model

class UserLearningController extends Controller
{
    public function AllUserMaterials()
    {
        // Fetch all materials and pass to the view
        $materials = Material::all();

        // Return the view with materials data
        return view('user.materials', compact('materials'));
    }
    public function FuzzyAHP()
    {
        return view('layouts.fuzzy-ahp');  // Reference with 'layouts' as the folder
    }

    public function DomainMapping()
    {
        return view('layouts.domain-mapping');  // Reference with 'layouts' as the folder
    }

    public function FuzzyLogic()
    {
        return view('layouts.fuzzy-logic');  // Reference with 'layouts' as the folder
    }
    public function CostBenefitAnalysis()
    {
        return view('layouts.cost_benefit_analysis');  // Reference with 'layouts' as the folder
    }
}