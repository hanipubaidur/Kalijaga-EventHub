<template lang="">
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
