<script setup lang="ts">
import { Link, usePage, router } from '@inertiajs/vue3';
import { computed } from 'vue';

// Create computed properties for better reactivity
const auth = computed(() => usePage().props.auth);
const user = computed(() => auth.value?.user);
const isLoggedIn = computed(() => !!user.value);

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <nav class="bg-[#080808] text-[#FDFDFC] px-6 py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="font-bold text-xl md:text-2xl">
                laravel-<span class="bg-gradient-to-r from-[#FF2D20] to-[#FF6D60] text-transparent bg-clip-text">todolist</span>
            </div>

            <div>
                <!-- Show login button for guests -->
                <Link v-if="!isLoggedIn" :href="route('login')"
                      class="bg-[#333] hover:bg-[#444] px-4 py-2 rounded-md transition-colors duration-200 text-sm font-medium">
                    Login
                </Link>

                <!-- Show user info and logout for authenticated users -->
                <div v-else class="flex items-center gap-4">
                    <span class="text-lg font-bold">{{ user?.name }}</span>
                    <button @click="logout"
                            class="bg-[#333] hover:bg-[#444] px-4 py-2 rounded-md transition-colors duration-200 text-sm font-medium">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>
</template>
