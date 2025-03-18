<script setup lang="ts">
import { Head, usePage, useForm, router } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import AppLayout from "@/layouts/AppLayout.vue";

// Get auth user
const page = usePage();
const isLoggedIn = computed(() => !!page.props.auth?.user);
const currentUserId = computed(() => page.props.auth?.user?.id);

// Todo type definition
interface Todo {
    id: number;
    title: string;
    completed: boolean;
    user_id: number;
}

// Props coming from the controller
const props = defineProps<{
    todos: Todo[];
}>();

// Form for creating a new todo
const form = useForm({
    title: '',
});

// Submit new todo
const addTodo = () => {
    form.post(route('todos.store'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};

// Mark todo as completed or incomplete
const toggleComplete = (todo: Todo) => {
    // Optimistic UI update
    const originalStatus = todo.completed;
    todo.completed = !todo.completed;

    router.put(route('todos.update', todo.id), {
        completed: todo.completed
    }, {
        preserveScroll: true,
        onError: () => {
            // Revert on error
            todo.completed = originalStatus;
        }
    });
};

// Delete a todo
const deleteTodo = (todo: Todo) => {
    if (confirm('Are you sure you want to delete this task?')) {
        router.delete(route('todos.destroy', todo.id), {
            preserveScroll: true
        });
    }
};

</script>

<template>
    <Head title="Todo List">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <app-layout>
        <div class="flex min-h-screen flex-col items-center p-6 text-[#FDFDFC] bg-[#0a0a0a] lg:p-8">
            <h1 class="bg-gradient-to-r from-[#FF2D20] to-[#FF6D60] text-transparent bg-clip-text font-bold text-4xl mb-8">
                Todo List
            </h1>

            <!-- Todo Creation Form - Only for authenticated users -->
            <div v-if="isLoggedIn" class="w-full max-w-md mb-8">
                <form @submit.prevent="addTodo" class="flex gap-2">
                    <input
                        v-model="form.title"
                        type="text"
                        placeholder="Add a new task..."
                        class="flex-grow rounded-md border-0 py-2 px-3 bg-[#191919] shadow-sm ring-1 ring-inset ring-[#333] focus:ring-2 focus:ring-inset focus:ring-[#FF2D20] text-sm"
                        required
                    />
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded-md bg-gradient-to-r from-[#FF2D20] to-[#FF6D60] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:from-[#FF4D40] hover:to-[#FF8D80] disabled:opacity-75 flex items-center"
                    >
                        <span v-if="form.processing" class="mr-2">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                        Add
                    </button>
                </form>
                <div v-if="form.errors.title" class="text-red-500 text-xs mt-1">{{ form.errors.title }}</div>
            </div>

            <!-- Login message for guests -->
            <div v-else class="w-full max-w-md mb-8 p-4 bg-[#191919] rounded-md text-center">
                <p class="text-sm text-gray-400">
                    Please
                    <a :href="route('login')" class="text-[#FF2D20] hover:text-[#FF6D60] font-medium">login</a>
                    to add and manage tasks
                </p>
            </div>

            <!-- Todos List - Visible to everyone -->
            <div class="w-full max-w-md">
                <div v-if="props.todos.length === 0" class="text-gray-400 text-center text-sm py-8">
                    No tasks available
                </div>

                <ul v-else class="space-y-2">
                    <li
                        v-for="todo in props.todos"
                        :key="todo.id"
                        class="flex items-center justify-between p-3 bg-[#191919] rounded-md"
                        :class="{'border-l-4 border-l-[#FF2D20]': isLoggedIn }"
                    >
                        <div class="flex items-center gap-3">
                            <button
                                v-if="isLoggedIn"
                                @click="toggleComplete(todo)"
                                class="w-5 h-5 rounded-full border border-[#444] flex items-center justify-center flex-shrink-0 transition-all"
                                :class="{'bg-gradient-to-r from-[#FF2D20] to-[#FF6D60] border-0': todo.completed}"
                            >
                                <svg v-if="todo.completed" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </button>
                            <div
                                class="text-sm break-all transition-all"
                                :class="{'line-through text-gray-500': todo.completed}"
                            >
                                {{ todo.title }}
                            </div>
                        </div>

                        <button
                            v-if="isLoggedIn"
                            @click="deleteTodo(todo)"
                            class="text-gray-400 hover:text-red-500 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"></path>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </app-layout>
</template>
