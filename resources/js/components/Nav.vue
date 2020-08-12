<template>
    <nav class="bg-white">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center font-logo">
                        <img class="block h-8 w-auto" src="/images/logo.svg" alt="YourBalance logo">
                        <p class="ml-4 my-0 tracking-wider text-lg">Your<span class="text-blue">Balance</span></p>
                    </div>

                </div>

                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button class="p-1 border-2 border-transparent text-gray-400 rounded-full hover:text-white focus:outline-none focus:text-white focus:bg-gray-700" aria-label="Notifications">
                        <img class="block h-4 w-auto" src="/images/alarm.svg" alt="YourBalance logo">
                    </button>

                    <div class="ml-3 relative">
                        <div>
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white" id="user-menu" aria-label="User menu" aria-haspopup="true">
                                <img class="block h-8 w-8" src="/images/avatar.png" alt="YourBalance logo">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>
