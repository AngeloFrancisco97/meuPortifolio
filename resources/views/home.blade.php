@extends('layouts.app')

@section('content')
<menu-vertical-component class=""></menu-vertical-component>
@include('layouts.menuVertical')
<home-component projetos="{{ route('projeto_admin')}}" perfil="{{ route('perfil')}}" habilidades="{{ route('habilidade')}}">  
    
</home-component>

@endsection
