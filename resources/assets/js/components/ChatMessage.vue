<template>
    <div class="chat-message">
        <p>{{ message.message }} </p>
        <small> {{ message.user.name }} [ {{ message.created_at }}] </small>
    </div>
</template>

<script>
    export default {
        props: ['message'] ,

        data() { 
            return {
            }
        }, 
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
