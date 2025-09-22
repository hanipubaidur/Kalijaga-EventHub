<script setup>
import { Head } from '@inertiajs/vue3';
import EventCard from '@/Components/EventCard.vue';
// Asumsikan ada layout utama
import AppLayout from '@/Layouts/AppLayout.vue'; 

defineProps({
    events: Object, // Object paginasi dari Laravel
});
</script>

<template>
    <Head title="Beranda" />

    <AppLayout>
        <div class="container mx-auto py-8 px-4">
            <h1 class="text-3xl font-bold mb-6">Event Terdekat</h1>

            <div v-if="events.data.length > 0" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <EventCard v-for="event in events.data" :key="event.id" :event="event" />
            </div>
            <div v-else class="text-center py-16">
                <p class="text-gray-500">Belum ada event terdekat. Cek lagi nanti!</p>
            </div>
            
            </div>
    </AppLayout>
</template>