<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Boolpress</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item" v-for="(link, index) in menuLinks" :key="index">
            <router-link class="nav-link" :to="{ name: link.name }">{{ link.title }}</router-link>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: 'Header',
  data() {
    return {
      menuLinks: [
        {
          name: "home",
          title: "Home",
        },
        {
          name: "blog",
          title: "Blog",
        },
        {
          name: "about",
          title: "About",
        },
      ]
    }
  }
}
</script>

<style>

</style>