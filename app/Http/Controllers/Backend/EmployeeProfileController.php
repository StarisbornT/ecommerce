<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Trait\ImageUploadTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\DataTables\EmployeeDataTable;

class EmployeeProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(EmployeeDataTable $dataTable)
    {
        return $dataTable->render('admin.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'username' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'role' => ['required'],
            'password' => ['required'],
            'status' => ['required']
        ]);


        $imagePath = $this->uploadImage($request, 'image', 'uploads');
        $profile = new User();
        $profile->image = $imagePath;
        $profile->name = $request->name;
        $profile->username = $request->username;
        $profile->phone = $request->phone;
        $profile->email = $request->email;
        $profile->employee_role = $request->role;
        $profile->password = Hash::make($request->password);
        $profile->status = $request->status;
        $profile->save();

        toastr('Created Successfully', 'success');
        return redirect()->route('admin.employee.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile = User::findOrFail($id);
        return view('admin.employee.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profile = User::findOrFail($id);
        return view('admin.employee.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'username' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'role' => ['required'],
            'status' => ['required']
        ]);


        $profile = User::findOrFail($id);
        $imagePath = $this->updateImage($request, 'image', 'uploads', $profile->image);
        $profile->image = empty(!$imagePath) ? $imagePath : $profile->image;
        $profile->name = $request->name;
        $profile->username = $request->username;
        $profile->phone = $request->phone;
        $profile->email = $request->email;
        $profile->employee_role = $request->role;
        $profile->status = $request->status;
        $profile->save();

        toastr('Updated Successfully', 'success');
        return redirect()->route('admin.employee.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = User::findOrFail($id);
        $this->deleteImage($profile->banner);
        $profile->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }
}