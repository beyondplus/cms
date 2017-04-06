<template>
  <div>
    
    <div class="col-md-12 col-sm-12 col-xs-12" v-if="mediaDetail">
      <div class="col-md-8 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Media <small>form tool</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newMedia"><i class="fa fa-plus"></i></a>
                </li>
                <li><a class="close-link" v-on:click="fetchMedia"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />
              <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">


                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Image <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div v-if="!media.media_link">
                      <h4>Select an Media</h4>
                      <input type="file" @change="onFileChange">
                    </div>
                    <div v-else>
                      <img :src="assets+media.media_link" class="img-responsive" />
                      <button @click="removeMedia">Remove</button>
                    </div>
                  </div>
                </div>

              </form>
            </div>
          </div>

      </div>
      <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Media <small>form tool</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newMedia"><i class="fa fa-plus"></i></a>
              </li>
              <li><a class="close-link" v-on:click="fetchMedia"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label class="control-label" >Title <span class="required">*</span>
                  </label>
                    <input type="text" id="media_name" v-model="media.media_name" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label class="control-label">Type<span class="required">*</span>
                  </label>
                    <select class="form-control" v-model="media.media_type">
                              <option value="image">image</option>
                              <option value="video">video</option>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <label class="control-label" >Description <span class="required">*</span>
                </label>
                  <textarea type="text" id="media_desc" required="required" class="form-control col-md-7 col-xs-12 text-left" v-model="media.media_desc">
                </textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label class="control-label">Active<span class="required">*</span>
                  </label>
                    <select class="form-control" v-model="media.media_active">
                              <option value="">Choose option</option>
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                    </select>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                  <button type="submit" class="btn btn-primary">Cancel</button>
                  <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnMedia(0)" v-if="submit">Submit</button>
                  <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnMedia(media.media_id)" v-if="edit">Edit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12" v-if="!mediaDetail">
      <div class="x_panel">
        <div class="x_title">
          <h2>Media Tables <small>total media  <span>{{ total }}</span></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-"></i></a>
            </li>
            <li><a class="close-link" v-on:click="newMedia"><i class="fa fa-plus"></i></a>
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
                <th>Media</th>
                <th>Title</th>
                <th>Link</th>
              </tr>
            </thead>
            <tbody>
              <slot v-for="(m, key) in medias">
              <tr>
                <td scope="row">
                    <slot v-if="m.media_type == 'image'">
                      <a href="javascript:void(0)" @click="showModal(key)">
                        <img :src="assets+m.media_link" height="100px" />
                      </a>
                    </slot>
                    <slot v-if="m.media_type == 'video'">
                      <a href="javascript:void(0)" @click="showModal(key)">
                      <video height="100" width="100" style="margin-top:-10px !important">
                        <source :src="assets+m.media_link" type="video/mp4">
                      </video> 
                      </a>
                    </slot>

                    <div v-if="modal == key && modal != -1">
                        <div @click="modal = -1">
                          <div >
                              <hr />
                              <div class="modal-body1">
                                <slot v-if="m.media_type == 'video'">
                                  <video height="240" width="240" controls >
                                    <source :src="assets+m.media_link" type="video/mp4">
                                    <!-- <source src="movie.ogg" type="video/ogg"> -->
                                      Your browser does not support the video tag.
                                  </video>
                                </slot>
                                <slot v-if="m.media_type == 'image'">
                                  <img :src="assets+m.media_link" class="img-responsive" />
                                </slot>
                              </div>
                          </div>
                        </div>
                    </div>
                </td>
                <td><a href="javascript:void(0)" name="Edit" v-on:click="btnEditMedia(key)" >{{ m.media_name}}</a></td>
                <td width="30%"><input type="text" name="" :value="assets+m.media_link" class="form-control"></td>
                <td><a href="javascript:void(0)" name="Delete" v-on:click="btnDeleteMedia(m.media_id)" ><i class="fa fa-close"></i></a></td>
              </tr>
              
              </slot>
            </tbody>
          </table>
          <div class="col-md-12 text-center">
            <a href="" onclick="return false" name="loadMore" v-on:click="loadMore('media')">Load More</a>
          </div>

        </div>
      </div>
    </div>


  </div>

</template>

<script>

export default {
  props: ['page','url','base','assets'],
  data(){
      return {
          segUrl : '',
          searchQuery: '',
          medias: [{ media_id: 0,
                      media_name: "",
                      media_link: "",
                      media_type: "image",
                      media_weight: 0,
                      media_description: "" }],
          media:  { media_id: 0,
                      media_name: "",
                      media_link: "",
                      media_type: "image",
                      media_weight: 0,
                      media_description: "" },
          f5media:  { media_id: 0,
                      media_name: "",
                      media_link: "",
                      media_type: "image",
                      media_weight: 0,
                      media_description: "" },
          mediaDetail : false,
          perPage : 10,
          submit:true,
          edit: false,
          total: 1,
          image: '',
          media_link: '',
          imgModal : '',
          modal : -1
        }
    },
    methods: {
        newMedia : function() {
          this.mediaDetail = true
          this.media = { media_id: 0,
                      media_name: "",
                      media_link: "",
                      media_type: "image",
                      media_weight: 0,
                      media_description: "" }
        },
        search: function() {
            //this.searchQuery = this.searchQuery.trim()
            if (this.searchQuery == "") {
                this.submit = true
                this.edit = false
                this.media = this.f5media
                this.fetchMedia()
            } else {
                this.searchMedia()
            }
        },
        searchMedia: function() {
            this.mediaDetail = false
            this.segUrl = '/media?bpmedia_name=' + this.searchQuery+'&per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                if (response.data.data.length == 1) {
                    this.mediaDetail = true
                    this.perPage = 10
                    this.media = response.data.data[0]
                } else {
                    this.medias = response.data.data
                }
            }, (response) => {
                // error callback
            });
        },
        fetchMedia: function() {
            this.mediaDetail = false
            this.segUrl = '/media?per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                this.total = response.data.total
                this.medias = response.data.data
            }, (response) => {
                // error callback
            });
        },
        onFileChange: function(e) {
          var files = e.target.files || e.dataTransfer.files;
          if (!files.length)
            return;
            //this.media_link = files[0]
            var media = new FormData();
            media.append('media_link', files[0]);
            this.segUrl = '/media/upload' 
            this.$http.post(this.url+ this.segUrl, media).then((response) => {
                this.media.media_link = response.data.media
            }, (response) => {
                // error callback
            });
        },
        btnMedia: function(id) {
         
          var media = this.media
           
          this.media = this.f5media  
          this.media_link = ''
          if(id == 0){
            this.segUrl = '/media' 
            this.$http.post(this.url+ this.segUrl, media).then((response) => {
                this.fetchMedia()
            }, (response) => {
                this.message = "Please check the required field"
            });
          } else {
            this.segUrl = '/media/'+id 
            this.$http.patch(this.url+ this.segUrl, media).then((response) => {
                this.fetchMedia()
            }, (response) => {
                this.message = "Please check the required field"
            }); 
          }    
          $("#media_name").focus();
          this.total = this.total + 1;
        },
        btnEditMedia: function(id){  
            this.mediaDetail = true,  
            this.submit = false
            this.edit = true      
            this.media = this.medias[id];
        },
        btnDeleteMedia: function(id){
            this.mediaDetail = false,
            this.segUrl = '/media/'+id
            this.$http.delete(this.url+this.segUrl).then((response) => {
                this.fetchMedia()
            }, (response) => {

            });
        },
        showModal: function(data){
            this.modal = data
        },
        loadMore: function(filter){
            if(filter == 'media'){
                if(this.segUrl.search('media')> 0){
                  this.getPerPage()
                  this.fetchMedia()
                } else {
                  this.perPage = 20
                  this.fetchMedia()
                }
            }
        },
        getPerPage: function(){
          var array = this.segUrl.split('per_page=');
          this.perPage = parseInt(array[1]) + 10;
        },
        removeMedia: function(){
            this.media.media_link = ""
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
      this.fetchMedia()
    }
}

</script>
