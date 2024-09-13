<!-- <?php

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
} -->


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class UserLearningController extends Controller
{
    public function AllUserMaterials()
    {
        // Fetch materials based on assigned ranges for each category

        // 1. Multi Criteria Decision Making (records 1-7)
        $mcdmMaterials = Material::whereBetween('id', [1, 7])->get();

        // 2. System Complexity (records 8-11)
        $systemComplexityMaterials = Material::whereBetween('id', [8, 11])->get();

        // 3. Risk Level and Mitigation Determination (records 12-15)
        $riskLevelMaterials = Material::whereBetween('id', [12, 15])->get();

        // 4. Key Performance Indicator (record 16)
        $kpiMaterials = Material::where('id', 16)->get();

        // Return the view with categorized materials
        return view('user.materials', compact('mcdmMaterials', 'systemComplexityMaterials', 'riskLevelMaterials', 'kpiMaterials'));
    }
}
