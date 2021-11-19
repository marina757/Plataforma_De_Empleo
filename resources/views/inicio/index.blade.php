@extends('layouts.app')

@section('navegacion')

@endsection

@section('content')
    <div class="flex flex-col lg:flex-row shadow bg-white">
        <div class="lg:w-1/2 px-8 lg:px-12 py-12 lg:py-24">
            <p class="text-2xl text-gray-700">
                dev <span class="font-bold">Jobs</span>
            </p>
            <h1 class="mt-2 sm:mt-4 text-3xl font-bold text-gray-700 leading-tight">
                Encuentra un trabajo remoto o en tu pais
                <span class="text-teal-500 block">Para desarrolladores</span>
            </h1>
        </div>

        <div class="block lg:w-1/2">
            <img class="inset-0 h-full w-full object-cover object-center" src="{{ asset('img/4321.jpg')}}" alt="devjobs">
        </div>
    </div>

@endsection
