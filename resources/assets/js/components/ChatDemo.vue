<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">Chat Demo Component</div>

                    <div class="card-body">
                            
                        <chat-log :messages="messages"></chat-log>
                        <chat-composer @messagesent="addMessage"></chat-composer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

let ChatLog      = require('./ChatLog.vue');
let ChatComposer = require('./ChatComposer.vue');

    export default {

        data() { 

            return { 

                messages: [
                    
                ]
            }

        }, 

        mounted() {
            console.log('[ChatDemo] mounted.')

            //Echo.channel('chatroom')
            
            Echo.private('chatroom')
                .listen('ChatEvent', (e) => {
                    
                    console.log('[Echo.channel(chatroom)][ChatEvent]');
                    console.log(e);
                    console.log('=> message: '+ e.message);
                    console.log('=> user: '+ e.user.name);

                    // Add to existing messages
                    this.messages.push({ 
                        message: e.message.message, 
                        user:    e.user ,
                        created_at: e.message.created_at
                    });

                })
                .listenForWhisper('typing', (e) => {
                    //console.log(e.name);
                    if ( e.name !== '' ) {
                    console.log('typing...');
                    } else {
                        console.log('nothing..');
                    }
                });
            
        },

        created() { 
            console.log('[ChatDemo] created()...');

            this.getMessages();

            Echo.join('chatroom')
                .here((users) => { 
                    console.log('[Echo.join].here()..');
                    console.log(users);
                })
                .joining((user) => { 
                    console.log('[Echo.join].joining()...');
                    console.log(user);
                })
                .leaving((user) => { 
                    console.log('[Echo.join].leaving()...');
                    console.log(user.name);

                })
                .listen('ChatEvent', (e) => {
                    console.log('[Echo.join].listen(ChatEvent)..');
                    console.log(e);

                });
        },

        components: {
            'chat-log': ChatLog, 
            'chat-composer': ChatComposer   
        }, 

        methods: { 
        
            addMessage(message) { 
                console.log('addMessage() called');

                console.log(message);

                // Add to existing messages
                //this.messages.push(message);
                

                // presist to the database
                axios.post('/messages', message).then(response => { 
                        console.log(response);

                })
                .catch(error => { 
                    
                    console.log(error);
                });
            }, 

            getMessages() {

                console.log('getMessages()...');

                axios.get('/messages').then(response => { 
                    console.log(response.data);
                    this.messages = response.data;
                })
                .catch(error => {
                    console.log(error);  
                });
            }
        }
    }
</script>
