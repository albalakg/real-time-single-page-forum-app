<template>
  <div v-if="question">
    <edit-question v-if="editing" :data="question"></edit-question>
    <show-question v-else :data="question"/>
    <v-container>
      <replies :question="question"></replies>
      <new-reply v-if="loggedIn" :questionSlug="question.slug"></new-reply>
      <div v-else class="mt-3">
        <router-link to="/login">Login to reply</router-link>
      </div>
    </v-container>
  </div>
</template>

<script>
import ShowQuestion from "./ShowQuestion";
import EditQuestion from "./editQuestion";
import Replies from "../reply/replies";
import NewReply from "../reply/newReply";
export default {
  components: { ShowQuestion, EditQuestion, Replies, NewReply },
  data() {
    return {
      question: null,
      editing: false
    };
  },
  computed: {
    loggedIn() {
      return User.loggedIn();
    }
  },
  created() {
    this.listen();
    this.getQuestion();
  },
  methods: {
    listen() {
      EventBus.$on("strartEditing", () => {
        this.editing = true;
      });

      EventBus.$on("cancelEditing", () => {
        this.editing = false;
      });
    },
    getQuestion() {
      axios
        .get(`/api/question/${this.$route.params.slug}`)
        .then(res => (this.question = res.data.data));
    }
  }
};
</script>

<style>
</style>
