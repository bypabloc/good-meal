<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubcribirseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    
    public function checkEmail(Request $request)
    {

        return [
            'data' => [
                'exist' => false,
            ],
        ];

        $validated = $request->validate([
            // 'title' => 'required|unique:posts|max:255',
            'email' => 'required|email|max:255',
        ]);

        $true_false = [true,false];
        $random = random_int(0, 1);

        return [
            'data' => [
                'exist' => $true_false[$random],
            ],
        ];
    }
    
    public function new(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'names' => 'required|max:255',
            'number' => 'required|max:255',
            'canal_marketing' => 'required|max:255',
            'birth_date' => 'nullable|date_format:Y-m-d|before:today',
            'location' => 'max:255',
            'observation' => 'max:255',
        ]);

        $true_false = [true,false];
        $random = random_int(0, 1);

        return [
            'data' => [
                'exist' => true,
            ],
        ];
    }
}
