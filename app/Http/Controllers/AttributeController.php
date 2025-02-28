<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        return response()->json(Attribute::all());
    }

    public function show($id)
    {
        return response()->json(Attribute::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:attributes',
            'type' => 'required|in:text,date,number,select',
        ]);

        $attribute = Attribute::create($request->all());
        return response()->json($attribute, 201);
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->update($request->only(['name', 'type']));
        return response()->json($attribute);
    }

    public function destroy($id)
    {
        Attribute::destroy($id);
        return response()->json(['message' => 'Attribute deleted']);
    }
}
