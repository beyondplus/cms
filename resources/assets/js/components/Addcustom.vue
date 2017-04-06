<template>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="x_panel">
        <div class="x_title">
          <h2>Custom <small>form tool</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newCustom"><i class="fa fa-plus"></i></a>
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
                <input type="text" id="name" v-model="custom.custom_name" required="required" class="form-control col-md-7 col-xs-12" >
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Link <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="email" v-model="custom.custom_link" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Blade <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="email" v-model="custom.custom_blade" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Weight <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="password" v-model="custom.custom_weight" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnCustom(0)" v-if="submit">Submit</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnCustom(custom.custom_id)" v-if="edit">Edit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Custom Tables <small>total customs  <span>{{ total }}</span></small></h2>
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
                <th>Blade</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(value, key) in customs">
                <th scope="row"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditCustom(key)" >{{ key+1 }}</a></th>
                <td><a href="javascript:void(0)" name="Edit" v-on:click="btnEditCustom(key)" >{{ value.custom_name}}</a></td>
                <td width="30%"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditCustom(key)" >{{ value.custom_blade }}</a></td>
                <td><a href="javascript:void(0)" name="Delete" v-on:click="btnDeleteCustom(value.custom_id)" ><i class="fa fa-close"></i></a></td>
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
          customs: [ {
                      custom_id: 0,
                      custom_name: "",
                      custom_link: "",
                      custom_blade: "",
                      custom_weight: 0,
                      custom_icon: "",
                      parent_id: 0,
                      staff_id: 0,
                      created_at: ""
          } ],
          custom: { 
                      custom_id: 0,
                      custom_name: "",
                      custom_link: "",
                      custom_blade: "",
                      custom_weight: 0,
                      custom_icon: "",
                      parent_id: 0,
                      staff_id: 0
                      },
          f5Custom: { 
                      custom_id: 0,
                      custom_name: "",
                      custom_link: "",
                      custom_blade: "",
                      custom_weight: 0,
                      custom_icon: "",
                      parent_id: 0,
                      staff_id: 0
                      },
          perPage : 10,
          submit:true,
          edit: false,
          total: 1,
          image: ''
        }
    },
    methods: {
        newCustom : function() {
          this.custom = this.f5Custom
        },
        search: function() {
            //this.searchQuery = this.searchQuery.trim()
            if (this.searchQuery == "") {
                this.submit = true
                this.edit = false
                this.custom = this.f5Custom
                this.fetchCustom()
            } else {
                this.searchCustom()
            }
        },
        searchCustom: function() {
            this.segUrl = '/custom/search?bpcustom_name=' + this.searchQuery+'&per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
              if(response.data.data){
                if (response.data.data.length == 1) {
                    this.perPage = 10
                    this.custom = response.data.data[0]
                } else {
                    this.customs = response.data.data
                } 
              }
               
            }, (response) => {
                // error callback
            });
        },
        fetchCustom: function() {
            this.segUrl = '/custom?per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                this.total = response.data.total
                this.customs = response.data.data.data
            }, (response) => {
                // error callback
            });
        },
        btnCustom: function(id) {
          var custom = this.custom
          this.custom = this.f5Custom  
            if(id == 0){
              this.segUrl = '/custom' 
              this.$http.post(this.url+ this.segUrl, custom).then((response) => {
                  this.fetchCustom()
              }, (response) => {
                  // error callback
              });
            } else {
              this.segUrl = '/custom/'+id 
              this.$http.patch(this.url+ this.segUrl, custom).then((response) => {
                  this.fetchCustom()
              }, (response) => {
                  // error callback
              }); 
            }    
            $("#name").focus();
            this.total = this.total + 1;
        },
        btnEditCustom: function(id){    
            this.submit = false
            this.edit = true      
            this.custom = this.customs[id];
        },
        btnDeleteCustom: function(id){
            this.segUrl = '/custom/'+id
            this.$http.delete(this.url+this.segUrl).then((response) => {
                this.fetchCustom()
            }, (response) => {

            });
        },
        loadMore: function(filter){
            if(filter == 'custom'){
                if(this.segUrl.search('custom')> 0){
                  this.getPerPage()
                  this.fetchCustom()
                } else {
                  this.perPage = 20
                  this.fetchCustom()
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
      //     for (x in this.allCustom) {
      //       if(this.allUser[x].category_id == pos)
      //         parent_name = this.allUser[x].category_name;
      //     }   
      //   }
       
      //   return parent_name;
      // }
    },
    mounted() {
       this.fetchCustom()
    }
}

</script>
