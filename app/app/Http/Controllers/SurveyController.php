<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;

class SurveyController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'animal' => 'required|array',
            'message' => 'nullable|string',
        ]);

        $survey = Survey::create([
            'name' => $validatedData['name'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'favorite_color' => $validatedData['color'],
            'favorite_animals' => $validatedData['animal'],
            'message' => $validatedData['message'],
        ]);

        return redirect()->back()->with('success', 'Formulário enviado com sucesso!');
    }
}
