<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark antialiased text-zinc-950 lg:bg-zinc-100 dark:bg-zinc-900 dark:text-white dark:lg:bg-zinc-950">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen">
        <flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <flux:brand href="/" class="px-2">
                <x-slot name="logo">
                    <svg width="75" height="13" viewBox="0 0 75 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.43999 12V2.816H0.23999V0.799999H8.87999V2.816H5.67999V12H3.43999Z" fill="currentColor" fill-opacity="0.6"/>
                        <path d="M11.5615 12.208C8.98549 12.208 7.25749 10.256 7.25749 7.856C7.25749 5.456 9.06549 3.472 11.5615 3.472C14.0575 3.472 15.7855 5.456 15.7855 7.856C15.7855 8.096 15.7695 8.352 15.7215 8.624H9.49749C9.73749 9.6 10.4735 10.288 11.5615 10.288C12.4895 10.288 13.2095 9.808 13.5935 9.168L15.2735 10.432C14.6015 11.472 13.2095 12.208 11.5615 12.208ZM11.5295 5.328C10.5055 5.328 9.73749 6.016 9.49749 7.008H13.6095C13.3695 6.08 12.5855 5.328 11.5295 5.328Z" fill="currentColor" fill-opacity="0.6"/>
                        <path d="M16.7337 12V3.68H18.8297V5.264C19.1177 4.064 19.9657 3.408 21.4057 3.488V5.52H21.1017C19.8537 5.52 18.8937 6.352 18.8937 7.744V12H16.7337Z" fill="currentColor" fill-opacity="0.6"/>
                        <path d="M22.1244 12V3.68H24.2204V5.264C24.5084 4.064 25.3564 3.408 26.7964 3.488V5.52H26.4924C25.2444 5.52 24.2844 6.352 24.2844 7.744V12H22.1244Z" fill="currentColor" fill-opacity="0.6"/>
                        <path d="M28.587 2.992C27.851 2.992 27.291 2.416 27.291 1.712C27.291 1.024 27.851 0.447999 28.587 0.447999C29.339 0.447999 29.883 1.024 29.883 1.712C29.883 2.432 29.339 2.992 28.587 2.992ZM27.515 12V3.68H29.675V12H27.515Z" fill="currentColor" fill-opacity="0.6"/>
                        <path d="M31.5605 12V5.52H30.3925V3.68H31.5605V3.12C31.5605 1.44 32.6485 0.32 34.3285 0.32H35.2245V2.16H34.6645C34.0245 2.16 33.7205 2.496 33.7205 3.152V3.68H35.4165V5.52H33.7205V12H31.5605Z" fill="currentColor" fill-opacity="0.6"/>
                        <path d="M37.212 2.992C36.476 2.992 35.916 2.416 35.916 1.712C35.916 1.024 36.476 0.447999 37.212 0.447999C37.964 0.447999 38.508 1.024 38.508 1.712C38.508 2.432 37.964 2.992 37.212 2.992ZM36.14 12V3.68H38.3V12H36.14Z" fill="currentColor" fill-opacity="0.6"/>
                        <path d="M43.5455 12.208C41.1615 12.208 39.2575 10.256 39.2575 7.84C39.2575 5.424 41.1135 3.488 43.6575 3.472C45.1775 3.456 46.4095 4.048 47.1135 5.024L45.4495 6.384C45.0655 5.808 44.4255 5.44 43.6895 5.44C42.3135 5.44 41.4175 6.544 41.4175 7.84C41.4175 9.136 42.3615 10.24 43.7375 10.24C44.5695 10.24 45.1135 9.824 45.5455 9.248L47.1135 10.608C46.3295 11.616 45.1775 12.208 43.5455 12.208Z" fill="currentColor" fill-opacity="0.6"/>
                        <path d="M50.7531 12V0.799999H54.5291C57.0411 0.799999 58.5771 1.984 58.5771 4.336C58.5771 6.704 57.0411 7.936 54.5291 7.936H52.9931V12H50.7531ZM52.9931 5.92H54.4011C55.6171 5.92 56.3051 5.424 56.3051 4.352C56.3051 3.296 55.6171 2.8 54.4011 2.8H52.9931V5.92Z" fill="currentColor"/>
                        <path d="M63.1114 12.208C60.5354 12.208 58.6794 10.256 58.6794 7.856C58.6794 5.456 60.5354 3.488 63.1114 3.488C65.6874 3.488 67.5434 5.456 67.5434 7.856C67.5434 10.256 65.6874 12.208 63.1114 12.208ZM63.1114 10.24C64.4874 10.24 65.3834 9.152 65.3834 7.856C65.3834 6.56 64.4874 5.456 63.1114 5.456C61.7354 5.456 60.8394 6.56 60.8394 7.856C60.8394 9.152 61.7354 10.24 63.1114 10.24Z" fill="currentColor"/>
                        <path d="M68.4994 12V0.32H70.6594V12H68.4994Z" fill="currentColor"/>
                        <path d="M71.9369 12V0.32H74.0969V12H71.9369Z" fill="currentColor"/>
                    </svg>
                </x-slot>
            </flux:brand>

            <flux:navlist variant="outline">
                <flux:navlist.item :href="route('forms.index')" wire:navigate>{{ __('Forms') }}</flux:navlist.item>
            </flux:navlist>

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        <flux:menu.item :href="route('billing.portal')" icon="layout-grid">{{ __('Billing Portal') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                        <flux:menu.item :href="route('billing.portal')" icon="layout-grid">{{ __('Billing Portal') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
