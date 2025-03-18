<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from "@/layouts/AppLayout.vue";
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <app-layout>
        <div class="flex min-h-screen flex-col items-center p-6 text-[#FDFDFC] bg-[#0a0a0a] font-bold text-4xl lg:p-8">
            <h1 class="bg-gradient-to-r from-[#FF2D20] to-[#FF6D60] text-transparent bg-clip-text">Todo List</h1>
        </div>
    </app-layout>
</template>
