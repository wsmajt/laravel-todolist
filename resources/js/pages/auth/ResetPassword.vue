<script setup lang="ts">
import { useForm, Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps<{
    email: string;
    token: string;
}>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <AppLayout>
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 text-[#FDFDFC] bg-[#0a0a0a]">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight">
                    <span class="bg-gradient-to-r from-[#FF2D20] to-[#FF6D60] text-transparent bg-clip-text">
                        Reset Password
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
                                readonly
                                class="block w-full rounded-md border-0 py-2 px-3 bg-[#191919] shadow-sm ring-1 ring-inset ring-[#333] focus:ring-2 focus:ring-inset focus:ring-[#FF2D20] sm:text-sm opacity-70"
                            />
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium leading-6">New Password</label>
                        <div class="mt-2">
                            <input
                                id="password"
                                v-model="form.password"
                                type="password"
                                autocomplete="new-password"
                                required
                                class="block w-full rounded-md border-0 py-2 px-3 bg-[#191919] shadow-sm ring-1 ring-inset ring-[#333] focus:ring-2 focus:ring-inset focus:ring-[#FF2D20] sm:text-sm"
                            />
                            <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</div>
                        </div>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium leading-6">Confirm Password</label>
                        <div class="mt-2">
                            <input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                autocomplete="new-password"
                                required
                                class="block w-full rounded-md border-0 py-2 px-3 bg-[#191919] shadow-sm ring-1 ring-inset ring-[#333] focus:ring-2 focus:ring-inset focus:ring-[#FF2D20] sm:text-sm"
                            />
                            <div v-if="form.errors.password_confirmation" class="text-red-500 text-xs mt-1">
                                {{ form.errors.password_confirmation }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="flex w-full justify-center rounded-md bg-gradient-to-r from-[#FF2D20] to-[#FF6D60] px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:from-[#FF4D40] hover:to-[#FF8D80] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#FF2D20] disabled:opacity-75"
                        >
                            Reset Password
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm text-gray-400">
                    <Link :href="route('login')" class="font-semibold leading-6 text-[#FF2D20] hover:text-[#FF6D60]">
                        Back to login
                    </Link>
                </p>
            </div>
        </div>
    </AppLayout>
</template>
