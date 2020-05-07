<template>

    <div>
        <table class="table">
            <thead  class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">User ID</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <tr  v-for="(item, k) in todo_all">
                    <th scope="row">{{ item.id }}</th>
                    <td>{{ item.title }}</td>
                    <td>{{ item.content }}</td>
                    <td>{{ item.user_id }}</td>
                    <td> <button type="button" class="btn btn-info" v-b-modal.modal-1 @click="OpenEdit(item.id)" ref="btnShow">Edit</button> </td>
                    <td> <button type="button" class="btn btn-danger" @click="DeleteTodo(item.id)">Delete</button> </td>
                </tr>
            </tbody>
        </table>

        <div>
<!--            <b-button v-b-modal.modal-1>Launch demo modal</b-button>-->

            <b-modal id="modal-1" title="BootstrapVue">
                <p class="my-4">Edit To Do</p>
                <form >
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" required="required" v-model="edit_title">
                            <input type="hidden" class="form-control" placeholder="Name" required="required" v-model="edit_id">
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control" placeholder="Phone" required="required" v-model="edit_content"></textarea>
                        </div>
                    <button type="button"  @click="UpdateTodo(edit_id)"  class="btn btn-primary">Submit</button>
                </form>
            </b-modal>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Todos",
        data() {
            return {
                todo_all: [],
                todo_edit: [],

                edit_id: '',
                edit_title: '',
                edit_content: '',
            }
        },
        created() {
            this.getTodos();
            // console.log(this.all_cart)

        },
        methods: {
            getTodos(){
                axios.get('/todo',)
                    .then(response => {
                        if (response.status == 200){

                            this.todo_all = response.data.todo
                        console.log(response.data.todo)
                        }
                    })
                    .catch();
            },
            OpenEdit(id){

                console.log(id)
                axios.get(`/todo/${id}`,)
                    .then(response => {
                        if (response.status == 200){

                            this.todo_edit = response.data.todo

                            this.edit_id = response.data.todo[0].id
                            this.edit_title = response.data.todo[0].title
                            this.edit_content = response.data.todo[0].content
                            // this.$root.$emit('bv::show::modal', 'modal-1', '#btnShow')
                            // console.log(response.data.todo[0].title)


                        }
                    })
                    .catch();
            },
            UpdateTodo(id){

                    axios.put(`/todo/edit/${id}`, {
                        title: this.edit_title,
                        content: this.edit_content,
                    })
                        .then(response => {
                            if (response.status == 200) {

                                setTimeout(() => {
                                    this.edit_id =  '';
                                    this.edit_title = '';
                                    this.edit_content = '';

                                    this.getTodos()
                                    this.$root.$emit('bv::hide::modal', 'modal-1', '#btnShow')
                                }, 1000);

                            }
                        })
                        .catch();
            },
            DeleteTodo(id) {

                if (confirm('are you sure?')){
                    axios.delete(`/todo/delete/${id}`)
                        .then(response => {
                            if (response.status == 200) {
                                setTimeout(() => {
                                    this.getTodos()
                                    this.$root.$emit('bv::hide::modal', 'modal-1', '#btnShow')
                                }, 400);

                            }
                        })
                        .catch();
                }
            },
        }
    }
</script>

<style scoped>

</style>
