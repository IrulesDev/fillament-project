<?php

namespace App\Http\Controllers;

use App\Mail\RapotMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RapotController extends Controller
{
    public function sendRapot(Request $request)
    {
        $rapotData = $request->all();
        Log::info('Sending rapot email with data:', $rapotData);

        try {
            Mail::to($rapotData['student_email'])->send(new RapotMail($rapotData));
            Log::info('Rapot email sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send rapot email:', ['error' => $e->getMessage()]);
        }

        return response()->json(['message' => 'Rapot email sent.']);
    }
}
