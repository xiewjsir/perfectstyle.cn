@extends('layouts.default')

@section('sidebar')
    @include('public.sidebar')
@endsection

@section('content')
    @each('public.posts', $posts, 'post')
    {{$posts->links()}}
@endsection
