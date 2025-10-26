<template>
  <q-layout>
    <q-page-container>
      <q-page>
        ...Procesando autenticación, por favor espera...
      </q-page>
    </q-page-container>
  </q-layout>
</template>
<script>
export default {
  name: 'AuthCallback',
  mounted() {
    const query = new URLSearchParams(window.location.search);
    const token = query.get('token');
    if (token) {
      localStorage.setItem('auth_token', token);
      // reditect /
      this.$router.push('/');
      // this.$router.push({ name: 'IndexPage' });
    } else {
      // this.$router.push({ name: 'LoginPage' });
    }
  }
}
</script>
