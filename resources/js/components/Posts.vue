<template>
  <div v-if="loading">
    <Loading />
  </div>
  <!-- CONTAINER -->
  <div v-else class="container text-center">
    <!-- PAGINATION -->
    <div class="container-fluid d-flex justify-content-center">
      <nav aria-label="...">
        <ul class="pagination">
          <!-- PREVIOUS PAGE -->
          <li class="page-item" :class="{ disabled: currentPage === 1 }">
            <a class="page-link" href="#" @click="getPosts(currentPage - 1)">Previous</a>
          </li>
          <!-- /PREVIOUS PAGE -->

          <!-- PAGES NUMBERS -->
          <li class="page-item" :class="{ active: currentPage === n }" v-for="n in lastPage" :key="n">
            <a class="page-link" href="#" @click="getPosts(currentPage = n)">{{ n }}</a>
          </li>
          <!-- /PAGES NUMBERS -->

          <!-- NEXT PAGE -->
          <li class="page-item" :class="{ disabled: currentPage === lastPage }">
            <a class="page-link" href="#" @click="getPosts(currentPage + 1)">Next</a>
          </li>
          <!-- /NEXT PAGE -->
        </ul>
      </nav>
    </div>
    <!-- /PAGINATION -->

    <h2 class="d-inline-block">ALL POSTS</h2>
    <p class="d-inline-block">Founded: {{ totalPosts }} posts</p>

    <!-- SELECT NUMBER OF ITEM PER PAGE -->
    <div class="form-group">
      <label for="items_per_page">Posts per page</label>
      <select class="form-select" name="items_per_page" id="items_per_page" v-model="itemsPerPage" @change="getPosts(1)">
        <option value="3">3</option>
        <option value="6">6</option>
        <option value="9">9</option>
        <option value="12">12</option>
      </select>
    </div>
    <!-- /SELECT NUMBER OF ITEM PER PAGE -->

    <!-- CONTAINER FLUID -->
    <div class="container-fluid d-flex justify-content-center flex-wrap">
      <PostCard v-for="post in posts" :key="post.id" :post="post"/>
    </div>
    <!-- /CONTAINER FLUID -->
  </div>
  <!-- /CONTAINER -->
</template>

<script>
import Loading from './Loading.vue';
import PostCard from './PostCard.vue';

export default {
  name: 'Posts',
  components: {
    Loading,
    PostCard
  },
  data() {
    return {
      posts: [],
      totalPosts: 0,
      currentPage: 1,
      lastPage: 0,
      itemsPerPage: 9,
      loading: true
    }
  },
  created() {
    this.getPosts();
  },
  methods: {
    getPosts(pageNumber) {
      axios.get('http://127.0.0.1:8000/api/posts', {
        params: {
          page: pageNumber,
          items_per_page: this.itemsPerPage,
        }
      }).then((resp) => {
        // Post:all();
        // this.posts = resp.data.results;

        // Post:paginate(); cambia la struttura della risposta
        this.posts = resp.data.results.data;
        this.currentPage = resp.data.results.current_page;
        this.lastPage = resp.data.results.last_page;
        this.totalPosts = resp.data.results.total;
        this.loading = false;
      });
    }
  }
}
</script>

<style>

</style>