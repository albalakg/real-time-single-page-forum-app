<template>
  <div class="mt-2">
    <markdown-editor v-model="body"></markdown-editor>
    <v-btn color="green" dark @click="submit">Reply</v-btn>
  </div>
</template>

<script>
export default {
  props: ["questionSlug"],
  data() {
    return {
      body: null
    };
  },
  methods: {
    submit() {
      axios
        .post(`/api/question/${this.questionSlug}/reply`, { body: this.body })
        .then(res => {
          this.body = "";
          EventBus.$emit("newReply", res.data.reply);
          window.scrollTo(0, 100);
        });
    }
  }
};
</script>

<style>
</style>
