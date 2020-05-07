<template>

    <div>
        <form >
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" required="required" v-model="name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Phone" required="required" v-model="phone">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Enter email" required="required" v-model="email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control"  placeholder="Password" required="required" v-model="password">
            </div>
            <button type="submit" @click="UpdateUser" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        name: "User",
        data() {
            return {
                name: '',
                phone: '',
                email: '',
                password: '',
            }
        },
        created() {
            this.getCurrentUser();
            // console.log(this.all_cart)

        },
        methods: {
            getCurrentUser(){
                let self = this
                axios.get('/user',)
                    .then(response => {
                        if (response.status == 200){

                            this.name = response.data.user.name
                            this.phone = response.data.user.phone
                            this.email = response.data.user.email

                        }
                        console.log(response.data.user.name)
                    })
                    .catch();
            },
            UpdateUser(){

                // console.log(e)
                console.log(typeof this.password)
                // let self = this

                if (this.password != "" && this.password !== null) {
                    axios.post('/user', {
                        name: this.name,
                        phone: this.phone,
                        email: this.email,
                        password: this.password,
                    })
                        .then(response => {
                            if (response.status == 200) {

                                setTimeout(() => {
                                    this.getCurrentUser()
                                }, 1000);

                            }
                        })
                        .catch();
                } else {
                    alert("заполните поле password");
                }
            },
        }
    }
</script>

<style scoped>

</style>
