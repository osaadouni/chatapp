<template>

    <div class="chat-composer">
            <div class="input-group mb-3">

                <input type="text" class="form-control" placeholder="Enter your message..." aria-label="Chat message" aria-describedby="basic-addon2" v-model="messageText" @keyup.enter="sendMessage">

                <div class="input-group-append">

                    <button class="btn btn-primary" @click="sendMessage"> Send </button>

                </div>
            </div>
    </div>

</template>

<script>
    export default {
            
        data() {

            return { 
                messageText: '', 
                user: {}, 
                authenticated: false 
            }
        }, 

        mounted() {
            console.log('Component mounted.')
        }, 

        methods: {

            sendMessage()  
            {
                console.log(this.messageText);

                this.$emit('messagesent', { 
                        message: this.messageText, 
                        user: this.user
                    });
                this.messageText = '';
            }
        }, 

        created() {

            console.log('[ChatComposer] created()...');
            console.log(window.Laravel);

            if (typeof window.Laravel.user !== typeof undefined  && null !== window.Laravel.user)
            { 
                console.log(window.Laravel.user); 
                this.authenticated = true;
                this.user = window.Laravel.user;

            }

        }
    }
</script>

<style>
.chat-composer { 
        
    margin-top:20px;

}
</style>
