@extends('layouts.app')

@section('title', 'Contact Us — Sports Warehouse')

@section('content')

<section class="py-6 md:py-10">
    <div class="container-960">

        {{-- Pill heading --}}
        <div class="pill-heading">
            <h1>Contact Us</h1>
        </div>

        {{-- White contact card --}}
        <div class="contact-card">

            <p class="text-base text-sw-grey mb-6 leading-relaxed">
                Sports Warehouse is coming soon. If you have any questions, we would love to hear from you. Please complete the form below.
            </p>

            {{-- Success flash message --}}
            @if (session('success'))
                <div class="alert-success" aria-live="polite">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation errors summary --}}
            @if ($errors->any())
                <div class="alert-error" aria-live="polite">
                    <ul class="list-disc list-inside m-0 p-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" novalidate>
                @csrf

                <fieldset class="contact-fieldset">
                    <legend class="contact-legend">Your details</legend>

                    <div class="mb-4">
                        <label for="firstName" class="contact-label">First name</label>
                        <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required class="contact-input">
                    </div>

                    <div class="mb-4">
                        <label for="lastName" class="contact-label">Last name</label>
                        <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required class="contact-input">
                    </div>

                    <div class="mb-4">
                        <label for="contactNumber" class="contact-label">Contact number</label>
                        <input type="text" id="contactNumber" name="contactNumber" value="{{ old('contactNumber') }}" class="contact-input">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="contact-label">Email address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="contact-input">
                    </div>

                    <div class="mb-4">
                        <label for="question" class="contact-label">Question</label>
                        <textarea id="question" name="question" rows="5" class="contact-input resize-y min-h-[140px]">{{ old('question') }}</textarea>
                    </div>

                    <div class="mb-4 flex items-start gap-2.5">
                        <input type="checkbox" id="terms" name="terms" value="yes" required @checked(old('terms') === 'yes') class="mt-1 flex-shrink-0">
                        <label for="terms" class="m-0 text-base text-sw-grey">
                            I agree to the <a href="#" class="text-sw-teal hover:text-sw-orange hover:underline">terms and conditions</a>
                        </label>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="contact-submit">Submit</button>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</section>

@endsection