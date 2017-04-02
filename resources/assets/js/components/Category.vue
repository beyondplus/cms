<template>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="x_panel">
        <div class="x_title">
          <h2>Category <small>form tool</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newCategory"><i class="fa fa-plus"></i></a>
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
                <input type="text" id="category_name" v-model="category.category_name" required="required" class="form-control col-md-7 col-xs-12" v-on:keyup="categoryPara">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Para <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="category_link" v-model="category.category_link" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea type="text" id="category_desc" required="required" class="form-control col-md-7 col-xs-12 text-left" v-model="category.category_desc">
                </textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Icon
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" v-model="category.category_icon" class="form-control" placeholder="fa fa-cart-plus">
                <p class="help-block">Default not requied. <a href="http://fontawesome.io/icons/">Sample</a></p>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parent Name</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select v-model="category.parent_id" class="form-control">
                  <option value="0" >Choose the Category</option>
                  <option v-for="option in allCategory" v-bind:value="option.category_id">
                    {{ option.category_name }}
                  </option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Active<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" v-model="category.category_active">
                          <option value="">Choose option</option>
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnCategory(0)" v-if="submit">Submit</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnCategory(category.category_id)" v-if="edit">Edit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Category Tables <small>total categories  <span>{{ total }}</span></small></h2>
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
            <li>
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
                <th>Parent Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(cat, key) in categories">
                <th scope="row"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditCategory(key)" >{{ key+1 }}</a></th>
                <td><a href="javascript:void(0)" name="Edit" v-on:click="btnEditCategory(key)" >{{ cat.category_name}}</a></td>
                <td width="30%"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditCategory(key)" >{{ cat.parent_id | parentName }}</a></td>
                <td><a href="javascript:void(0)" name="Delete" v-on:click="btnDeleteCategory(cat.category_id)" ><i class="fa fa-close"></i></a></td>
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
          allCategory: [{category_name:'', category_id:''}],
          categories: [ { category_id: 1,category_name: "",category_name_mm: "",parent_id: 0,category_link: "",category_icon: "",category_marker: "",
            category_desc: "",count_view: 0,category_lan: "en",category_dash: 0,
            category_active: "yes",category_created: 0,created_at: ""}],
          category: { category_id: 1,
                      category_name: "",
                      category_name_mm: "",
                      parent_id: 0,
                      category_link: "",
                      category_icon: "fa fa-list",
                      category_marker: "",
                      category_desc: "",
                      count_view: 0,
                      category_lan: "en",
                      category_dash: 0,
                      category_active: "yes",
                      category_created: 0,
                      created_at: ""
                      },
          f5Category : {category_id: 1,category_name: "",category_name_mm: "",parent_id: 0,category_link: "",category_icon: "",category_marker: "",
            category_desc: "",count_view: 0,category_lan: "en",category_dash: 0,
            category_active: "yes",category_created: 0,created_at: "" },
          perPage : 10,
          submit:true,
          edit: false,
          total: 1,
          image: ''
        }
    },
    methods: {
        newCategory : function() {
          this.category = this.f5Category
        },
        search: function() {
            if (this.searchQuery == "") {
                this.submit = true
                this.edit = false
                this.category = this.f5Category
                this.fetchCategory()
            } else {
                this.searchCategory()
            }
        },
        searchCategory: function() {
            this.segUrl = '/category/search?bpcategory_name=' + this.searchQuery+'&per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
              if(response.data.data){
                if (response.data.data.length == 1) {
                    this.perPage = 10
                    this.category = response.data.data[0]
                } else {
                    this.categories = response.data.data
                } 
              }
               
            }, (response) => {
                // error callback
            });
        },
        fetchCategory: function() {
            this.segUrl = '/category?per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                this.total = response.data.total
                this.allCategory = response.data.all
                this.categories = response.data.data.data
            }, (response) => {
                // error callback
            });
        },
        btnCategory: function(id) {
          var category = this.category
          this.category = this.f5Category  
            if(id == 0){
              this.segUrl = '/category' 
              this.$http.post(this.url+ this.segUrl, category).then((response) => {
                  this.fetchCategory()
              }, (response) => {
                  // error callback
              });
            } else {
              this.segUrl = '/category/'+id 
              this.$http.patch(this.url+ this.segUrl, category).then((response) => {
                  this.fetchCategory()
              }, (response) => {
                  // error callback
              }); 
            }    
            $("#category_name").focus();
            this.total = this.total + 1;
        },
        btnEditCategory: function(id){    
            this.submit = false
            this.edit = true      
            this.category = this.categories[id];
        },
        btnDeleteCategory: function(id){
            this.segUrl = '/category/'+id
            this.$http.delete(this.url+this.segUrl).then((response) => {
                this.fetchCategory()
            }, (response) => {

            });
        },
        loadMore: function(filter){
            if(filter == 'category'){
                if(this.segUrl.search('category')> 0){
                  this.getPerPage()
                  this.fetchCategory()
                } else {
                  this.perPage = 20
                  this.fetchCategory()
                }
            }
        },
        getPerPage: function(){
          var array = this.segUrl.split('per_page=');
          this.perPage = parseInt(array[1]) + 10;
        },
        categoryPara: function() {
          this.category.category_link = this.category.category_name.replace(/[\. ,:-=]+/g, "-").toLowerCase()
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
        if(pos == 0) {
          parent_name = ''
        } else {
          parent_name = pos
          // for (x in this.allCategory) {
          //   if(this.allCategory[x].category_id == pos)
          //     parent_name = this.allCategory[x].category_name;
          // }   
        }
        
        return parent_name;
      }
    },
    mounted() {
       this.fetchCategory()
    }
}

</script>
