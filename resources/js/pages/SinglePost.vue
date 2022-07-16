<template>
  <div class="container d-flex justify-content-center">
    <div v-if="post">
      <div v-if="post.cover">
        <img :src="post.cover" :alt="post.title">
      </div>
      <h1>{{ post.title }}</h1>
      <p>Category: <span class="badge badge-primary"> {{ categoryName }} </span></p>
      <router-link :to="{ name: 'single-tag', params: { slug: tag.slug } }" v-for="tag in post.tags" :key="tag.id" class="badge badge-pill badge-success mb-4 mr-2">{{ tag.name }}</router-link>
      <p>{{ post.content }}</p>
    </div>
    <Loading v-else />
  </div>
</template>

<script>
import PostCard from "../components/PostCard.vue";
import Loading from "../components/Loading.vue";

export default {
  name: 'SinglePost',
  components: {
    PostCard,
    Loading
  },
  data() {
    return {
      post: null
    }
  },
  created() {
    this.getPostDetails();
  },
  computed: {
    categoryName() {
      return this.post.category ? this.post.category.name : 'no category';
    },
  },
  methods: {
    getPostDetails() {
      // $route è una variabile speciale che ci da Vue Router e ci permette di capire dove ci troviamo in qualsiasi punto dell'applicazione
      const slug = this.$route.params.slug;
      console.log(slug);
      // !!!!!!!! ATTENZIONE CHE CI VOGLIONO I BACKTICK !!!!!!!!!!
      axios.get(`http://127.0.0.1:8000/api/posts/${slug}`).then((resp) => {
        if (resp.data.success) {
          this.post = resp.data.results;
        } else {
          this.$router.push({ name: 'not-found'});
        }
      });
    }
  }
}
</script>

<style>

</style>