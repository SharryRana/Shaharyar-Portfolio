<template>
    <!-- Login Page -->

    <div class="flex mt-5 items-center justify-center p-12 from-[#0f0c29] via-[#302b63] to-[#24243e]">
        <div
            class="bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl p-10 max-w-md w-full border border-white/10 animate__animated animate__fadeInDown">
            <h2 class="text-3xl font-extrabold text-white text-center mb-8 tracking-wide">Login to Your Account</h2>

            <!-- Login Form -->
            <form @submit.prevent="submit" class="space-y-6 animate__animated animate__fadeIn">
                <!-- Email Field -->
                <div class="transition-all duration-300">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <input type="email" id="email" v-model="form.email"
                        class="w-full px-4 py-2 bg-white/10 text-white placeholder-gray-400 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300"
                        required placeholder="Enter your email" />
                    <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                </div>

                <!-- Password Field -->
                <div class="transition-all duration-300">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input type="password" id="password" v-model="form.password"
                        class="w-full px-4 py-2 bg-white/10 text-white placeholder-gray-400 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-300"
                        required placeholder="Enter your password" />
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 hover:from-indigo-700 hover:to-pink-700 text-white font-semibold py-2 rounded-lg shadow-lg hover:scale-105 transition-transform duration-300">
                    Login
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import {  useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    errors: {},
});

</script>
