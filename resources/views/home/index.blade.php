@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center">Welcome!</h1>

        <ul class="text-center pt-5 links-list fs-5">
            <li class="py-3">
                <a class="links-list-link" href="#">
                    Backend 1
                </a>
            </li>
            <li class="py-3">
                <a class="links-list-link" href="#">
                    Databese 1
                </a>
            </li>
            <li class="py-3">
                <a class="links-list-link" href="{{ route('general.one') }}">
                    General 1-1
                </a>
            </li>
            <li class="py-3">
                <a class="links-list-link" href="{{ route('general.two') }}">
                    General 1-2
                </a>
            </li>
        </ul>
    </div>
@endsection
