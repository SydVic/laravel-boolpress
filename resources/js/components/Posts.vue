<template>
  <!-- CONTAINER -->
  <div class="container text-center">
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
      <!-- POST CARD -->
      <div class="card m-2" style="width: 18rem;" v-for="(post, index) in posts" :key="index">
        <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
        <div class="card-body">
          <h5 class="card-title">{{post.title}}</h5>
          <p class="card-text">{{ truncateText(post.content, 100)}}</p>
        </div>
        <!-- <ul class="list-group list-group-flush">
          <li class="list-group-item">Cras justo odio</li>
          <li class="list-group-item">Dapibus ac facilisis in</li>
          <li class="list-group-item">Vestibulum at eros</li>
        </ul>
        <div class="card-body">
          <a href="#" class="card-link">Card link</a>
          <a href="#" class="card-link">Another link</a>
        </div> -->
      </div>
      <!-- /POST CARD -->
    </div>
    <!-- /CONTAINER FLUID -->
  </div>
  <!-- /CONTAINER -->
</template>

<script>
export default {
  name: 'Posts',
  data() {
    return {
      posts: [],
      totalPosts: 0,
      currentPage: 1,
      lastPage: 0,
      itemsPerPage: 9
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
      });
    },
    truncateText(text, maxCharNumber) {
      if (text.length > maxCharNumber) {
        return text.substr(0, maxCharNumber) + '...';
      }
      return text;
    }
  }
}
</script>

<style>

</style>