<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue'; 

defineProps({
    event: Object,
});

const formatDate = (dateString) => {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleDateString('id-ID', options) + ' WIB';
};
</script>

<template>
    <Head :title="event.title" />

    <AppLayout>
        <div class="container mx-auto py-10 px-4">
            <div class="max-w-4xl mx-auto bg-base-100 rounded-lg shadow-lg overflow-hidden">
                <img :src="event.poster_url || 'https://via.placeholder.com/800x400'" alt="Poster Detail" class="w-full h-64 object-cover">
                <div class="p-6">
                    <div class="badge badge-accent mb-2">{{ event.category.name }}</div>
                    <h1 class="text-4xl font-extrabold mb-4">{{ event.title }}</h1>
                    
                    <div class="space-y-4 text-gray-700 mb-6">
                        <p><strong>🗓️ Waktu:</strong> {{ formatDate(event.start_datetime) }}</p>
                        <p><strong>📍 Lokasi:</strong> {{ event.location }}</p>
                        <p><strong>🏢 Penyelenggara:</strong> {{ event.organizer }}</p>
                    </div>

                    <h2 class="text-xl font-bold mb-2">Deskripsi</h2>
                    <p class="prose max-w-none mb-8">{{ event.description }}</p>

                    <a :href="event.registration_link" target="_blank" class="btn btn-primary w-full sm:w-auto">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </AppLayout>
</template>