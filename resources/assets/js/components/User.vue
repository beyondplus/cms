<template>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="x_panel">
        <div class="x_title">
          <h2>User <small>form tool</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newUser"><i class="fa fa-plus"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="name" v-model="user.name" required="required" class="form-control col-md-7 col-xs-12" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="email" v-model="user.email" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Type<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" v-model="user.user_type" placeholer="Choose option">
                          <option value="0">User</option>
                          <option value="1">Moderator</option>
                          <option value="2">Admin</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="password" v-model="user.password" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnUser(0)" v-if="submit">Submit</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnUser(user.id)" v-if="edit">Edit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>User Tables <small>total users  <span>{{ total }}</span></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." v-model="searchQuery" v-on:keyup="search" autocomplete="off">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(value, key) in users">
                <th scope="row"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditUser(key)" >{{ key+1 }}</a></th>
                <td><a href="javascript:void(0)" name="Edit" v-on:click="btnEditUser(key)" >{{ value.name}}</a></td>
                <td width="30%"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditUser(key)" >{{ value.user_type }}</a></td>
                <td><a href="javascript:void(0)" name="Delete" v-on:click="btnDeleteUser(value.id)" ><i class="fa fa-close"></i></a></td>
              </tr>
            </tbody>
          </table>
          <div class="col-md-12 text-center">
            <a href="" onclick="return false" name="loadMore" v-on:click="loadMore('category')">Load More</a>
          </div>

        </div>
      </div>
    </div>


  </div>

</template>

<script>

export default {
  props: ['page','url'],
  data(){
      return {
          segUrl : '',
          searchQuery: '',
          users: [ {
                      id: 0,
                      name: "",
                      email: "",
                      user_type: 0,
                      api_token: "",
                      phone_no: "",
                      avatar: "",
                      created_at: ""
          } ],
          user: { 
                      id: 0,
                      name: "",
                      email: "",
                      user_type: 0,
                      api_token: "",
                      phone_no: "",
                      avatar: "",
                      created_at: ""
                      },
          f5User: { 
                      id: 0,
                      name: "",
                      email: "",
                      user_type: 0,
                      api_token: "",
                      phone_no: "",
                      avatar: "",
                      created_at: ""
                      },
          perPage : 10,
          submit:true,
          edit: false,
          total: 1,
          image: ''
        }
    },
    methods: {
        newUser : function() {
          this.user = this.f5User
        },
        search: function() {
            //this.searchQuery = this.searchQuery.trim()
            if (this.searchQuery == "") {
                this.submit = true
                this.edit = false
                this.user = this.f5User
                this.fetchUser()
            } else {
                this.searchUser()
            }
        },
        searchUser: function() {
            this.segUrl = '/user/search?bpcategory_name=' + this.searchQuery+'&per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
              if(response.data.data){
                if (response.data.data.length == 1) {
                    this.perPage = 10
                    this.user = response.data.data[0]
                } else {
                    this.users = response.data.data
                } 
              }
               
            }, (response) => {
                // error callback
            });
        },
        fetchUser: function() {
            this.segUrl = '/user?per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                this.total = response.data.total
                this.users = response.data.data.data
            }, (response) => {
                // error callback
            });
        },
        btnUser: function(id) {
          var user = this.user
          this.user = this.f5User  
            if(id == 0){
              this.segUrl = '/user' 
              this.$http.post(this.url+ this.segUrl, user).then((response) => {
                  this.fetchUser()
              }, (response) => {
                  // error callback
              });
            } else {
              this.segUrl = '/user/'+id 
              this.$http.patch(this.url+ this.segUrl, user).then((response) => {
                  this.fetchUser()
              }, (response) => {
                  // error callback
              }); 
            }    
            $("#name").focus();
            this.total = this.total + 1;
        },
        btnEditUser: function(id){    
            this.submit = false
            this.edit = true      
            this.user = this.users[id];
        },
        btnDeleteUser: function(id){
            this.segUrl = '/user/'+id
            this.$http.delete(this.url+this.segUrl).then((response) => {
                this.fetchUser()
            }, (response) => {

            });
        },
        loadMore: function(filter){
            if(filter == 'user'){
                if(this.segUrl.search('user')> 0){
                  this.getPerPage()
                  this.fetchUser()
                } else {
                  this.perPage = 20
                  this.fetchUser()
                }
            }
        },
        getPerPage: function(){
          var array = this.segUrl.split('per_page=');
          this.perPage = parseInt(array[1]) + 10;
        }
    },
    filters: {
      stringLimit: function(str) {
          if(str.length > 10){
            return str.substring(0,10)+'...';
          }else {
            return str;
          }
      }
      // parentName: function(pos) {
      //   var x, parent_name;
      //   if(pos == 0) {
      //     parent_name = ''
      //   } else {
      //     for (x in this.allUser) {
      //       if(this.allUser[x].category_id == pos)
      //         parent_name = this.allUser[x].category_name;
      //     }   
      //   }
       
      //   return parent_name;
      // }
    },
    mounted() {
       this.fetchUser()
    }
}

</script>
