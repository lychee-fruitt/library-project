<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.addingcategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Category::create([
            'category_name' => $request->input('category_name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.categorymanagement')->with('success', 'Category created successfully.');
    }
    public function show()
    {
        $categories = Category::all();

        return view('admin.categorymanagement', compact('categories'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->books()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete the category because it is linked to books.');
        }
        $category->delete();
        return redirect()->route('admin.categorymanagement')->with('success', 'Category deleted successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.editcategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:accounts,email,' . $id,
            'phone' => 'required|string|max:15',
            'password' => 'nullable|min:8|confirmed',
            'old_password' => 'nullable|string', 
        ]);

        $user = Account::findOrFail($id);


        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->password) {

            if (Hash::check($request->old_password, $user->password)) {

                $user->password = Hash::make($request->password);
            } else {
                return back()->withErrors(['old_password' => 'The old password is incorrect.']);
            }
        }

        $user->save();

        return redirect()->route('admin.membermanagement')->with('success', 'Member updated successfully!');
    }

}
