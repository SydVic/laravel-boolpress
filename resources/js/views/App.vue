<template>
  <div>
    <h2>VUE GUEST</h2>
    <Posts />
  </div>
</template>

<script>
import Posts from '../components/Posts.vue';

export default {
  name: 'App',
  components: {
    Posts
  }
}
</script>

<style lang="scss">
@import "~bootstrap/scss/bootstrap.scss";
</style>