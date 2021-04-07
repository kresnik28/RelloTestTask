<template>
    <section>
        <h1>Comments</h1>
        <create-comment class="main-comment-form"></create-comment>
        <ul class="list-group mt-4">
            <comment-node v-for="(parentNode, index) in commentsData" :node="parentNode" :key="index"></comment-node>
        </ul>
    </section>
</template>

<script>

import CreateComment from "./CreateComment";
import CommentNode from "./CommentNode";

export default {
    name: "CommentsTree",
    components: {CreateComment, CommentNode},
    data: () => {
        return {
            commentsData: []
        }
    },
    created() {
        this.getComments();
        this.$eventBus.$on('refreshList', () => {
            this.getComments()
        });
    },
    methods: {
        getComments() {
            axios.get('api/comments')
                .then(resp => {
                    const {data} = resp;
                    this.commentsData = data;
                })
                .catch(error => {
                    console.log(error.response);
                })
        },

        deleteComment(id) {
            axios.delete(`api/comments/${id}`)
                .then(resp => {
                    console.log(resp);
                })
                .catch(error => {
                    console.log(error.response);
                })
        }
    }
}
</script>

<style lang="css" scoped>
.main-comment-form {
    position: sticky;
    top: 0;
    padding: 2rem;
    z-index: 2;
    background: #fff;
    border: 1px solid #eaeaea;
    border-radius: 9px;
}
</style>
