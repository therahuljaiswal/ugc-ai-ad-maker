<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use App\Mail\CreditGiftMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'total_users' => User::count(),
            'total_credits' => User::sum('credits'),
        ]);
    }

    public function users()
    {
        return view('admin.users.index', [
            'users' => User::latest()->paginate(20),
        ]);
    }

    public function toggleBlock(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot block yourself.');
        }

        $user->update([
            'is_blocked' => !$user->is_blocked,
        ]);

        return back()->with('success', 'User status updated.');
    }

    public function giveCredits(Request $request, User $user)
    {
        $request->validate(['amount' => 'required|integer|min:1']);

        $user->increment('credits', $request->amount);

        try {
            Mail::to($user->email)->send(new CreditGiftMail($user, $request->amount));
        } catch (\Exception $e) {
            // Log error
        }

        return back()->with('success', "{$request->amount} credits gifted to {$user->name}.");
    }

    public function settings()
    {
        return view('admin.settings', [
            'gemini_api_key' => Setting::get('gemini_api_key'),
            'razorpay_key' => Setting::get('razorpay_key'),
            'razorpay_secret' => Setting::get('razorpay_secret'),
        ]);
    }

    public function saveSettings(Request $request)
    {
        $request->validate([
            'gemini_api_key' => 'nullable|string',
            'razorpay_key' => 'nullable|string',
            'razorpay_secret' => 'nullable|string',
        ]);

        Setting::set('gemini_api_key', $request->gemini_api_key);
        Setting::set('razorpay_key', $request->razorpay_key);
        Setting::set('razorpay_secret', $request->razorpay_secret);

        return back()->with('success', 'Settings saved.');
    }
}
