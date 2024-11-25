@extends('layouts.landing')

@section('title', 'Landing Page')

@section('content')
    @include('components.hero', [
        'salam' => 'Halo, Saye Upin',
        'judul' => 'Saya ini mahasiswa',
        'caption' => 'sebagai upin saya akan melindungi bumi',
        'foto' => 'dist/assets/images/hero/ipin.jpg'
    ])
    {{-- @include('components.services',['services'=>$services]) --}}
     @include('components.berita')
    {{-- @include('components.portfolio')
    @include('components.testimonials')
    @include('components.cta') --}}
@endsection
