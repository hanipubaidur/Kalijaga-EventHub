<template lang="">
    <div>
        <NavBar :name="userName" :role="roleId" />
        <div class="container mt-4 d-flex justify-content-center">
            <!-- Card Wrapper -->
            <div class="card shadow-sm rounded-4 w-100" style="max-width: 1000px">
                <div class="card-body">
                    <h5 class="mb-4 fw-semibold">Tambah Event Baru</h5>
                    <form @submit.prevent="submitForm">
                        <!-- Judul -->
                        <div class="mb-3">
                            <label class="form-label">Judul Event</label>
                            <input
                                v-model="form.judul"
                                type="text"
                                class="form-control form-control-lg bg-light"
                                placeholder="Masukkan judul event"
                                required
                            />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea
                                v-model="form.deskripsi"
                                class="form-control bg-light"
                                placeholder="Deskripsi event"
                                rows="3"
                                required
                            ></textarea>
                        </div>

                        <!-- Gambar -->
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input
                                type="file"
                                @change="handleFileUpload"
                                class="form-control bg-light"
                                required
                            />
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input
                                v-model="form.tanggal"
                                type="date"
                                class="form-control bg-light"
                                required
                            />
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input
                                v-model="form.lokasi"
                                type="text"
                                class="form-control bg-light"
                                placeholder="Lokasi event"
                                required
                            />
                        </div>

                        <!-- Kategori -->
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select
                                v-model="form.kategory_id"
                                class="form-select bg-light"
                                required
                            >
                                <option disabled value="">-- Pilih Kategori --</option>
                                <option value="1">Akademik</option>
                                <option value="2">Kuliner</option>
                                <option value="3">Seni & Budaya</option>
                                <option value="4">Kompetensi/Lomba</option>
                                <option value="5">Organisasi</option>
                                <option value="6">Keagamaan</option>
                                <option value="7">Sosial & Pengabdian</option>
                                <option value="8">Lain-lain</option>
                            </select>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-3">
                            <button
                                type="submit"
                                class="btn btn-success px-4 rounded-3 w-100 w-sm-auto"
                            >
                                Buat Event
                            </button>
                            <button
                                type="button"
                                class="btn btn-outline-secondary px-4 rounded-3 w-100 w-sm-auto"
                                @click="router.push({ name: 'home' })"
                            >
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
=======
  <div>
    <NavBar :name="userName" :role="roleId" />
    <div class="container mt-4">
      <h3>Tambah Event</h3>
      <form @submit.prevent="submitForm">
        <!-- Judul -->
        <div class="mb-3">
          <label class="form-label">Judul</label>
          <input v-model="form.judul" type="text" class="form-control" required />
        </div>

        <!-- Deskripsi -->
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea v-model="form.deskripsi" class="form-control" required></textarea>
        </div>

        <!-- Gambar -->
        <div class="mb-3">
          <label class="form-label">Gambar</label>
          <input type="file" @change="handleFileUpload" class="form-control" required />
        </div>

        <!-- Tanggal -->
        <div class="mb-3">
          <label class="form-label">Tanggal</label>
          <input v-model="form.tanggal" type="date" class="form-control" required />
        </div>

        <!-- Lokasi -->
        <div class="mb-3">
          <label class="form-label">Lokasi</label>
          <input v-model="form.lokasi" type="text" class="form-control" required />
        </div>

        <!-- Kategori -->
        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select v-model="form.kategory_id" class="form-control" required>
            <option disabled value="">-- Pilih Kategori --</option>
            <option value="1">Akademik</option>
            <option value="2">Kuliner</option>
            <option value="3">Seni & Budaya</option>
            <option value="4">Kompetensi/Lomba</option>
            <option value="5">Organisasi</option>
            <option value="6">Keagamaan</option>
            <option value="7">Sosial & Pengabdian</option>
            <option value="8">Lain-lain</option>
          </select>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary">Simpan</button>
      </form>
    </div>
  </div>
</template>

<script>
import router from '@/router'
import NavBar from '@/components/icons/NavBar.vue'
import axios from 'axios'

export default {
    components: { NavBar },
    data() {
        return {
            roleId: '',
            userName: '',
            form: {
                judul: '',
                deskripsi: '',
                gambar_file: null, // sesuai field backend
                tanggal: '',
                lokasi: '',
                kategory_id: '',
            },
        }
    },
    mounted() {
        this.userName = localStorage.getItem('name')
        this.roleId = localStorage.getItem('role_id')
        if (!this.userName || this.userName === '') {
            router.push({ name: 'login' })
        }
    },
    methods: {
        handleFileUpload(event) {
            this.form.gambar_file = event.target.files[0]
        },
        async submitForm() {
            try {
                const formData = new FormData()
                formData.append('judul', this.form.judul)
                formData.append('deskripsi', this.form.deskripsi)
                formData.append('tanggal', this.form.tanggal)
                formData.append('lokasi', this.form.lokasi)
                formData.append('kategory_id', this.form.kategory_id)

                if (this.form.gambar_file) {
                    formData.append('gambar_file', this.form.gambar_file)
                }

                const response = await axios.post(
                    'http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/event',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            Authorization: `Bearer ${localStorage.getItem('token')}`,
                        },
                    },
                )

                alert('Event berhasil ditambahkan!')
                console.log(response.data)

                // reset form
                this.form = {
                    judul: '',
                    deskripsi: '',
                    gambar_file: null,
                    tanggal: '',
                    lokasi: '',
                    kategory_id: '',
                }
            } catch (error) {
                console.error(error)
                alert('Gagal menyimpan event!')
            }
        },
    },
}
</script>

<style scoped>
/* Tambahan styling opsional */
.card {
    border: none;
}

.form-control:focus,
.form-select:focus {
    border-color: #198754; /* hijau bootstrap */
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}
</style>
=======
  components: {
    NavBar,
  },
  data() {
    return {
      roleId: '',
      userName: '',
      form: {
        judul: '',
        deskripsi: '',
        gambar_file: null, // harus sama dengan field di backend
        tanggal: '',
        lokasi: '',
        kategory_id: '',
      },
    }
  },
  mounted() {
    this.userName = localStorage.getItem('name')
    this.roleId = localStorage.getItem('role_id')
    if (!this.userName || this.username == '' || this.userName == null) {
      router.push({ name: 'login' })
    }
  },
  methods: {
    handleFileUpload(event) {
      this.form.gambar_file = event.target.files[0]
    },
    async submitForm() {
      try {
        const formData = new FormData()
        formData.append('judul', this.form.judul)
        formData.append('deskripsi', this.form.deskripsi)
        formData.append('tanggal', this.form.tanggal)
        formData.append('lokasi', this.form.lokasi)
        formData.append('kategory_id', this.form.kategory_id)

        if (this.form.gambar_file) {
          formData.append('gambar_file', this.form.gambar_file)
        }

        const response = await axios.post(
          'http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/event',
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data',
              Authorization: `Bearer ${localStorage.getItem('token')}`,
            },
          },
        )

        alert('Event berhasil ditambahkan!')
        console.log(response.data)

        // reset form
        this.form = {
          judul: '',
          deskripsi: '',
          gambar_file: null,
          tanggal: '',
          lokasi: '',
          kategory_id: '',
        }
      } catch (error) {
        console.error(error)
        alert('Gagal menyimpan event!')
      }
    },
  },
}
</script>
<style lang=""></style>
