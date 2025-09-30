
<template>
    <div>
        <!-- Navbar -->
        <NavBar :name="userName" :role="roleId" />

        <!-- Konten -->
        <div class="container-fluid content-wrapper">
            <!-- Search Box -->
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-center">
                    <input
                        type="text"
                        v-model="keyword"
                        class="form-control rounded-pill shadow-sm px-3 search-bar"
                        placeholder="Cari Event..."
                        @input="searchItem"
                    />
                </div>
            </div>

            <!-- Event List -->
            <div class="row g-4">
                <div
                    v-for="event in filteredEvents"
                    :key="event.id"
                    class="col-12 col-md-6 col-lg-4 col-xl-3"
                >
                    <div class="event-card h-100 d-flex flex-column" @click="goToDetail(event.id)">
                        <!-- Gambar Event -->
                        <img class="event-img" :src="url + event.gambar" alt="Event image" />

                        <!-- Isi Card -->
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <!-- Header -->
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="fw-bold">{{ event.judul }}</h5>
                                <div class="d-flex flex-column align-items-end gap-1">
                                    <span
                                        class="badge text-capitalize"
                                        :class="{
                                            'bg-purple text-white': event.kategori === 'seminar',
                                            'bg-warning text-dark': event.kategori === 'workshop',
                                            'bg-secondary text-white': event.kategori === 'ukm',
                                        }"
                                    >
                                        {{ event.kategori }}
                                    </span>
                                </div>
                            </div>

                            <!-- Deskripsi singkat -->
                            <p class="text-muted small flex-grow-1">
                                {{ event.deskripsi?.substring(0, 100) }}...
                            </p>

                            <!-- Info -->
                            <ul class="list-unstyled small text-muted mt-2 mb-0">
                                <li class="mb-1">
                                    <i class="bi bi-calendar-event me-2"></i>{{ event.tanggal }}
                                </li>
                                <li class="mb-1">
                                    <i class="bi bi-clock me-2"></i>{{ event.jam }}
                                </li>
                                <li class="mb-1">
                                    <i class="bi bi-geo-alt me-2"></i>{{ event.lokasi }}
                                </li>
                            </ul>

                            <!-- Tombol admin -->
                            <div v-if="roleId == 1" class="mt-3 text-end">
                                <button
                                    class="btn btn-sm btn-outline-danger"
                                    @click.stop="deleteEvent(event.id)"
                                >
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
=======
<template lang="">
    <div>
        <NavBar :name="userName" :role="roleId" />

        <div class="container-fluid mt-5">
            <div class="row">
                <!-- item list -->
                <div class="col-12 col-sm-8 mb-3">
                    <!-- search box -->
                    <div class="col-12">
                        <input
                            type="text"
                            v-model="keyword"
                            class="form-control"
                            placeholder="Cari Event"
                            :onchange="searchItem()"
                        />
                    </div>

                    <hr />
                    <!-- item list box -->
                    <div class="col-12">
                        <div class="row">
                            <div
                                v-for="event in filteredEvents"
                                class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3"
                            >
                                <div class="card" @click="goToDetail(event.id)">
                                    <img
                                        class="card-img-top object-fit-cover"
                                        height="100px"
                                        :src="url + event.gambar"
                                        alt="Card image cap"
                                    />
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ event.judul }}</h5>
                                        <p class="card-text">{{ `Tanggal: ${event.tanggal}` }}</p>
                                        <p>
                                            <button
                                                v-if="roleId == 1"
                                                class="btn btn-danger mt-2"
                                                @click="deleteEvent(event.id)"
                                            >
                                                Hapus
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- EventVue -->
                <div class="col-12 col-sm-4 mb-3 bordered">gagaga</div>
            </div>
        </div>
    </div>
</template>

<script>
import NavBar from '@/components/icons/NavBar.vue'
import axios from 'axios'

const API_URL = 'http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api'

export default {
    components: { NavBar },
=======
<script>
import NavBar from '@/components/icons/NavBar.vue'
import axios from 'axios'
// import router from '@/router'
export default {
    components: {
        NavBar,
    },
    data() {
        return {
            userName: '',
            roleId: '',
            events: [],
            filteredEvents: [],
            keyword: '',
            url: 'http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/storage/events/',
        }
    },
    mounted() {
        this.userName = localStorage.getItem('name')
        this.roleId = localStorage.getItem('role_id')
        const token = localStorage.getItem('token')

        if (!this.userName || !token) {
            this.$router.push({ name: 'login' })
            return
        }

=======
        if (!this.userName || this.userName == '' || this.userName == null) {
            router.push({ name: 'login' })
        }
        // if (this.roleId != 1) {
        //   router.push({ name: 'home' })
        // }
        this.getItems()
    },
    methods: {
        getItems() {
            axios
                .get(`${API_URL}/event`, {
=======
                .get('http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/event', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,
                    },
                })
                .then((res) => {
                    this.events = res.data.data
                    this.filteredEvents = this.events
                })
                .catch((err) => {
                    if (err.response && err.response.status === 401) {
                        alert('Sesi login sudah berakhir, silakan login kembali.')
                        localStorage.clear()
                        this.$router.push({ name: 'login' })
                    } else {
                        console.error(err)
                    }
=======
                .then((response) => {
                    this.events = response.data.data
                })
                .catch((error) => {
                    console.log(error)
                    console.log('errorrrrr')
                })
        },
        searchItem() {
            this.filteredEvents = this.events.filter((event) =>
                event.judul.toLowerCase().includes(this.keyword.toLowerCase()),
            )
        },
        goToDetail(id) {
            this.$router.push({ name: 'event-detail', params: { id } })
        },
        deleteEvent(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus event ini?')) return
            axios
                .delete(`${API_URL}/event/${id}`, {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,
                    },
                })
                .then(() => {
                    alert('Event berhasil dihapus')
                    this.getItems()
                })
                .catch((err) => {
                    if (err.response && err.response.status === 401) {
                        alert('Sesi login sudah berakhir, silakan login kembali.')
                        localStorage.clear()
                        this.$router.push({ name: 'login' })
                    } else {
                        alert('Gagal menghapus event')
                        console.error(err)
                    }
=======

            axios
                .delete(
                    `http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/event/${id}`,
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`,
                        },
                    },
                )
                .then(() => {
                    alert('Event berhasil dihapus')
                    this.getItems() // refresh daftar event
                })
                .catch((error) => {
                    console.log(error)
                    alert('Gagal menghapus event')
                })
        },
    },
}
</script>
<style scoped>
/* Jarak konten agar tidak ketiban navbar */
.content-wrapper {
    padding-top: 80px;
}

/* Search bar */
.search-bar {
    max-width: 600px;
    width: 100%;
}

/* Card Style */
.event-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    cursor: pointer;
    transition: transform 0.2s ease;
    display: flex;
    flex-direction: column;
}
.event-card:hover {
    transform: translateY(-3px);
}

/* Gambar di kartu */
.event-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

/* Warna tambahan */
.bg-purple {
    background-color: #9b6dff !important;
=======
<style>
.bordered {
    border: solid 1px;
}
</style>
