﻿<script setup lang="ts">
import { useForm, Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Login" />

    <AppLayout>
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 text-[#FDFDFC] bg-[#0a0a0a]">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight">
                    <span class="bg-gradient-to-r from-[#FF2D20] to-[#FF6D60] text-transparent bg-clip-text">
                        Sign in to your account
                    </span>
                </h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" @submit.prevent="submit">
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6">Email address</label>
                        <div class="mt-2">
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                autocomplete="email"
                                required
                                class="block w-full rounded-md border-0 py-2 px-3 bg-[#191919] shadow-sm ring-1 ring-inset ring-[#333] focus:ring-2 focus:ring-inset focus:ring-[#FF2D20] sm:text-sm"
                            />
                            <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</div>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium leading-6">Password</label>
                            <Link :href="route('password.request')" class="text-sm font-semibold text-[#FF2D20] hover:text-[#FF6D60]">
                                Forgot password?
                            </Link>
                        </div>
                        <div class="mt-2">
                            <input
                                id="password"
                                v-model="form.password"
                                type="password"
                                autocomplete="current-password"
                                required
                                class="block w-full rounded-md border-0 py-2 px-3 bg-[#191919] shadow-sm ring-1 ring-inset ring-[#333] focus:ring-2 focus:ring-inset focus:ring-[#FF2D20] sm:text-sm"
                            />
                            <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input
                            id="remember"
                            v-model="form.remember"
                            type="checkbox"
                            class="h-4 w-4 rounded border-[#333] bg-[#191919] text-[#FF2D20] focus:ring-[#FF2D20]"
                        />
                        <label for="remember" class="ml-2 block text-sm text-[#FDFDFC]">Remember me</label>
                    </div>

                    <div>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="flex w-full justify-center rounded-md bg-gradient-to-r from-[#FF2D20] to-[#FF6D60] px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:from-[#FF4D40] hover:to-[#FF8D80] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FF2D20] disabled:opacity-75"
                        >
                            Sign in
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm text-gray-400">
                    Not a member?
                    <Link :href="route('register')" class="font-semibold leading-6 text-[#FF2D20] hover:text-[#FF6D60]">
                        Register now
                    </Link>
                </p>
            </div>
        </div>
    </AppLayout>
</template>
