<template>

    <div class="chat-log">

            <chat-message v-for="message in messages" :message="message" :key="message.id"></chat-message>

            <div class="empty" v-show="messages.length === 0">
                Nothing here yet
            </div>

    </div>

</template>


<script>
let ChatMessage = require('./ChatMessage.vue');

    export default {

        props: ['messages'], 

        data() {

            return {
            }
        }, 
        mounted() {
            console.log('Component mounted.')
        },

        components: { 
            'chat-message': ChatMessage
        }
    }
</script>

<style>
.chat-log .chat-message {
    margin-top:20px;
}

.chat-log .chat-message:nth-child(even) {
    background-color:#eee;
}

.empty  {
    padding: 1rem;

    text-align: center;


}

</style>
