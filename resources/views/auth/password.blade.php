@extends('layouts.app')

@section('title', 'Update Password — Sports Warehouse')

@section('content')
<section class="py-6 md:py-10">
    <div class="container-960">
        <div class="pill-heading mb-5"><h1>Update Password</h1></div>

        @if (session('status'))
            <div class="alert-success">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert-error">
                <ul class="list-disc list-inside m-0 p-0">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="contact-card max-w-[420px]">
            <form action="{{ route('account.password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <fieldset class="contact-fieldset">
                    <legend class="contact-legend">Change your password</legend>
                    <div class="mb-4">
                        <label for="current_password" class="contact-label">Current password</label>
                        <input type="password" id="current_password" name="current_password" required class="contact-input">
                    </div>
                    <div class="mb-4">
                        <label for="new_password" class="contact-label">New password</label>
                        <input type="password" id="new_password" name="new_password" required class="contact-input">
                    </div>
                    <div class="mb-4">
                        <label for="new_password_confirmation" class="contact-label">Confirm new password</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required class="contact-input">
                    </div>
                    <button type="submit" class="contact-submit">Update password</button>
                </fieldset>
            </form>
        </div>
    </div>
</section>
@endsection