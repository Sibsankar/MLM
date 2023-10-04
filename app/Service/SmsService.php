<?php

namespace App\Service;
use App\Service\SmsServiceInterface;

class SmsService implements SmsServiceInterface
{
    public function sendSMS($receiver, $message)
    {
        // Account details
        $apiKey = urlencode(env('TEXTLOCAL_KEY'));
        
        // Message details
        $numbers = urlencode($receiver); //Mobile number on which you want to send message
        $sender = urlencode(env('TEXTLOCAL_SENDER')); 
        // $message = rawurlencode($message);

        // $numbers = implode(',', $numbers);
 
        // Prepare data for POST request
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        
        try {
            // Send the POST request with cURL
            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $e) {
            dd($e);
        }
        $response = json_decode($response);
        // var_dump($response->status); exit;
        if($response->status == "success") {
            return true;
        } else {
            dd($response);
        }
        
    }
}