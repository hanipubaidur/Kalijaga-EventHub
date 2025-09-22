<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    event: Object,
});

const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
};
</script>

<template>
    <Link :href="route('events.show', event.id)">
        <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <figure>
                <img :src="event.poster_url || 'https://via.placeholder.com/400x200'" alt="Poster Event" class="h-48 w-full object-cover" />
            </figure>
            <div class="card-body p-4">
                <div class="badge badge-primary">{{ event.category.name }}</div>
                <h2 class="card-title text-lg font-bold truncate">{{ event.title }}</h2>
                <p class="text-sm">{{ formatDate(event.start_datetime) }}</p>
                <div class="card-actions justify-end">
                    <span class="text-xs text-gray-500">{{ event.organizer }}</span>
                </div>
            </div>
        </div>
    </Link>
</template>