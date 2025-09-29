<template>
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
