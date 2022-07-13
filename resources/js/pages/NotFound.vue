<template>
  <div class="containe text-center">
    <h2>OOOPS! Page not found..</h2>
    <router-link class="btn btn-primary" :to="{ name: 'home' }">Back to Homepage</router-link>
  </div>
</template>

<script>
export default {
  name: "NotFound"
}
</script>

<style>

</style>