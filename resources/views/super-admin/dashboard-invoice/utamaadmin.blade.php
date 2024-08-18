@extends('layouts.mainSA')
@section('css')
<style>
    .dihover {
    width: max-content;
    background-color: #202b46;
    font-size: 2rem;
    border: 2px solid transparent;
    transition: all 0.3s ease;
    color:white;
}

.dihover:hover {
    background-color: white;
    border-color: #202b46;
    color: #202b46;
}

    </style>
@endsection
@section('konten')
<div class="d-flex flex-column w-100 p-5  gap-5 mt-5 justify-content-center">
    <a href="{{ route('datacs') }}" class="btn dihover m-auto">
        Data Customer Service
    </a>
    <a href="{{ route('dataJuragan') }}" class="btn dihover  m-auto">
        Data Juragan
    </a>
    <a class="btn dihover m-auto" href="{{ route('dataceo') }}">
        Data CEO
    </a>

</div>
@endsection
