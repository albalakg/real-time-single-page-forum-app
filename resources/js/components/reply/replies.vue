<template>
  <div>
    <reply
      v-if="question"
      v-for="(reply, index) in content"
      :data="reply"
      :key="reply.id"
      :index="index"
    ></reply>
  </div>
</template>

<script>
import Reply from "./reply";
export default {
  props: ["question"],
  data() {
    return {
      content: this.question.replies
    };
  },
  components: { Reply },
  created() {
    this.listen();
  },
  methods: {
    listen() {
      EventBus.$on("newReply", reply => {
        this.content.unshift(reply);
      });
      //##Faster##
      EventBus.$on("deleteReply", index => {
        let item = this.content[index].id;
        this.content.splice(index, 1);
        axios.delete(`/api/question/${this.question.slug}/reply/${item}`);
      });
      //##Safer##
      // EventBus.$on("deleteReply", index => {
      //   axios
      //     .delete(
      //       `/api/question/${this.question.slug}/reply/${
      //         this.content[index].id
      //       }`
      //     )
      //     .then(res => {
      //       this.content.splice(index, 1);
      //     });
      // });

      Echo.private("App.User." + User.id()).notification(notification => {
        this.content.unshift(notification.reply);
      });

      Echo.channel("deleteReplyChannel").listen("DeleteReplyEvent", e => {
        for (let index = 0; index < this.content.length; index++) {
          if (this.content[index].id == e.id) {
            this.content.splice(index, 1);
          }
        }
      });
    }
  }
};
</script>

<style>
</style>
