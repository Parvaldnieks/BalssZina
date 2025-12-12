<?php

namespace App\Http\Controllers;

use App\Models\ApiRequest;
use App\Models\PendingKey;
use Illuminate\Http\Request;

class PendingKeyController extends Controller
{
public function pickupForm()
    {
        return view('api-piekluve.pickup');
    }

    public function pickupCheck(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        $apiRequest = ApiRequest::where('email', $email)->first();

        if (!$apiRequest) {
            return redirect()->back()->with('error', 'No request found for this email!');
        }

        if ($apiRequest->blocked) {
            return redirect()->back()->with('error', 'Request has been blocked!');
        }

        if ($apiRequest->status === 'pending') {
            return redirect()->back()->with('error', 'Request is still pending approval!');
        }

        if ($apiRequest->status === 'denied') {
            return redirect()->back()->with('error', 'Request was denied!');
        }

        $pending = PendingKey::where('email', $email)->first();

        if ($pending && !$pending->copied && $pending->expires_at && $pending->expires_at < now()) {
            $pending->delete();
            return redirect()->back()->with('error', 'Your API key expired before activation. Please request access again.');
        }

        if (!$pending->copied) {
            return redirect()->back()
                ->with('pending_email', $email)
                ->with('pending_key', $pending->api_key);
        }

        return redirect()->back()->with('success', 'Your API key is active and ready to use.');
    }

    public function markCopied(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $pending = PendingKey::where('email', $request->email)->first();

        if ($pending && !$pending->copied) {
            $pending->copied = true;
            $pending->save();
        }

    return redirect()->back()->with('success', 'API key copied successfully. Keep it safe!');
    }
}
