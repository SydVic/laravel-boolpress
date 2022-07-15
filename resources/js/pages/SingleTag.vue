<template>
  <div class="container">
    <div v-if="tag">
      <h2>Tag: {{tag.name}}</h2>
      <p>Related Posts</p>
      <div class="container-fluid d-flex flex-wrap justify-content-center">
        <PostCard v-for="post in tag.posts" :key="post.id" :post="post"/>
      </div>
    </div>
    <div v-else>
      <Loading />
    </div>
  </div>
</template>

<script>
import Loading from "../components/Loading.vue";
import PostCard from "../components/PostCard.vue";

export default {
  name: 'SingleTag',
  components: {
    Loading,
    PostCard
  },
  data() {
    return {
      tag: null
    };
  },
  created() {
    this.getTagDetails();
  },
  methods: {
    getTagDetails() {
      axios.get(`http://127.0.0.1:8000/api/tags/${this.$route.params.slug}`)
      .then((resp) => {
        // console.log(resp);
        this.tag = resp.data.results;
      });
    }
  }
}
</script>

<style>

</style>