<template>
    <div class="login-container vh-100 d-flex justify-content-center align-items-center">
        <div class="card login-card shadow-lg rounded-4">
            <h3 class="text-center mb-4">Register</h3>
            <form @submit.prevent="submitForm">
                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="form-control"
                        placeholder="Masukkan nama Anda"
                        required
                    />
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        class="form-control"
                        placeholder="Masukkan email Anda"
                        required
                    />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                        v-model="form.password"
                        type="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                    />
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input
                        v-model="form.password_confirmation"
                        type="password"
                        class="form-control"
                        placeholder="Ulangi password"
                        required
                    />
                </div>

                <!-- Role (default 2 / User biasa) -->
                <input type="hidden" v-model="form.role_id" />

                <!-- Tombol Submit -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </form>

            <!-- Pesan Error -->
            <div v-if="errorMessage" class="alert alert-danger mt-3">
                {{ errorMessage }}
            </div>

            <!-- Pesan Success -->
            <div v-if="successMessage" class="alert alert-success mt-3">
                {{ successMessage }}
            </div>

            <!-- Link ke Login -->
            <p class="text-center mt-3 mb-0">
                Sudah punya akun?
                <router-link to="/login">Login</router-link>
            </p>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import router from '@/router'

export default {
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                role_id: 2, // default role = 2 (user biasa)
            },
            errorMessage: '',
            successMessage: '',
        }
    },
    methods: {
        async submitForm() {
            this.errorMessage = ''
            this.successMessage = ''
            try {
                const response = await axios.post(
                    'http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/auth/register',
                    this.form,
                )
                this.successMessage = 'Register berhasil!'

                // simpan data user + token ke localStorage
                localStorage.setItem('name', response.data.data.user.name)
                localStorage.setItem('role_id', response.data.data.user.role_id)
                localStorage.setItem('token', response.data.data.token)

                // redirect ke home
                router.push({ name: 'home' })
            } catch (error) {
                if (error.response && error.response.data && error.response.data.errors) {
                    const errors = error.response.data.errors
                    this.errorMessage = Object.values(errors).flat().join(' ')
                } else {
                    this.errorMessage = 'Terjadi kesalahan, silakan coba lagi.'
                }
            }
        },
    },
}
</script>

<style scoped>
.login-container {
    background: #f8fcf9; /* hijau muda lembut */
    padding: 1rem;
}

.login-card {
    width: 100%;
    max-width: 500px;
    padding: 2.5rem;
    background: #fff;
}
</style>
