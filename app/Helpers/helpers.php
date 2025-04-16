<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('isVcfEnabled')) {
    function isVcfEnabled(): bool
    {
        return DB::table('settings')
            ->where('key_name', 'vcf_download_enabled')
            ->value('key_value') === '1';
    }
}
