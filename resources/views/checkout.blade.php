@extends('layouts.app')

@section('title', 'Checkout — Sports Warehouse')

@section('content')
<section class="py-6 md:py-10">
    <div class="container-960">

        <div class="pill-heading mb-5">
            <h1>Checkout</h1>
        </div>

        {{-- Server-side error summary (Laravel) — same pattern as your contact form --}}
        @if ($errors->any())
            <div class="alert-error">
                <ul class="list-disc list-inside m-0 p-0">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        {{-- Client-side error summary (filled in by JavaScript) --}}
        <div id="js-errors" class="alert-error hidden"></div>

        <div class="md:flex md:gap-6 md:items-start">

            {{-- LEFT: the form --}}
            <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST" novalidate class="md:flex-1">
                @csrf

                <fieldset class="contact-fieldset mb-5">
                    <legend class="contact-legend">Delivery details</legend>

                    <div class="mb-4">
                        <label for="firstName" class="contact-label">First name</label>
                        <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" class="contact-input">
                    </div>
                    <div class="mb-4">
                        <label for="lastName" class="contact-label">Last name</label>
                        <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" class="contact-input">
                    </div>
                    <div class="mb-4">
                        <label for="address" class="contact-label">Delivery address</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" class="contact-input">
                    </div>
                    <div class="mb-4">
                        <label for="contactNumber" class="contact-label">Contact number</label>
                        <input type="text" id="contactNumber" name="contactNumber" value="{{ old('contactNumber') }}" class="contact-input">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="contact-label">Email address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="contact-input">
                    </div>
                </fieldset>

                <fieldset class="contact-fieldset mb-5">
                    <legend class="contact-legend">Payment</legend>

                    <div class="mb-4">
                        <label for="creditCardNumber" class="contact-label">Credit card number</label>
                        <input type="text" id="creditCardNumber" name="creditCardNumber" value="{{ old('creditCardNumber') }}" inputmode="numeric" class="contact-input">
                    </div>
                    <div class="flex gap-4">
                        <div class="mb-4 flex-1">
                            <label for="expiryDate" class="contact-label">Expiry (MM/YY)</label>
                            <input type="text" id="expiryDate" name="expiryDate" value="{{ old('expiryDate') }}" placeholder="MM/YY" class="contact-input">
                        </div>
                        <div class="mb-4 w-24">
                            <label for="csv" class="contact-label">CSV</label>
                            <input type="text" id="csv" name="csv" inputmode="numeric" class="contact-input">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="nameOnCard" class="contact-label">Name on card</label>
                        <input type="text" id="nameOnCard" name="nameOnCard" value="{{ old('nameOnCard') }}" class="contact-input">
                    </div>
                </fieldset>

                <button type="submit" class="contact-submit">Place order</button>
            </form>

            {{-- RIGHT: order summary --}}
            <div class="md:w-[300px] mt-6 md:mt-0">
                <div class="bg-gray-50 border border-gray-300 rounded-lg p-4 text-sm">
                    <h2 class="text-base font-semibold mb-3">Order summary</h2>
                    @foreach ($cart as $line)
                        <div class="flex justify-between py-1">
                            <span class="text-sw-grey">{{ $line['name'] }} ×{{ $line['qty'] }}</span>
                            <span>${{ number_format($line['price'] * $line['qty'], 2) }}</span>
                        </div>
                    @endforeach
                    <div class="flex justify-between py-1 border-t border-gray-200 mt-2 pt-2">
                        <span class="text-sw-grey">Shipping</span><span>${{ number_format($shipping, 2) }}</span>
                    </div>
                    <div class="flex justify-between py-1 text-sw-grey italic">
                        <span>GST (included)</span><span>${{ number_format($gst, 2) }}</span>
                    </div>
                    <div class="flex justify-between border-t-2 border-gray-300 mt-2 pt-2 font-bold text-base">
                        <span>TOTAL</span><span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== Client-side validation ===== --}}
<script>
document.getElementById('checkout-form').addEventListener('submit', function (e) {
    const v = id => document.getElementById(id).value.trim();
    const errors = [];

    if (v('firstName') === '')  errors.push('Please enter your first name.');
    if (v('lastName')  === '')  errors.push('Please enter your last name.');
    if (v('address')   === '')  errors.push('Please enter your delivery address.');
    if (!/^[0-9 +()-]{6,20}$/.test(v('contactNumber'))) errors.push('Please enter a valid contact number.');
    if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(v('email')))  errors.push('Please enter a valid email address.');

    if (!/^[0-9]{13,16}$/.test(v('creditCardNumber').replace(/\s/g, ''))) errors.push('Card number must be 13–16 digits.');
    if (!/^(0[1-9]|1[0-2])\/[0-9]{2}$/.test(v('expiryDate'))) errors.push('Expiry must be in MM/YY format.');
    if (!/^[0-9]{3}$/.test(v('csv'))) errors.push('CSV must be 3 digits.');
    if (v('nameOnCard') === '') errors.push('Please enter the name on the card.');

    const box = document.getElementById('js-errors');
    if (errors.length) {
        e.preventDefault();   // stop the form submitting
        box.innerHTML = '<ul class="list-disc list-inside m-0 p-0">' + errors.map(x => '<li>' + x + '</li>').join('') + '</ul>';
        box.classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
});
</script>
@endsection