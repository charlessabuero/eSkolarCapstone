<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SMSService
{
    public static function sendMessage($data)
    {
        $response = Http::withToken(env('SMS_TOKEN'))
            ->post('https://www.traccar.org/sms/', [
                'to' => '+639279572101',
                'message' => $data['message']
            ]);


        return $response;
    }
}
