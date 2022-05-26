<?php

namespace App\Http\Controllers;

use App\Helpers\BetStatsHelper;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        return view('dashboard.index', [
            'all' => BetStatsHelper::getStats(null),
            'football' => BetStatsHelper::getStats('football'),
            'basketball' => BetStatsHelper::getStats('basketball'),
            'tennis' => BetStatsHelper::getStats('tennis'),
            'esport' => BetStatsHelper::getStats('esport'),
        ]);
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate(
            [
                'profile-picture' => 'required|max:2048',
            ],
            [
                'profile-picture.required' => 'Please provide picture',
            ]
        );

        if ($request->hasFile('profile-picture')) {
            $picturePath = $request->file('profile-picture')->store('profile-pictures', 'public');
            $user = auth()->user();
            $user->profile_picture = $picturePath;
            $user->save();
        }
        return back();
    }

    public function updateName(Request $request) 
    {
        $status = 0;
        if ($name = $request->json('name')) {
            if (User::where('name', $name)->exists()) {
                $status = 2;
            } else {
                $user = auth()->user();
                $user->name = $name;
                $user->save();
                $status = 1;
            }
        } 

        return response()->json([
            'status' => $status
        ]);
    }

    public function updatePassword(Request $request) 
    {

    }

    public function delete()
    {
        auth()->user()->delete();
        return redirect()->route('home');
    }
}
