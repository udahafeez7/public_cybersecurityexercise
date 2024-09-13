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
}