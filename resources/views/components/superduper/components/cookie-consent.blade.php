@if($siteSettings->enable_cookie_consent ?? false)
    <div
        x-data="{
            show: !localStorage.getItem('cookiesAccepted'),
            accept() {
                localStorage.setItem('cookiesAccepted', 'true');
                this.show = false;
            }
        }"
        x-show="show"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-8"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-8"
        class="fixed bottom-0 left-0 right-0 z-50 p-4 m-4 bg-white border border-gray-100 shadow-2xl dark:bg-gray-800 dark:border-gray-700 rounded-2xl md:max-w-2xl md:mx-auto"
        role="region"
        aria-label="Cookie Consent"
        aria-live="polite"
    >
        <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
            <div class="flex-1">
                <p class="text-sm text-gray-600 dark:text-gray-300">
                    We use cookies to improve your experience.
                    By continuing to use this site, you accept our use of cookies.
                </p>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <button
                    @click="accept()"
                    type="button"
                    class="px-5 py-2.5 text-sm font-medium text-white transition-all rounded-lg bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-100 dark:focus:ring-primary-900 focus:outline-none"
                >
                    Accept
                </button>
            </div>
        </div>
    </div>
@endif
