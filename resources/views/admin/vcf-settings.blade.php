@extends('layouts.admin')
@section('content')
    <h2>VCF Download Button Settings</h2>
    <form method="POST" action="{{ route('admin.vcf.settings.update') }}">
        @csrf
        <label>
            <input type="checkbox" name="vcf_download_enabled" {{ $vcfEnabled ? 'checked' : '' }}> VCF Download option
        </label>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
