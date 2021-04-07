<template>
    <div class="container">
        <form-errors v-if="errors" :errors="errors"></form-errors>
        <div class="form-group">
            <input type="text" v-model="user.name" placeholder="User name"/>
        </div>
        <div class="form-group">
            <input type="email" v-model="user.email" placeholder="User email"/>
        </div>
        <div class="form-group">
            <label for="comment_text">Comment text:</label>
            <textarea class="form-control" id="comment_text" v-model="comment.commentText"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-info" @click="createComment">Send</button>
        </div>
    </div>
</template>

<script>

import FormErrors from '../form-errors'

const ERRORS_TIMEOUT = 2000;

export default {
    name: "CreateComment",
    components: {FormErrors},
    props: {
        parentId: {
            type: Number,
            default: 0
        }
    },
    data: () => {
        return {
            errors: null,
            user: {
                name: '',
                email: ''
            },
            comment: {
                commentText: '',
            }
        }
    },
    methods: {
        createComment() {
            const commentBody = {user: this.user, comment: this.comment, ...{parentId: this.parentId}};
            axios.post('api/comments', commentBody)
                .then(resp => {
                    this.$eventBus.$emit('refreshList');
                    this.resetForm()
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                    setTimeout(() => {
                        this.errors = null
                    }, ERRORS_TIMEOUT)
                })
        },
        resetForm() {
            this.user.name = ''
            this.user.email = ''
            this.comment.commentText = ''
        }
    }
}
</script>

<style scoped>

</style>
