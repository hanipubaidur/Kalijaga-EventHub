<template lang="">
    <header v-if="$route.name != 'login'">
        <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
            <div class="container-fluid">
                <!-- Tombol toggle hamburger -->
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- menu kiri -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item me-2">
                            <RouterLink to="/" class="nav-link custom-btn"> Home </RouterLink>
                        </li>
                        <li class="nav-item me-2">
                            <RouterLink to="/event" class="nav-link custom-btn"> Event </RouterLink>
                        </li>
                        <li v-if="role == 1" class="nav-item me-2">
                            <RouterLink
                                to="/buat"
                                class="nav-link custom-btn btn-success text-white"
                            >
                                Buat Event
                            </RouterLink>
                        </li>
                    </ul>

                    <!-- menu kanan -->
                    <ul class="navbar-nav ms-auto align-items-lg-center">
                        <li class="nav-item me-lg-3 mb-2 mb-lg-0">
                            <span class="fw-bold">Hai, {{ name }}</span>
                        </li>
                        <li class="nav-item">
                            <a
                                href="#"
                                @click.prevent="logout"
                                class="btn btn-outline-danger fw-bold w-100 w-lg-auto"
                            >
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import axios from 'axios'
import router from '@/router'

export default {
    props: ['name', 'role'],
    methods: {
        logout() {
            axios
                .get(
                    'http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/auth/logout',
                    {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('token')}`,
                        },
                    },
                )
                .then(() => {
                    localStorage.removeItem('email')
                    localStorage.removeItem('name')
                    localStorage.removeItem('role_id')
                    localStorage.removeItem('token')
                    router.push({ name: 'login' })
                })
                .catch((error) => {
                    console.log(error)
                })
        },
    },
}
</script>

<style scoped>
.navbar {
    padding: 0.8rem 1rem;
}

/* Custom nav-link style */
.custom-btn {
    border-radius: 8px;
    padding: 0.5rem 1rem;
    background-color: #0c0b15;
    color: #fff !important;
    text-align: center;
    display: inline-block;
}

/* Khusus buat Buat Event */
.custom-btn.btn-success {
    background-color: #0ead4b !important;
    border: none;
}

/* Mode kecil: biar full width */
@media (max-width: 991.98px) {
    .custom-btn {
        display: block;
        width: 100%;
        margin-bottom: 0.5rem;
    }
    .btn-outline-danger {
        width: 100%;
    }
}
</style>
=======
  <header v-if="$route.name != 'login'">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item me-3">
              <RouterLink to="/">Home</RouterLink>
            </li>
            <li class="nav-item me-3">
              <RouterLink to="/event">Event</RouterLink>
            </li>
            <li v-if="role == 1" class="nav-item me-3">
              <RouterLink to="/buat">Buat Event</RouterLink>
            </li>
            <li class="nav-item">
              <a href="#" @click.prevent="logout">Logout</a>
            </li>
          </ul>
          <li class="d-flex">
            <span>Hai, {{ name }}</span>
          </li>
        </div>
      </div>
    </nav>
  </header>
</template>
<script>
import axios from 'axios'
import router from '@/router'
export default {
  props: ['name', 'role'],
  methods: {
    logout() {
      axios
        .get('http://localhost/Suka-projek/Kalijaga-EventHub-copy1-/public/api/auth/logout', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        })
        .then((response) => {
          console.log(response)
          localStorage.removeItem('email')
          localStorage.removeItem('name')
          localStorage.removeItem('role_id')
          localStorage.removeItem('token')
          router.push({ name: 'login' })
        })
        .catch((error) => {
          console.log(error)
        })
    },
  },
}
</script>
<style lang=""></style>