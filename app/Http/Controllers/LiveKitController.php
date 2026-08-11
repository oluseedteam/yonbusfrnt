<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LiveKitController extends Controller
{
    /**
     * Generate a LiveKit / WebRTC Access Token for Video Calls & Screen Sharing
     */
    public function token(Request $request)
    {
        $request->validate([
            'room_name' => 'nullable|string|max:100',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $roomName = $request->room_name ?: 'yonbus-consultation-' . md5($user->id);
        $identity = $user->email ?: 'user-' . $user->id;
        $name = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? '')) ?: ($user->name ?: 'Participant');

        $apiKey = config('services.livekit.key') ?: env('LIVEKIT_API_KEY', 'APIMzUfWXsnDyvG');
        $apiSecret = config('services.livekit.secret') ?: env('LIVEKIT_API_SECRET', 'egA5rehXpGRR2sEweCFxVPHwlvJIHvWPZQ44zevqpcYD');
        $wsUrl = config('services.livekit.url') ?: env('LIVEKIT_URL', 'wss://yonbus-tax-jzqr2nc3.livekit.cloud');

        // Create JWT token payload according to LiveKit Access Token Spec
        $now = time();
        $ttl = 3600; // 1 hour

        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT',
        ];

        $payload = [
            'iss'  => $apiKey,
            'sub'  => $identity,
            'nbf'  => $now - 5,
            'exp'  => $now + $ttl,
            'name' => $name,
            'video' => [
                'room'         => $roomName,
                'roomJoin'     => true,
                'canPublish'   => true,
                'canSubscribe' => true,
                'canPublishData' => true,
            ],
        ];

        $token = $this->generateJwt($header, $payload, $apiSecret);

        return response()->json([
            'token'     => $token,
            'ws_url'    => $wsUrl,
            'room_name' => $roomName,
            'identity'  => $identity,
            'name'      => $name,
        ]);
    }

    /**
     * Helper to encode JWT with HMAC SHA256
     */
    private function generateJwt(array $header, array $payload, string $secret): string
    {
        $base64UrlHeader = $this->base64UrlEncode(json_encode($header));
        $base64UrlPayload = $this->base64UrlEncode(json_encode($payload));

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignature = $this->base64UrlEncode($signature);

        return $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
