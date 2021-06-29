@extends('layouts.app')

@section('content')
<background-menu-component class="background-maneiro">
    <h1>Login</h1>
</background-menu-component>
<login-component token_csrf="{{ @csrf_token() }}"></login-component>
@endsection
