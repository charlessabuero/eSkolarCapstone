<div
    x-data="filamentLogo"
    x-on:dark-mode-toggled.window="toggle"
>
    <img src="{{ asset('logo_light.png') }}" alt="{{ env('APP_NAME') }} Logo" class="h-12"
         x-show="isLightMode">
 
    <img src="{{ asset('brand.png') }}"  alt="{{ env('APP_NAME') }} Dark Logo" class="h-12"
         x-show="isDarkMode">
</div>
 
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('filamentLogo', () => ({
            init() {
                this.toggle()
            },
            mode: 'light',
            toggle() {
                this.mode = document.documentElement.classList.contains('dark') ? 'dark' : 'light'
            },
            isDarkMode() {
                return this.mode === 'dark'
            },
            isLightMode() {
                return this.mode === 'light'
            }
        }))
    })
</script>