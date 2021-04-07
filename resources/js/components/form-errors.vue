<template>
    <section>
        <div v-if="errorsList">
            <p class="alert alert-danger" v-for="(error, index) in errorsList" :key="index">{{error}}</p>
        </div>
    </section>
</template>

<script>
export default {
    name: "form-errors",
    props: {
        errors:{
            type: Object,
            default: () => {{}}
        }
    },
    computed:{
        errorsList(){
            return this.errors ? Object.values(this.errors).map((item) => {
                return item[0]
            }) : []
        }
    }
}
</script>

<style scoped>

</style>
