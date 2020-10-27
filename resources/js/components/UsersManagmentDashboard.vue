<template>
  <div>
      <div class="card mt-4" v-if="active.dashboard">
    <div class="card-body">
      <h2>
          Manage Users
        <button @click="setActive('createdUser')" class="btn-outline-success btn-sm float-right"><i class="fa fa-plus" aria-hidden="true"></i>
            Create User
        </button>
      </h2>

      <div class="alert alert-success" v-if="success_msg">
        {{ success_msg }}
      </div>

      <div class="alert alert-success" v-if="unauthorize_msg">
        {{ unauthorize_msg }}
      </div>

      <PaginatorDetails :results="results" v-if="results" />
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>User Since</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody v-if="results !== null">
          <tr v-for="(user, i) in results.data" :key="i">
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.user_since }}</td>
            <td>
              <div class="btn-group">
                <button class="btn btn-sm btn-warning mr-2">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </button>
                <button class="btn btn-sm btn-danger" @click="removeUser(user)">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <Paginator
        v-if="results"
        :results="results"
        @get-page="getPage"
      ></Paginator>
    </div>
  </div>
  <create-user v-if="active.createdUser"
               @view-dashboard="setActive('dashboard')"
               @created-user="renderSuccess"
               >
  </create-user>
  </div>
</template>

<script>
import Paginator from "../components/utilities/pagination/Paginator.vue";
import PaginatorDetails from "../components/utilities/pagination/PaginatorDetails.vue";
import CreateUser from "../components/CreateUser.vue";

export default {
  components: {
    Paginator,
    PaginatorDetails,
    CreateUser
  },
  data() {
    return {
      results: null,
      success_msg: "",
      unauthorize_msg: "",
      params: {
        page: 1,
      },
      active: {
          dashboard: true,
          createdUser: false
      }
    };
  },
  methods: {
    getUsers() {
      axios.get("/data/users", { params: this.params }).then((response) => {
        this.results = response.data.results;
      });
    },
    getPage(event) {
      this.params.page = event;
      window.scrollTo(0, 0);
      this.getUsers();
    },
    setActive(component) {
        Object.keys(this.active).forEach(key => this.active[key] = false);
        this.active[component] = true;
    },
    renderSuccess(event) {
      this.setActive('dashboard');
      this.success_msg = event;
      this.getUsers();
      this.removeSuccessMsg(event)
    },
    removeSuccessMsg(msg) {
      this.success_msg = msg;
      setTimeout(() => {
        this.success_msg = null
      }, 4500);
    },
    removeUnauthorizeMsg(msg) {
      this.unauthorize_msg = msg;
      setTimeout(() => {
        this.unauthorize_msg = null
      }, 4500);
    },
    removeUser(user) {
        let checkDeletion = confirm('Do you actually want to Delete ' + user.name);
        if (checkDeletion) {
            axios.post('/data/users/' + user.id, {_method: 'DELETE'}).then(response =>
                console.log(response.data)
            ).catch(error => {
                if (error.response.status === 403) {
                    this.removeUnauthorizeMsg('Unauthorized To Delete Users');
                }
            })
        }
    }
  },
  mounted() {
    this.getUsers();
  },
};
</script>
