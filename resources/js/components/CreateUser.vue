<template>
    <div class="card mt-4">
        <div class="card-body">
            <h3><button class="btn btn-sm btn-outline-success mr-4" @click="$emit('view-dashboard')"><i class="fa fa-arrow-left"></i></button> hello world</h3>
            <div class="alert alert-warning" v-if="errors.length">
                <ul>
                    <li v-for="error in errors" :key="error" class="list-unstyled">{{ error }}</li>
                </ul>
            </div>
                <form>
                    <!-- <input type="hidden" name="_token" :value="csrf"> -->
                    <div class="form-group row">
                        <label class="col-3">Name</label>
                        <div class="col-9">
                            <input class="form-control" type="text" v-model="user.name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Email</label>
                        <div class="col-9">
                            <input class="form-control" type="email" v-model="user.email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Password</label>
                        <div class="col-9">
                            <input class="form-control" type="password" v-model="user.password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3">Role</label>
                        <div class="col-9">
                            <select v-model="selected">
                                <option>Admin</option>
                                <option>SuperUser</option>
                                <option>User</option>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-success" :disabled="disableBtn" @click.prevent="addUser">Create a User</button>
                </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
            },
            selected:'User',
            errors: [],
            disableBtn: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        addUser() {
            axios.post('/data/users', {
                name: this.user.name,
                email: this.user.email,
                password: this.user.password,
                role: this.selected
            }).then(
                response => this.$emit('created-user', 'Successfully created User ' + response.data.user.name)
            ).catch(errors => {
                if (errors.response.status === 422) {
                    this.flashError(errors.response.data.errors);
                }
                if (errors.response.status === 403) {
                    this.errors = ['You are not authorize to add users'];
                    this.disableBtn = true
                }
            })
            this.errors = [];
            this.clearInputs();
        },
        flashError(obj) {
            for(const [key, value] of Object.entries(obj)) {
                for (let item in value) {
                    this.errors.push(value[item])
                }
            }
        },
        clearInputs() {
            this.user.name = "";
            this.user.email = "";
            this.user.password = "";
        }
    }
}
</script>
