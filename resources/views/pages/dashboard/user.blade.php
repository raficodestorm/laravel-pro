@extends('layouts.userlayout')
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
@section('content')
User tumin kemon acho
@endsection