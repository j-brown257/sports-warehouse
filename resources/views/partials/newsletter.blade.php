{{--
    Newsletter signup — proof of concept built with Vue 3.

    Loaded via CDN directly in this partial (not bundled through Vite) to keep
    this POC self-contained and simple to demo. Per the project brief, there's
    no need to permanently store this data as a proof of concept, so on a
    successful submit we just show a confirmation message — nothing is sent
    to the server or saved anywhere.
--}}
@php
    $newsletterCategories = ($footerCategories ?? collect())->pluck('categoryName');
@endphp

<section class="bg-sw-teal text-white">
    <div class="container-960 py-6">
        <div id="newsletter-app" data-categories="{{ $newsletterCategories->toJson() }}">
            @verbatim
            <h3 class="text-lg font-normal mb-3">Sign up to our newsletter</h3>

            <form @submit.prevent="submitForm" class="flex flex-col md:flex-row gap-3 md:items-start" novalidate>
                <div class="flex-1">
                    <label for="newsletter-name" class="sr-only">Name</label>
                    <input type="text" id="newsletter-name" v-model="form.name" placeholder="Your name"
                           class="w-full h-10 px-4 rounded-full border border-white/40 bg-white/10 placeholder:text-white/70 text-white outline-none focus:outline-2 focus:outline-sw-orange">
                    <p v-if="errors.name" class="text-sw-orange text-xs mt-1">{{ errors.name }}</p>
                </div>

                <div class="flex-1">
                    <label for="newsletter-email" class="sr-only">Email</label>
                    <input type="email" id="newsletter-email" v-model="form.email" placeholder="Your email"
                           class="w-full h-10 px-4 rounded-full border border-white/40 bg-white/10 placeholder:text-white/70 text-white outline-none focus:outline-2 focus:outline-sw-orange">
                    <p v-if="errors.email" class="text-sw-orange text-xs mt-1">{{ errors.email }}</p>
                </div>

                <div class="flex-1">
                    <label for="newsletter-category" class="sr-only">Main product category of interest</label>
                    <select id="newsletter-category" v-model="form.category"
                            class="w-full h-10 px-4 rounded-full border border-white/40 bg-white/10 text-white outline-none focus:outline-2 focus:outline-sw-orange">
                        <option value="" disabled selected class="text-sw-dark">Main interest...</option>
                        <option v-for="cat in categories" :key="cat" :value="cat" class="text-sw-dark">{{ cat }}</option>
                    </select>
                    <p v-if="errors.category" class="text-sw-orange text-xs mt-1">{{ errors.category }}</p>
                </div>

                <button type="submit" class="h-10 px-6 rounded-full bg-sw-dark text-white hover:bg-sw-orange whitespace-nowrap">
                    Sign up
                </button>
            </form>

            <p v-if="submitted" class="mt-3 text-sm font-semibold">Thanks, {{ form.name }} — you're signed up!</p>
            @endverbatim
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.5.25/vue.global.js"></script>
<script>
    const { createApp, reactive, ref } = Vue;

    createApp({
        setup() {
            const root = document.getElementById('newsletter-app');
            const categories = JSON.parse(root.dataset.categories || '[]');

            const form = reactive({ name: '', email: '', category: '' });
            const errors = reactive({ name: '', email: '', category: '' });
            const submitted = ref(false);

            function submitForm() {
                errors.name = form.name.trim() === '' ? 'Please enter your name.' : '';
                errors.email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email) ? '' : 'Please enter a valid email.';
                errors.category = form.category === '' ? 'Please choose a category.' : '';

                submitted.value = !errors.name && !errors.email && !errors.category;

                // Proof of concept only — nothing is sent to the server or
                // stored anywhere, per the project brief.
            }

            return { form, errors, submitted, submitForm, categories };
        }
    }).mount('#newsletter-app');
</script>
