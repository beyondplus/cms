<template>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-6">
      <div class="x_panel">
        <div class="x_title">
          <h2>Taxonomy <small>form tool</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newTaxonomy"><i class="fa fa-plus"></i></a>
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
                <input type="text" id="tax_name" v-model="taxonomy.tax_name" required="required" class="form-control col-md-7 col-xs-12" v-on:keyup="taxonomyPara">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Para <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="tax_link" v-model="taxonomy.tax_link" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea type="text" id="tax_desc" required="required" class="form-control col-md-7 col-xs-12 text-left" v-model="taxonomy.tax_desc">
                </textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Icon
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" v-model="taxonomy.tax_icon" class="form-control" placeholder="fa fa-cart-plus">
                <p class="help-block">Default not requied. <a href="http://fontawesome.io/icons/">Sample</a></p>
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Parent Name</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select v-model="taxonomy.parent_id" class="form-control">
                  <option value="0" >Choose the taxonomy</option>
                  <option v-for="option in allTaxonomy" v-bind:value="option.tax_id">
                    {{ option.tax_name }}
                  </option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Active<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" v-model="taxonomy.tax_active">
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
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnTaxonomy(0)" v-if="submit">Submit</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnTaxonomy(taxonomy.tax_id)" v-if="edit">Edit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Taxonomy Tables <small>total taxonomies  <span>{{ total }}</span></small></h2>
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
                <th>Parent Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(cat,key) in taxonomies">
                <th scope="row"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditTaxonomy(key)" >{{ key+1 }}</a></th>
                <td><a href="javascript:void(0)" name="Edit" v-on:click="btnEditTaxonomy(key)" >{{ cat.tax_name}}</a></td>
                <td width="30%"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditTaxonomy(key)" >{{ cat.parent_id | parentName }}</a></td>
                <td><a href="javascript:void(0)" name="Delete" v-on:click="btnDeleteTaxonomy(cat.tax_id)" ><i class="fa fa-close"></i></a></td>
              </tr>
            </tbody>
          </table>
          <div class="col-md-12 text-center">
            <a href="" onclick="return false" name="loadMore" v-on:click="loadMore('taxonomy')">Load More</a>
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
          allTaxonomy: [{tax_name:'', tax_id:''}],
          taxonomies: [ { tax_id: 1,tax_name: "",tax_name_mm: "",parent_id: 0,tax_link: "",tax_icon: "",tax_marker: "",
            tax_desc: "",count_view: 0,tax_lan: 1,tax_type: "tax",
            tax_active: "yes",created_at: ""}],
          taxonomy: { tax_id: 1,
                      tax_name: "",
                      tax_name_mm: "",
                      parent_id: 0,
                      tax_link: "",
                      tax_icon: "fa fa-list",
                      tax_marker: "",
                      tax_desc: " ",
                      count_view: 0,
                      tax_lan: "en",
                      tax_type: "tax",
                      tax_active: "yes",
                      tax_lan: 1,
                      created_at: ""
                      },
          f5Taxonomy : {tax_id: 1,tax_name: "",tax_name_mm: "",parent_id: 0,tax_link: "",tax_icon: "",tax_marker: "",
            tax_desc: "",count_view: 0,tax_lan: "en",tax_type: "tax",
            tax_active: "yes",tax_lan: 1,created_at: "" },
          perPage : 10,
          submit:true,
          edit: false,
          total: 1,
          image: ''
        }
    },
    methods: {
        newTaxonomy : function() {
          this.taxonomy = this.f5Taxonomy
        },
        search: function() {
            this.searchQuery = this.searchQuery.trim()
            if (this.searchQuery == "") {
                this.submit = true
                this.edit = false
                this.taxonomy = this.f5Taxonomy
                this.fetchTaxonomy()
            } else {
                this.searchTaxonomy()
            }
        },
        searchTaxonomy: function() {
            this.segUrl = '/taxonomy/search?bptax_name=' + this.searchQuery+'&per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
              if(response.length > 0){
                if (response.data.data.length == 1) {
                    this.perPage = 10
                    this.taxonomy = response.data.data[0]
                } else {
                    this.taxonomies = response.data.data
                }
              }
            }, (response) => {
                // error callback
            });

        },
        fetchTaxonomy: function() {
            this.segUrl = '/taxonomy?per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                this.total = response.data.total
                this.allTaxonomy = response.data.all
                this.taxonomies = response.data.data.data
            }, (response) => {
                // error callback
            });
        },
        btnTaxonomy: function(id) {
          var taxonomy = this.taxonomy
          this.taxonomy = this.f5Taxonomy 
            if(id == 0){
              this.segUrl = '/taxonomy' 
              this.$http.post(this.url+ this.segUrl, taxonomy).then((response) => {
                  this.fetchTaxonomy()
              }, (response) => {
                  // error callback
              });
            } else {
              this.segUrl = '/taxonomy/'+id 
              this.$http.patch(this.url+ this.segUrl, taxonomy).then((response) => {
                  this.fetchTaxonomy()
              }, (response) => {
                  // error callback
              }); 
            } 
            
                
            $("#tax_name").focus();
            this.total = this.total + 1;
        },
        btnEditTaxonomy: function(id){    
            this.submit = false
            this.edit = true      
            this.taxonomy = this.taxonomies[id];
        },
        btnDeleteTaxonomy: function(id){
            this.segUrl = '/taxonomy/'+id
            this.$http.delete(this.url+this.segUrl).then((response) => {
                this.fetchTaxonomy()
            }, (response) => {

            });
        },
        loadMore: function(filter){
            if(filter == 'taxonomy'){
                if(this.segUrl.search('taxonomy')> 0){
                  this.getPerPage()
                  this.fetchTaxonomy()
                } else {
                  this.perPage = 20
                  this.fetchTaxonomy()
                }
            }
        },
        getPerPage: function(){
          var array = this.segUrl.split('per_page=');
          this.perPage = parseInt(array[1]) + 10;
        },
        taxonomyPara: function() {
          this.taxonomy.tax_link = this.taxonomy.tax_name.replace(/[\. ,:-=]+/g, "-").toLowerCase()
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
        var x, parent_name;
        if(pos == 0) {
          parent_name = ''
          return parent_name;
        } else {
          parent_name = pos
        }
        // for (x in this.allTaxonomy) {
        //   if(this.allTaxonomy[x].tax_id == pos)
        //     parent_name = this.allTaxonomy[x].tax_name;
        // }
        return parent_name;
      }
    },
    mounted() {
       this.fetchTaxonomy()
    }
}

</script>
