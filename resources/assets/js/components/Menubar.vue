<template>
  <div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Page</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="storePage"><i class="fa fa-plus"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="x_content warp_box">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal" method="post">
              <ul  class="list-unstyled">
                <li v-for="c in pages">
                  <input type="checkbox" v-model="selectedPage" :value="c.id" number>
                  {{ c.title }}
                </li>
              </ul>
            </form>
          </div>

        </div>
      </div>

      <div class="x_panel">
        <div class="x_title">
          <h2>Post</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="storePost"><i class="fa fa-plus"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="x_content warp_box">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal" method="post">
              <ul  class="list-unstyled">
                <li v-for="c in posts">
                  <input type="checkbox" v-model="selectedPost" :value="c.id" number>
                  {{ c.title }}
                </li>
              </ul>
            </form>
          </div>

        </div>
      </div>
      
    </div>

    <div class="col-md-8 col-sm-12 col-xs-12" v-if="menuDetail == 1">
      <div class="x_panel">
        <div class="x_title">
          <h2>Menu <small>form tool</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newMenu"><i class="fa fa-plus"></i></a>
            </li>
            <li><a class="close-link" v-on:click="close-menu"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />

    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Name <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="menu_name" v-model="menu.menu_name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Custom Link<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="menu_link" v-model="menu.menu_link" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Icon
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" v-model="menu.menu_icon" class="form-control" placeholder="fa fa-cart-plus">
                <p class="help-block">Default not requied. <a href="http://fontawesome.io/icons/">Sample</a></p>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Menu Type</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select v-model="menu.menu_type" class="form-control" >
                  <option value="default">Choose Menu Type</option>
                  <option value="custom">Custom</option>
                  <option value="template">Template</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parent</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select v-model="menu.parent_id" class="form-control" >
                  <option value="1">Choose the parent menu</option>
                  <option v-for="option in menus" v-bind:value="option.menu_id">
                    {{ option.menu_name }}
                  </option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Description <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea type="text" id="menu_desc" required="required" class="form-control col-md-7 col-xs-12 text-left" v-model="menu.menu_desc">
                </textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnMenu(0)" v-if="submit">Submit</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnMenu(menu.menu_id)" v-if="edit">Edit</button>
              </div>
            </div>

          </form>
          </div>
      </div>
    </div>

    <div class="col-md-8 col-sm-12 col-xs-12" v-if="menuDetail == 2">
      <div class="x_panel">
        <div class="x_title">
          <h2>Menu <small>form tool</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newMenu"><i class="fa fa-plus"></i></a>
            </li>
            <li><a class="close-link" v-on:click="closeMenu"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Name <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="menu_name" v-model="menu.menu_name" required="required" class="form-control col-md-7 col-xs-12" v-on:keyup="menuPara">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Para <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="menu_link" v-model="menu.menu_link" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Icon
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" v-model="menu.menu_icon" class="form-control" placeholder="fa fa-cart-plus">
                <p class="help-block">Default not requied. <a href="http://fontawesome.io/icons/">Sample</a></p>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parent</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select v-model="menu.parent_id" class="form-control" >
                  <option value="1">Choose the parent menu</option>
                  <option v-for="option in menus" v-bind:value="option.menu_id">
                    {{ option.menu_name }}
                  </option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Description <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea type="text" id="menu_desc" required="required" class="form-control col-md-7 col-xs-12 text-left" v-model="menu.menu_desc">
                </textarea>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnMenu(menu.menu_id)" v-if="edit">Edit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-md-8 col-sm-12 col-xs-12" v-if="menuDetail == 3">
      <div class="x_panel">
        <div class="x_title">
          <h2>Menu Tables <small>total menu </small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newMenu"><i class="fa fa-plus"></i></a>
            </li>
            <li><a class="close-link" v-on:click="closeMenu"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Parent Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(m, key) in menus">
                <th scope="row"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditMenu(key , m.menu_type)" >{{ key+1 }}</a></th>
                <td><a href="javascript:void(0)" name="Edit" v-on:click="btnEditMenu(key, m.menu_type)" >{{ m.menu_name}}</a></td>
                <td width="30%"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditMenu(key, m.menu_type)" >{{ m.parent_id | parentName }}</a></td>
                <td><a href="javascript:void(0)" name="Delete" v-on:click="btnDeleteMenu(m.menu_id)" ><i class="fa fa-close"></i></a></td>
              </tr>
            </tbody>
          </table>
          <div class="col-md-12 text-center">
            <a href="" onclick="return false" name="loadMore" v-on:click="loadMore('menu')">Load More</a>
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
          selectedPage: [],
          selectedPost: [],
          pages: [{id: 0,title: ""}],
          posts: [{id: 0,title: ""}],
          menus: [ {     menu_id: 0,
                        menu_name: "",
                        menu_link: "",
                        post_id: 0,
                        layouts: "",
                        menu_weight: 0,
                        menu_icon: "",
                        parent_id: 0,
                        menu_type: "default",
                        menu_created: 0
                      }],
          menu: {       menu_id: 0,
                        menu_name: "",
                        menu_link: "",
                        post_id: 0,
                        layouts: "",
                        menu_weight: 0,
                        menu_icon: "",
                        parent_id: 0,
                        menu_type: "default",
                        menu_created: 0
                      },
          f5menu: {     menu_id: 0,
                        menu_name: "",
                        menu_link: "",
                        post_id: 0,
                        layouts: "",
                        menu_weight: 0,
                        menu_icon: "",
                        parent_id: 0,
                        menu_type: "default",
                        menu_created: 0
                      },
          menuDetail : 3,
          perPage : 10,
          submit:true,
          edit: false,
          image: ''
        }
    },
    methods: {
        newMenu : function() {
          this.menu = this.f5menu
          this.menuDetail = 1
        },
        fetchMenu: function() {
            this.segUrl = '/menu?per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                this.posts = response.data.posts
                this.pages = response.data.pages
                this.menus =  response.data.menu
            }, (response) => {
                // error callback
            });
        },
        btnMenu: function(id) {
          var menu = this.menu  
            if(id == 0){
              this.segUrl = '/menu' 
              this.$http.post(this.url+ this.segUrl, menu).then((response) => {
                  this.menu = this.f5Menu 
                  this.menuDetail = 3
                  this.fetchMenu()
              }, (response) => {
                  // error callback
              });
            } else {
              this.segUrl = '/menu/'+id 
              this.$http.patch(this.url+ this.segUrl, menu).then((response) => {
                  this.menu = this.f5Menu 
                  this.menuDetail = 3
                  this.fetchMenu()
              }, (response) => {
                  // error callback
              }); 
            }    
            $("#menu_name").focus();
        },
        btnEditMenu: function(id, menu_type){  
          if(menu_type == 'default') {
            this.menuDetail = 2  
          } else {
            this.menuDetail = 1  
          }
          this.submit = false
          this.edit = true      
          this.menu = this.menus[id]
        },
        btnDeleteMenu: function(id){
          this.menuDetail = 3
          this.segUrl = '/menu/'+id
          this.$http.delete(this.url+this.segUrl).then((response) => {
            this.fetchMenu()
          }, (response) => {

          });
        },
        storePage: function(){
          this.segUrl = '/menu/pagestore'
          var input = { pages : this.selectedPage }
          this.$http.post(this.url+ this.segUrl, input).then((response) => {
            this.fetchMenu()
          }, (response) => {


          });
        },
        storePost: function(){
          this.segUrl = '/menu/poststore'
          var input = { pages : this.selectedPost }
          this.$http.post(this.url+ this.segUrl, input).then((response) => {
            this.fetchMenu()
          }, (response) => {


          });
        },
        loadMore: function(filter){
            if(filter == 'menu'){
                if(this.segUrl.search('menu')> 0){
                  this.getPerPage()
                  this.fetchMenu()
                } else {
                  this.perPage = 20
                  this.fetchMenu()
                }
            }
        },
        getPerPage: function(){
          var array = this.segUrl.split('per_page=');
          this.perPage = parseInt(array[1]) + 10;
        },
        menuPara: function() {
          this.menu.menu_link = this.menu.menu_name.replace(/[\. ,:-=]+/g, "-").toLowerCase()
        },
        closeMenu: function() {
          this.menuDetail = 3
          this.fetchMenu()
        }
    },
    filters: {
      stringLimit: function(str) {
          if(str.length > 10){
            return str.substring(0,10)+'...';
          }else {
            return str;
          }
      },
     parentName: function(pos) {
        var x, parent_name;
        if(pos <= 1) {
          parent_name = ''
        } else {
          parent_name = pos
        } 
        //else {
        //   for (x in this.menus) {
        //     if(this.menus[x].menu_id == pos){
        //       parent_name = this.menus[x].menu_name;
        //     }
        //   }   
        // }
       
        return parent_name;
      }
    },
    mounted() {
      this.fetchMenu()
    }
}

</script>
