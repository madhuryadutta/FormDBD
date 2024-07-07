<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;

class UserActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    // public function index()
    // {
    //     $userActivities = UserActivity::with('user', 'school')->latest()->paginate(100);
    //     return view('admin.user_activities.index', compact('userActivities'));
    // }
    public function index()
    {
        $userActivities = UserActivity::select('user_activities.*', 'schools.db_name')
            ->join('schools', 'schools.id', '=', 'user_activities.school_id')
            ->latest()
            ->paginate(100);

        return view('admin.user_activities.index', compact('userActivities'));
    }
}
