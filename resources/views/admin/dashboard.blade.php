@extends('layouts.admin')
@section('content')
    <h1>Welcome to Admin Dashboard</h1>
    <a href="{{ route('admin.vcf.settings') }}" class="btn btn-primary">VCF Settings</a>
@endsection
