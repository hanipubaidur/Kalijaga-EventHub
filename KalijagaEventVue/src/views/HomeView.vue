<template lang="">
    <div>
        <!-- Navbar tetap di atas -->
        <NavBar :name="userName" :role="roleId" />

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-overlay">
                <h1 class="hero-title">Selamat Datang, {{ userName }}</h1>
                <p class="hero-subtitle">
                    <span class="highlight">Kalijaga EventHub</span> adalah platform untuk menampung
                    dan mengelola berbagai event kampus <strong>UIN Sunan Kalijaga</strong>. Temukan
                    seminar, workshop, dan acara komunitas dalam satu tempat.
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import router from '@/router'
import NavBar from '@/components/icons/NavBar.vue'

export default {
    components: {
        NavBar,
    },
    data() {
        return {
            roleId: '',
            userName: '',
        }
    },
    mounted() {
        this.userName = localStorage.getItem('name')
        this.roleId = localStorage.getItem('role_id')
        if (!this.userName || this.userName == '' || this.userName == null) {
            router.push({ name: 'login' })
        }
    },
}
</script>

<style lang="css">
/* Hero Section */
.hero-section {
    position: relative;
    width: 100%;
    height: 85vh;
    background: url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d') center/cover
        no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero-overlay {
    text-align: center;
    background: rgba(0, 0, 0, 0.45);
    padding: 2rem;
    border-radius: 0.75rem;
    max-width: 800px;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.1rem;
    color: #f1f1f1;
    line-height: 1.6;
}

.highlight {
    color: #4da3ff;
    font-weight: 600;
}
</style>
