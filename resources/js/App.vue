<template>
    <div class="container">
        <h1>Some post name</h1>
        <div class="content">
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
        </div>
        <comments></comments>
    </div>
</template>

<script>

import Comments from "./components/Comments/Comments";
export default {
    components:{Comments},
    name: "App"
}
</script>

<style scoped>

</style>
