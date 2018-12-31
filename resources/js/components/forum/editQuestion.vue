<template>
  <v-container>
    <v-form @submit.prevent="update">
      <v-text-field v-model="form.title" label="title" type="text" required></v-text-field>
      <markdown-editor v-model="form.body"></markdown-editor>
      <v-card-actions>
        <v-btn color="green" small type="submit">
          <p style="color:white;margin-top:5px;" color="white">save</p>
        </v-btn>
        <v-btn color="red" small @click="cancel">
          <p style="color:white;margin-top:5px;" color="white">cancel</p>
        </v-btn>
      </v-card-actions>
    </v-form>
  </v-container>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      form: {
        title: null,
        body: null
      }
    };
  },
  created() {
    this.form = this.data;
  },
  methods: {
    cancel() {
      EventBus.$emit("cancelEditing");
    },
    update(){
      axios.patch(`/api/question/${this.form.slug}`, this.form)
           .then(res => this.cancel())     
    }
  }
};
</script>

<style>
</style>
