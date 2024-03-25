<template>
    <div class="container">
        <div class="col-md-12">
            <select class="form-control" v-model="userSelect">
                <option v-for="user in users" :value="'action.' + user.id">{{
                    user.email+' '+user.id
                }}</option>
            </select>
        </div>

        <br />
        <textarea
            rows="6"
            style="width:500px"
            class="form-controll"
            v-model="textareaValue"
        >
        </textarea>
        {{ message2.join("\n") }}
        <div class="input-group-append">
            <button @click="sendMessage" class="btn btn-outline-secondary">
                отправить
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            message2: [],

            textareaValue: "",
            userSelect: []
        };
    },
    props: ["users", "user"],
    methods: {
        sendMessage: function(e) {
            //alert(this.user.id)
            if (!this.userSelect.length) {
                this.userSelect.push("action.");
            }
			
            axios({
                method: "post", //you can set what request you want to be
                url: "/privat-chat-ajax",
                data: {
                    channels: this.userSelect,
                    textarea: this.textareaValue,
                    user: this.user.email
                },

                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            }).then(response => {
                console.log(response);
                if (!this.userSelect.length) {
                    this.message2.push(this.user.email + ":" + this.message);
                }
                this.messagetext = "";
                //var socket=io('http://localhost:6001');

                //console.log(console.log(socket.connected));

                //console.log(response.data.textarea)
				  this.message2.push(
                    response.data.user + ": " + response.data.textarea
                );
                //this.message2 = response.data;
            });
        }
    },

    mounted() {
        var socket = io("http://localhost:3000");

        socket.on(
            "action." + this.user.id + ":privat",
            function(data) {
				
                //console.log(data.result);
                this.message2.push(
                    data.message.user + ": " + data.message.textarea
                );
            }.bind(this)
        );

        socket.on(
            "action.:App\\Events\\Privates",
            function(data) {
                //console.log(data.result);
                this.message2.push(
                    data.message.user + ": " + data.message.message
                );
            }.bind(this)
        );

        //this.sendMessage();
    }
};
</script>
