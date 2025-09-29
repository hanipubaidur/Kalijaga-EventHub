<template>
  <div>
    <!-- Navbar -->
    <NavBar :name="userName" :role="roleId" />

    <!-- Detail Event -->
    <div class="container mt-4" v-if="event">
      <h2>{{ event.judul }}</h2>
      <img :src="imageUrl + event.gambar" alt="Event Image" class="img-fluid mb-3" />
      <p><strong>Deskripsi:</strong> {{ event.deskripsi }}</p>
      <p><strong>Tanggal:</strong> {{ event.tanggal }}</p>
      <p><strong>Lokasi:</strong> {{ event.lokasi }}</p>
    </div>

    <!-- Loading/Error -->
    <div class="container mt-4" v-else>
      <p v-if="loading">Memuat data event...</p>
      <p v-if="error" class="text-danger">{{ error }}</p>
    </div>
  </div>
</template>

<script>
import NavBar from '@/components/icons/NavBar.vue'
import axios from 'axios'
import router from '@/router'

export default {
  name: 'EventDetail',
  components: {
    NavBar,
  },
  props: ['id'], // menerima id dari route
  data() {
    return {
      userName: '',
      roleId: '',
      event: null, // object event
      imageUrl: 'http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/storage/events/',
      loading: true,
      error: null,
    }
  },
  mounted() {
    // Ambil data user
    this.userName = localStorage.getItem('name')
    this.roleId = localStorage.getItem('role_id')

    if (!this.userName) {
      router.push({ name: 'login' })
    }

    // Fetch data event berdasarkan id
    this.fetchEvent()
  },
  methods: {
    fetchEvent() {
      axios
        .get('http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/event', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        })
        .then((response) => {
          // cari event dengan id yang dikirim lewat props
          this.event = response.data.data.find((e) => e.id == this.id)
          if (!this.event) {
            this.error = 'Event tidak ditemukan'
          }
        })
        .catch((err) => {
          console.error(err)
          this.error = 'Gagal memuat data event'
        })
        .finally(() => {
          this.loading = false
        })
    },
  },
}
</script>

<style scoped>
img {
  max-height: 400px;
  object-fit: cover;
}
</style>
