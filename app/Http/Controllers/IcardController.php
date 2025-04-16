<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class IcardController extends Controller
{
    public function downloadVcf($userId)
    {
        $user = User::findOrFail($userId);

        $vcf = "BEGIN:VCARD\n";
        $vcf .= "VERSION:3.0\n";
        $vcf .= "FN:{$user->name}\n";
        $vcf .= "EMAIL:{$user->email}\n";
        $vcf .= "ORG:Idab Tach\n";
        $vcf .= "END:VCARD\n";

        return response($vcf)
            ->header('Content-Type', 'text/vcard')
            ->header('Content-Disposition', 'attachment; filename="' . $user->name . '.vcf"');
    }
}
