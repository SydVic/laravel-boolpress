<template>
  <!-- CONTAINER -->
  <div class="container">
    <h2>ALL POSTS</h2>
    <!-- CONTAINER FLUID -->
    <div class="container-fluid d-flex">
      <!-- POST CARD -->
      <div class="card m-2" style="width: 18rem;" v-for="(post, index) in posts" :key="index">
        <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
        <div class="card-body">
          <h5 class="card-title">{{post.title}}</h5>
          <p class="card-text">{{ truncateText(post.content, 50)}}</p>
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
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item active">
            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
          </li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
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
      posts: []
    }
  },
  created() {
    this.getPosts();
  },
  methods: {
    getPosts() {
      axios.get('http://127.0.0.1:8000/api/posts').then((resp) => {
        // Post:all();
        // this.posts = resp.data.results;

        // Post:paginate(); cambia la struttura della risposta
        this.posts = resp.data.results.data;
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