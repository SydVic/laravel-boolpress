<template>
  <!-- CONTAINER -->
  <div class="container text-center flex-wrap">
    <h2>ALL POSTS</h2>
    <!-- CONTAINER FLUID -->
    <div class="container-fluid d-flex">
      <!-- POST CARD -->
      <div class="card m-2" v-for="(post, index) in posts" :key="index">
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

    <!-- PAGINATION -->
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
      <!-- /PAGINATION -->
  </div>
  <!-- /CONTAINER -->
</template>

<script>
export default {
  name: 'Posts',
  data() {
    return {
      posts: [],
      currentPage: 1,
      lastPage: 0
    }
  },
  created() {
    this.getPosts();
  },
  methods: {
    getPosts(pageNumber) {
      axios.get('http://127.0.0.1:8000/api/posts', {
        params: {
          page: pageNumber
        }
      }).then((resp) => {
        // Post:all();
        // this.posts = resp.data.results;

        // Post:paginate(); cambia la struttura della risposta
        this.posts = resp.data.results.data;
        this.currentPage = resp.data.results.current_page;
        this.lastPage = resp.data.results.last_page;
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