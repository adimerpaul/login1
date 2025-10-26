<!-- src/pages/LoginPage.vue -->
<template>
  <div class="q-pa-md flex flex-center column">
    <q-btn color="red" icon="login" label="Continuar con Google" @click="goGoogle" no-caps/>
    <pre>{{url}}</pre>
  </div>
</template>

<script>
export default {
  name: 'LoginPage',
  data() {
    return {
      url: process.env.VITE_API_URL
    }
  },
  methods: {
    goGoogle () {
      window.location.href = `${import.meta.env.VITE_API_URL}auth/google/redirect`
    }
  }
}
</script>
