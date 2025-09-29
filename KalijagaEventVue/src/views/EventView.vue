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
                .get('http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/event', {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`,
                    },
                })
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
<style>
.bordered {
    border: solid 1px;
}
</style>
