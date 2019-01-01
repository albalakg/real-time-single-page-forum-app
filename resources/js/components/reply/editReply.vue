<template>
  <div>
    <markdown-editor v-model="reply.reply"></markdown-editor>
    <v-card-actions>
      <v-btn color="green" dark @click="update">update</v-btn>
      <v-btn color="red" dark @click="cancel">cancel</v-btn>
    </v-card-actions>
  </div>
</template>

<script>
export default {
  props: ["reply"],
  methods: {
    update() {
      axios
        .patch(
          `/api/question/${this.reply.question_slug}/reply/${this.reply.id}`,
          { body: this.reply.reply }
        )
        .then(res => this.cancel());
    },
    cancel() {
      EventBus.$emit("cancelEditing");
    }
  }
};
</script>

<style>
</style>
