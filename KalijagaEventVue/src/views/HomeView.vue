<template lang="">
  <NavBar :name="userName" :role="roleId" />
  <div>{{ userName }}</div>
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
    if (!this.userName || this.username == '' || this.userName == null) {
      router.push({ name: 'login' })
    }
  },
}
</script>
<style lang=""></style>
