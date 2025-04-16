<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function vcfSettings()
    {
        $vcfEnabled = DB::table('settings')->where('key_name', 'vcf_download_enabled')->value('key_value');
        return view('admin.vcf-settings', compact('vcfEnabled'));
    }

    public function updateVcfSettings(Request $request)
    {
        $status = $request->has('vcf_download_enabled') ? '1' : '0';

        DB::table('settings')->updateOrInsert(
            ['key_name' => 'vcf_download_enabled'],
            ['key_value' => $status]
        );

        return redirect()->route('admin.vcf.settings')->with('success', 'VCF setting updated successfully.');
    }
}
