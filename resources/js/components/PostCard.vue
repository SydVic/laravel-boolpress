<template>
  <!-- POST CARD -->
      <div class="card m-2" style="width: 18rem;">
        <img v-if="post.cover" class="card-img-top" :src="post.cover" :alt="post.title">
        <div class="card-body">
          <h5 class="card-title">{{post.title}}</h5>
          <p class="card-text">Category: {{ categoryName}}</p>
          <p class="card-text">{{ truncateText(100)}}</p>
        </div>
        <div class="card-body">
          <router-link :to="{ name: 'single-post', params: {slug: post.slug} }">Read this post</router-link>
        </div>
      </div>
      <!-- /POST CARD -->
</template>

<script>
export default {
  name: 'PostCard',
  props: {
    post: Object
  },
  computed: {
    categoryName() {
      return this.post.category ? this.post.category.name : 'No category';
    }
  },
  methods: {
    truncateText(maxCharNumber) {
      if (this.post.content.length > maxCharNumber) {
        return this.post.content.substr(0, maxCharNumber) + '...';
      }
      return this.post.content;
    }
  },
}
</script>

<style>

</style>