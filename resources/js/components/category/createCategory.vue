<template>
  <v-container>
    <v-form @submit.prevent="submit">
      <v-text-field v-model="form.name" label="Category Name" type="text" required></v-text-field>
      <v-btn v-if="editSlug" type="submit" color="orange">
        <span style="color:white">update</span>
      </v-btn>
      <v-btn v-else type="submit" color="green">
        <span style="color:white">create</span>
      </v-btn>
    </v-form>
    <v-card>
      <v-toolbar color="indigo" dark dense class="mt-5">
        <v-toolbar-title>Categories</v-toolbar-title>
      </v-toolbar>
      <v-list>
        <div v-for="(category, index) in categories" :key="category.id">
          <v-list-tile>
            <v-list-tile-action>
              <v-btn icon small @click="edit(category.slug, index)">
                <v-icon color="green">edit</v-icon>
              </v-btn>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{category.name}}</v-list-tile-title>
            </v-list-tile-content>
            <v-list-tile-action>
              <v-btn icon small @click="destroy(category.slug, index)">
                <v-icon color="red">delete</v-icon>
              </v-btn>
            </v-list-tile-action>
          </v-list-tile>
          <v-divider></v-divider>
        </div>
      </v-list>
    </v-card>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: null
      },
      categories: {},
      editSlug: null
    };
  },
  created() {
    if (!User.admin()) {
      this.$router.push("/forum");
    }
    axios.get("/api/category").then(res => (this.categories = res.data.data));
  },
  methods: {
    submit() {
      this.editSlug ? this.update() : this.create();
    },
    create() {
      axios.post("/api/category", this.form).then(res => {
        this.categories.unshift(res.data);
        this.form.name = null;
      });
    },
    update() {
      axios.patch(`/api/category/${this.editSlug}`, this.form).then(res => {
        this.categories.unshift(res.data);
        this.form.name = null;
      });
    },
    destroy(slug, index) {
      axios
        .delete(`/api/category/${slug}`)
        .then(res => this.categories.splice(index, 1));
    },
    edit(slug, index) {
      this.form.name = this.categories[index].name;
      this.editSlug = this.categories[index].slug;
      this.categories.splice(index, 1);
    }
  }
};
</script>

<style>
</style>
