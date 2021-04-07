<template>
    <li class="list-group-item">
        <p>Author: <b>{{node.users.name}}</b>, {{node.users.email}}</p>
        <p v-text="node.comment_text" class="mb-2"></p>
        <div class="buttons d-flex flex-wrap">
            <button type="button" class="btn btn-primary btn-sm" @click="formVisible = !formVisible">Answer</button>
            <button type="button" class="btn btn-danger btn-sm ml-4" @click="deleteComment(node.id)">Delete</button>
        </div>
        <ul class="my-4" v-if="node.children && node.children.length">
            <node v-for="(child, index) in node.children" :node="child" :key="index"></node>
        </ul>
        <create-comment v-if="formVisible" class="my-4" @refreshList="getComments" :parent-id="node.id"></create-comment>
    </li>
</template>

<script>

import CreateComment from "./CreateComment";
export default {
    name: 'node',
    components:{CreateComment},
    props: {
        node: Array|Object
    },
    data: () => {
        return {
            formVisible:false
        }
    },
    created() {
        this.$eventBus.$on('refreshList', ()=>{
            this.formVisible = false
        });
    },
    methods: {
        getComments(){
            axios.get('api/comments')
                .then(resp => {
                    const {data} =  resp;
                    this.commentsData = data;
                })
                .catch(error => {
                    console.log( error.response );
                })
        },
        deleteComment(id){

            axios.delete(`api/comments/${id}`)
                .then(resp => {
                    this.$eventBus.$emit('refreshList');
                })
                .catch(error => {
                    console.log( error.response );
                })
        }
    }
}
</script>

<style scoped>

</style>
