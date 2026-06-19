@extends('layouts.app')

@section('title', 'Staff Login — Sports Warehouse')

@section('content')
<section class="py-6 md:py-10">
    <div class="container-960">
        <div class="pill-heading mb-5"><h1>Staff Login</h1></div>

        @if ($errors->any())
            <div class="alert-error">
                <ul class="list-disc list-inside m-0 p-0">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="contact-card max-w-[420px]">
            <form action="{{ route('login.attempt') }}" method="POST">
                @csrf
                <fieldset class="contact-fieldset">
                    <legend class="contact-legend">Login</legend>
                    <div class="mb-4">
                        <label for="userName" class="contact-label">Username</label>
                        <input type="text" id="userName" name="userName" value="{{ old('userName') }}" required class="contact-input">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="contact-label">Password</label>
                        <input type="password" id="password" name="password" required class="contact-input">
                    </div>
                    <button type="submit" class="contact-submit">Log in</button>
                </fieldset>
            </form>
        </div>
    </div>
</section>
@endsection