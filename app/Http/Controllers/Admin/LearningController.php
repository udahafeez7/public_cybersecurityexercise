<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Pretasks;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // Use the Intervention Image Facade for image handling
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;

class LearningController extends Controller
{
    // Method to get all pretasks
    public function AllPretasks()
    {
        $pretasks = Pretasks::latest()->get();
        return view('admin.backend.pretasks.all_pretasks', compact('pretasks'));
    }

    // Method to show add pretasks form
    public function AddPretasks()
    {
        return view('admin.backend.pretasks.add_pretasks');
    }

    // Method to store new pretasks
    public function StorePretasks(Request $request)
    {

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/pretasks/' . $name_gen));
            $save_url = 'upload/pretasks/' . $name_gen;

            Pretasks::create([
                'pretasks_name' => $request->pretasks_name,
                'image' => $save_url,
            ]);
        }

        $notification = array(
            'message' => 'New Pretasks Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.pretasks')->with($notification);
    }

    // Method to edit pretasks
    public function EditPretasks($id)
    {
        $pretasks = Pretasks::find($id);
        return view('admin.backend.pretasks.edit_pretasks', compact('pretasks'));
    }

    // Method to update pretasks
    public function UpdatePretasks(Request $request)
    {
        $pre_id = $request->id;

        // Validate the form data
        $request->validate([
            'pretasks_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath()); // Use the Image facade
            $img->resize(300, 300)->save(public_path('upload/pretasks/' . $name_gen));
            $save_url = 'upload/pretasks/' . $name_gen;

            // Update pretasks with new image
            Pretasks::find($pre_id)->update([
                'pretasks_name' => $request->pretasks_name,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Pretasks Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.pretasks')->with($notification);
        } else {
            // Update only the name if no image was uploaded
            Pretasks::find($pre_id)->update([
                'pretasks_name' => $request->pretasks_name,
            ]);

            $notification = array(
                'message' => 'Pretasks Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.pretasks')->with($notification);
        }
    }

    // Method to delete pretasks
    public function DeletePretasks($id)
    {
        $item = Pretasks::find($id);
        $img = $item->image;

        // Delete the image from storage
        if (file_exists(public_path($img))) {
            unlink(public_path($img));
        }

        // Delete the pretasks record
        Pretasks::find($id)->delete();

        $notification = array(
            'message' => 'Pretasks Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    // End Games Method
    // Method to get all material for learning self-paced
    public function AllMaterial()
    {
        $material = Material::latest()->get();
        return view('admin.backend.material.all_material', compact('material'));
    }

    // Method to show add pretasks form
    public function AddMaterial()
    {
        $category = Category::orderBy('id', 'asc')->get();
        $pretasks = Pretasks::orderBy('id', 'asc')->get();
        return view('admin.backend.material.add_material', compact('category', 'pretasks'));
    }

    public function StoreMaterial(Request $request)
    {

        $pcode = IdGenerator::generate(['table' => 'materials', 'field' => 'code', 'length' => 5, 'prefix' => 'MAT']); // Generate a unique code

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300, 300)->save(public_path('upload/material/' . $name_gen));
            $save_url = 'upload/material/' . $name_gen;

            Material::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'pretasks_id' => $request->pretasks_id,
                'code' => $pcode,
                'image' => $save_url,
                'admin_id' => Auth::guard('admin')->id(),
                'description' => $request->description,
                'long_description' => $request->long_description,
                'status_completed' => $request->status_completed ? true : false,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'New Material Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.material')->with($notification);
    }
    //End Games
}