<template>
    <div class="card chatbox-container">
        <div class="card-header">
            Chatbox
        </div>
        <div class="card-body chat-messages">
            <div class="message mb-2" v-for="message in messages" :key="message.id">
                <strong class="sender">{{ message.sender }}:</strong>
                <span class="text">{{ message.text }}</span>
            </div>
        </div>
        <div class="card-footer chat-input">
            <div class="input-group">
                <input type="text" class="form-control" v-model="newMessage" placeholder="Type a message..."/>
                <div class="input-group-append">
                    <button class="btn btn-primary" @click="sendMessage">Send</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newMessage: '',
            messages: [],
        };
    },
    methods: {
        sendMessage() {
            this.messages.push({sender: 'Me', text: this.newMessage, id: Date.now()});
            this.newMessage = '';
        },
    },
};
</script>

<style scoped>
.chatbox-container {
    border: 1px solid #ccc;
    height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.chat-messages {
    overflow-y: auto;
    flex-grow: 1;
    padding: 10px;
}

.chat-input {
    display: flex;
    padding: 10px;
}

.message {
    margin: 5px 0;
}

.sender {
    font-weight: bold;
}
</style>
