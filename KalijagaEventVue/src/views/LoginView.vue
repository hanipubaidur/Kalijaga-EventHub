<template>
    <div class="login-container d-flex justify-content-center align-items-center vh-100">
        <div class="card login-card shadow-lg rounded-4">
            <!-- Header -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-success">EventHub UIN Sunan Kalijaga</h2>
                <p class="text-muted mb-0">Sistem Manajemen Event</p>
            </div>

            <!-- Judul Form -->
            <h4 class="fw-bold mb-3 text-center">Login</h4>

            <!-- Form -->
            <form @submit.prevent="login">
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        v-model="email"
                        class="form-control form-control-lg rounded-3"
                        id="email"
                        placeholder="Masukkan email Anda"
                        autocomplete="username"
                        required
                    />
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        v-model="password"
                        class="form-control form-control-lg rounded-3"
                        id="password"
                        placeholder="Masukkan password Anda"
                        autocomplete="current-password"
                        required
                    />
                </div>
                <!-- Submit -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg rounded-3">Login</button>
                </div>
            </form>

            <!-- Register Link -->
            <p class="text-center mt-3 small">
                Belum punya akun?
                <router-link to="/register" class="text-success fw-bold">Register</router-link>
            </p>

            <!-- Demo Login Info -->
            <div class="alert demo-alert mt-3 rounded-3 small">
                <strong></strong><br />
                Admin: adm@email.com / adm123 <br />
            </div>
        </div>
    </div>
=======
  <div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4 rounded-4" style="width: 24rem">
      <h3 class="text-center mb-4">Login</h3>
      <form @submit.prevent="login">
        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input
            type="email"
            v-model="email"
            class="form-control"
            id="email"
            placeholder="Enter your email"
            autocomplete="username"
            required
          />
        </div>
        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            v-model="password"
            class="form-control"
            id="password"
            placeholder="Enter your password"
            autocomplete="current-password"
            required
          />
        </div>
        <!-- Remember Me -->
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="remember" />
          <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <!-- Submit -->
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
      <p class="text-center mt-3 mb-0">
        Don't have an account?
        <router-link to="/register">Register</router-link>
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
            email: '',
            password: '',
        }
    },
    methods: {
        login() {
            axios
                .post(
                    'http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/auth/login',
                    {
                        email: this.email,
                        password: this.password,
                    },
                )
                .then((response) => {
                    localStorage.setItem('email', response.data.data.email)
                    localStorage.setItem('name', response.data.data.name)
                    localStorage.setItem('role_id', response.data.data.role_id)
                    localStorage.setItem('token', response.data.data.token)
                    router.push({ name: 'home' })
                })
                .catch((error) => {
                    console.log(error)
                })
        },
    },
}
</script>

<style scoped>
.login-container {
    background: #f8fcf9; /* hijau muda */
    padding: 1rem;
}

.login-card {
    width: 100%;
    max-width: 500px; /* diperlebar agar seimbang */
    padding: 2.5rem;
    background: #fff;
}

.demo-alert {
    background: #e6f4ea; /* hijau muda lembut, ganti biru */
    border: 1px solid #a3d9a5;
    color: #2d6a4f;
}
</style>
=======
  data() {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    login() {
      axios
        .post('http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/auth/login', {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          console.log(response)
          localStorage.setItem('email', response.data.data.email)
          localStorage.setItem('name', response.data.data.name)
          localStorage.setItem('role_id', response.data.data.role_id)
          localStorage.setItem('token', response.data.data.token)
          router.push({ name: 'home' })
        })
        .catch((error) => {
          console.log(error)
        })
    },
  },
}
</script>

<style scoped></style>
