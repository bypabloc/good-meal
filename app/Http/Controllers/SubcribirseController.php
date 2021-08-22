<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcription;

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
    
    public function list(Request $request)
    {
        $subcriptions = Subcription::paginate(15);

        return [
            'data' => [
                'list' => $subcriptions,
            ],
        ];
    }
    
    public function checkEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $exists = Subcription::ExistsEmail($request->email);

        return [
            'data' => [
                'exist' => $exists,
            ],
        ];
    }
    
    public function new(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:subcriptions|email|max:255',
            'names' => 'required|max:255',
            'number' => 'required|max:255',
            'canal_marketing' => 'required|max:255',
            'birth_date' => 'nullable|date_format:Y-m-d|before:today',
            'location' => 'max:255',
            'observation' => 'max:255',
        ]);

        $subcription = new Subcription;

        $subcription->email = $request->email;
        $subcription->names = $request->names;
        $subcription->number = $request->number;
        $subcription->canal_marketing = $request->canal_marketing;
        $subcription->birth_date = $request->birth_date;
        $subcription->location = $request->location;
        $subcription->observation = $request->observation;

        $subcription->save();

        $true_false = [true,false];
        $random = random_int(0, 1);

        return [
            'data' => [
                'exist' => true,
            ],
        ];
    }
}
