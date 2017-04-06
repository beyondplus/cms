<template>
  <div class="row">
    <div class="col-md-8 col-sm-8 col-xs-12" v-if="postDetail">
      <div class="x_panel">
        <div class="x_title">
          <h2>Post <small>form tool</small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newPost"><i class="fa fa-plus"></i></a>
            </li>
            <li><a  class="close-link" v-on:click="fetchPost"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post">

            <div class="form-group">
              <label class="col-md-12 col-sm-12 col-xs-12" >Title
              </label>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" id="title" v-model="post.title" required="required" class="form-control col-md-7 col-xs-12" v-on:keyup="postPara">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-md-12 col-sm-12 col-xs-12" >
                <a :href="base+'/'+post.post_link" target="_blank">{{ base }}/{{ post.post_link}}</a>
              </label>
            </div>
            <div class="form-group">
              <label class="col-md-12 col-sm-12 col-xs-12" >Description <span class="required">*</span>
                <slot v-if="preview == true">
                  <a href="javascript:void(0)" v-on:click="preview = false" >Preview</a>
                </slot>
                <slot v-if="preview == false">
                  <a href="javascript:void(0)" v-on:click="preview = true" >Preview</a>
                </slot>
              </label>
              <div class="col-md-12 col-sm-12 col-xs-12" >
                <vue-editor
                  :use-save-button="false" :editor-content="post.body" @editor-updated="handleUpdatedContent" :editor-toolbar="customToolbar">
                </vue-editor>

                <!-- <textarea type="text" id="post_desc" required="required" class="form-control col-md-12 col-sm-12 col-xs-12 text-left" v-model="post.body" style="min-height:300px" @input="update">
                </textarea>
                <div type="text" id="post_desc" required="required" class="form-control col-md-12 col-sm-12 col-xs-12 text-left x_content warp_box html"  v-html="compiledMarkdown" style="min-height:300px"  v-if="preview">
                </div> -->
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 col-sm-12 col-xs-12" >Weight
              </label>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <input type="text" id="title" v-model="post.post_weight" required="required" class="form-control col-md-7 col-xs-12" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12 col-sm-12 col-xs-12" >Active<span class="required">*</span>
              </label>
              <div class="col-md-12 col-sm-12 col-xs-12" >
                <select class="form-control" v-model="post.post_active">
                          <option value="">Choose option</option>
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                </select>
              </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnPost(0)" v-if="submit">Submit</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnPost(post.id)" v-if="!submit">Edit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12" v-if="postDetail">
      <div class="x_panel">
        <div class="x_title">
          <h2>Category</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newPost"><i class="fa fa-plus"></i></a>
            </li>
            <li><a class="close-link" v-on:click="fetchPost"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content warp_box">
          <br />
          <form id="demo-form2" data-parsley-validate class="form-horizontal" method="post">
            <ul  class="list-unstyled">
              <li v-for="c in allCategory">
                <input type="checkbox" v-model="selected" :value="c.tax_id" number>
                {{ c.tax_name }}
              </li>
            </ul>
          </form>
        </div>
      </div>

      <div class="x_panel">
        <div class="x_title">
          <h2>Featured Image</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newPost"><i class="fa fa-plus"></i></a>
            </li>
            <li><a class="close-link" v-on:click="fetchPost"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
            <div v-if="!post.featured_img">
              <h2>Select an image</h2>
              <input type="file" @change="onFileChange">
            </div>
            <div v-else>
              <img :src="assets+post.featured_img" class="img-responsive" />
              <button @click="removeImage">Remove image</button>
            </div>
        </div>
      </div>
      <div class="x_panel">
        <div class="x_title">
          <h2>Template</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <input type="text" name="post_template" class="form-control" v-model="post.post_template">
        </div>
      </div>
    </div>
     
    <div class="col-md-12 col-sm-12 col-xs-12" v-if="!postDetail">
      <div class="x_panel">
        <div class="x_title">
          <h2>Post Tables <small>total post  <span>{{ total }}</span></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newPost"><i class="fa fa-plus"></i></a>
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
                <th>Title</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(p,key) in posts">
                <th scope="row"><a href="javascript:void(0)" name="Edit" v-on:click="btnEditPost(p.id)" >{{ key+1 }}</a></th>
                <td><a href="javascript:void(0)" name="Edit" v-on:click="btnEditPost(p.id)" >{{ p.title}}</a></td>
                <td><a href="javascript:void(0)" name="Delete" v-on:click="btnDeletePost(p.id)" ><i class="fa fa-close"></i></a></td>
              </tr>
            </tbody>
          </table>
          <div class="col-md-12 text-center">
            <a href="" onclick="return false" name="loadMore" v-on:click="loadMore('post')">Load More</a>
          </div>

        </div>
      </div>
    </div>
</div>

</template>

<script>
import { VueEditor } from 'vue2-editor'
export default {
  props: ['page','url','assets','base'],
  data(){
      return {
          segUrl : '',
          selected: [],
          searchQuery: '',
          allCategory: [{tax_name:'', tax_id:''}],
          posts: [{ id: 0,
                  title: "",
                  body: "",
                  featured: 0,
                  featured_img: "default.jpg",
                  post_link: "",
                  post_template: "",
                  post_weight: 0,
                  post_view: 0,
                  post_active: "yes",
                  post_created: 0,
                  created_at: "2016-06-03 00:36:29"
                  }],
          post: { id: 0,
                  title: "",
                  body: "",
                  featured: 0,
                  featured_img: "default.jpg",
                  post_link: "",
                  post_template: "default",
                  post_type: "post",
                  post_weight: 0,
                  post_view: 0,
                  post_active: "yes",
                  post_created: 0,
                  created_at: "2016-06-03 00:36:29"
                  },
          f5Post: { id: 0,
                  title: "",
                  body: "",
                  featured: 0,
                  featured_img: "default.jpg",
                  post_link: "",
                  post_template: "default",
                  post_type: "post",
                  post_weight: 0,
                  post_view: 0,
                  post_active: "yes",
                  post_created: 0,
                  created_at: "2016-06-03 00:36:29"
                  },
          postDetail : false,
          perPage : 10,
          submit:true,
          edit: false,
          total: 1,
          preview: false,
          customToolbar: [
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['image', 'code-block']
          ],
          htmlForEditor: null
        }
    },
    components: {
      VueEditor
    },
    methods: {
        handleUpdatedContent: _.debounce (function (e) {
          this.htmlForEditor = e
        }, 300),
        newPost : function() {
          this.postDetail = true
          this.submit = true
          this.post = { id: 0,title: "",body: "",
                  featured: 0,featured_img: "default.jpg",post_link: "",post_template:"default",post_type: "post",
                  post_weight: 0,post_view: 0,post_active: "yes",
                  post_created: 0,created_at: "2016-06-03 00:36:29"}
          this.selected = []
        },
        search: function() {
            if (this.searchQuery == "") {
                this.submit = true
                this.post = this.f5Post
                this.fetchPost()
            } else {
                this.searchPost()
            }
        },
        searchPost: function() {
            this.postDetail = false
            this.segUrl = '/post/search?bptitle=' + this.searchQuery+'&per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                if (response.data.data.length == 1) {
                    this.perPage = 10
                    this.post = response.data.data[0]
                } else {
                    this.posts = response.data.data
                }
                
            }, (response) => {
                // error callback
            });
        },
        fetchPost: function() {
            this.postDetail = false
            this.segUrl = '/post?per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                this.total = response.data.total
                this.allCategory =  response.data.category
                this.posts = response.data.data.data
            }, (response) => {
                // error callback
            });
        },
        onFileChange: function(e) {
          var files = e.target.files || e.dataTransfer.files;
          if (!files.length)
            return;
            //this.featured_img = files[0]
            var media = new FormData();
            media.append('featured_img', files[0]);
            this.segUrl = '/post/upload' 
            this.$http.post(this.url+ this.segUrl, media).then((response) => {
                this.post.featured_img = response.data.media
            }, (response) => {
                // error callback
            });
        },
        removeImage: function(){
          this.post.featured_img = ''
        },
        btnPost: function(id) {
          var post = this.post
          post.body = this.htmlForEditor
          post.categories = this.selected
          this.post = this.f5Post  
            if(id == 0){
              this.segUrl = '/post' 
              this.$http.post(this.url+ this.segUrl, post).then((response) => {
                this.fetchPost()
              }, (response) => {
                  // error callback
              });
            } else {
              this.segUrl = '/post/'+id 
              this.$http.patch(this.url+ this.segUrl, post).then((response) => {
                this.fetchPost()
              }, (response) => {
                  // error callback
              }); 

            }    
            $("#title").focus();
            this.total = this.total + 1;
        },
        btnEditPost: function(id){ 
            this.postDetail = true,  
            this.submit = false   
            //this.post = this.posts[id];
            this.segUrl = '/post/'+id
            this.$http.get(this.url+this.segUrl).then((response) => {
                this.post = response.data.data[0]
                var selected = [];
                response.data.post_category.forEach(function(s){
                  selected.push(parseInt(s.term_id));
                });
                this.selected = selected
            }, (response) => {

            });
        },
        btnDeletePost: function(id){
            this.postDetail = false,
            this.segUrl = '/post/'+id
            this.$http.delete(this.url+this.segUrl).then((response) => {
                this.fetchPost()
            }, (response) => {

            });
        },
        loadMore: function(filter){
            if(filter == 'post'){
                if(this.segUrl.search('post')> 0){
                  this.getPerPage()
                  this.fetchPost()
                } else {
                  this.perPage = 20
                  this.fetchPost()
                }
            }
        },
        getPerPage: function(){
          var array = this.segUrl.split('per_page=');
          this.perPage = parseInt(array[1]) + 10;
        },
        postPara: function() {
          var temp = this.post.title.replace(/[\. ,:-=]+/g, "-").toLowerCase()
          this.post.post_link = temp
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
    },
    mounted() {
       this.fetchPost()
    }
}

</script>
