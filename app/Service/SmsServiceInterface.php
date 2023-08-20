<?php

namespace App\Service;
interface SmsServiceInterface
{
    public function sendSMS($receiver, $message);
}