<template>
  <div class="row">
    
    <div class="col-md-12 col-sm-12 col-xs-12" v-if="sliderDetail">
      <div class="x_panel">
        <div class="x_title">
          <h2>Slider <small>form tool</small></h2>
          <div class="alert alert-danger" v-if="message">
            <strong>Danger!</strong> Please check the required field
          </div>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link" href="javascript:void(0)" v-on:click="newSlider"><i class="fa fa-plus"></i></a>
            </li>
            <li><a class="close-link" v-on:click="fetchslider"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Title <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="slider_name" v-model="slider.slider_name" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Image <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div v-if="!image">
                  <h2>Select an image</h2>
                  <input type="file" @change="onFileChange">
                </div>
                <div v-else>
                  <img :src="image" />
                  <button @click="removeImage">Remove image</button>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Type<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" v-model="slider.slider_type">
                          <option value="image">image</option>
                          <option value="video">video</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" >Description <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea type="text" id="slider_desc" required="required" class="form-control col-md-7 col-xs-12 text-left" v-model="slider.slider_description">
                </textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Active<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" v-model="slider.slider_active">
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
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnslider(0)" v-if="submit">Submit</button>
                <button type="submit" class="btn btn-success" onclick="return false" v-on:click="btnslider(slider.slider_id)" v-if="edit">Edit</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12" v-if="!sliderDetail">
      <div class="x_panel">
        <div class="x_title">
          <h2>Slider Tables <small>total slider  <span>{{ total }}</span></small></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-"></i></a>
            </li>
            <li><a class="close-link" v-on:click="newSlider"><i class="fa fa-plus"></i></a>
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
                <th>slider</th>
                <th>Title</th>
                <th>Weight</th>
              </tr>
            </thead>
            <tbody>
              <slot v-for="(m, key) in sliders">
              <tr>
                <td scope="row">
                    <slot v-if="m.slider_type == 'image'">
                      <a href="javascript:void(0)" @click="showModal(key)">
                        <img :src="slider_url+m.slider_link" height="100px" />
                      </a>
                    </slot>
                    <slot v-if="m.slider_type == 'video'">
                      <a href="javascript:void(0)" @click="showModal(key)">
                      <video height="100" width="100" style="margin-top:-10px !important">
                        <source :src="slider_url+m.slider_link" type="video/mp4">
                      </video> 
                      </a>
                    </slot>

                    <div v-if="modal == key && modal != -1">
                        <div @click="modal = -1">
                          <div >
                              <hr />
                              <div class="modal-body1">
                                <slot v-if="m.slider_type == 'video'">
                                  <video height="240" width="240" controls >
                                    <source :src="slider_url+m.slider_link" type="video/mp4">
                                    <!-- <source src="movie.ogg" type="video/ogg"> -->
                                      Your browser does not support the video tag.
                                  </video>
                                </slot>
                                <slot v-if="m.slider_type == 'image'">
                                  <img :src="slider_url+m.slider_link" class="img-responsive" />
                                </slot>
                              </div>
                          </div>
                        </div>
                    </div>
                </td>
                <td><a href="javascript:void(0)" name="Edit" v-on:click="btnEditslider(key)" >{{ m.slider_name}}</a></td>
                <td width="30%">{{ m.slider_weight }}</td>
                <td><a href="javascript:void(0)" name="Delete" v-on:click="btnDeleteslider(m.slider_id)" ><i class="fa fa-close"></i></a></td>
              </tr>
              
              </slot>
            </tbody>
          </table>
          <div class="col-md-12 text-center">
            <a href="" onclick="return false" name="loadMore" v-on:click="loadMore('slider')">Load More</a>
          </div>

        </div>
      </div>
    </div>


  </div>

</template>

<script>

export default {
  props: ['page','url','assets'],
  data(){
      return {
          segUrl : '',
          searchQuery: '',
          sliders: [{ slider_id: 0,
                      slider_name: "",
                      slider_link: "",
                      slider_type: "image",
                      slider_weight: 0,
                      slider_description: "" }],
          slider:  { slider_id: 0,
                      slider_name: "",
                      slider_link: "",
                      slider_type: "image",
                      slider_weight: 0,
                      slider_description: "" },
          f5slider:  { slider_id: 0,
                      slider_name: "",
                      slider_link: "",
                      slider_type: "image",
                      slider_weight: 0,
                      slider_description: "" },
          sliderDetail : false,
          perPage : 10,
          submit:true,
          edit: false,
          total: 1,
          image: '',
          imgModal : '',
          modal : -1,
          slider_url: this.assets,
          message: false
        }
    },
    methods: {
        newSlider : function() {
          this.sliderDetail = true
          this.slider = { slider_id: 0,
                      slider_name: "",
                      slider_link: "",
                      slider_type: "image",
                      slider_weight: 0,
                      slider_description: "" }
        },
        search: function() {
            //this.searchQuery = this.searchQuery.trim()
            if (this.searchQuery == "") {
                this.submit = true
                this.edit = false
                this.slider = this.f5slider
                this.fetchslider()
            } else {
                this.searchslider()
            }
        },
        searchslider: function() {
            this.sliderDetail = false
            this.segUrl = '/slider?bpslider_name=' + this.searchQuery+'&per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                if (response.data.data.length == 1) {
                    this.sliderDetail = true
                    this.perPage = 10
                    this.slider = response.data.data[0]
                } else {
                    this.sliders = response.data.data
                }
            }, (response) => {
                // error callback
            });
        },
        fetchslider: function() {
            this.sliderDetail = false
            this.segUrl = '/slider?per_page='+this.perPage
            this.$http.get(this.url + this.segUrl).then((response) => {
                this.total = response.data.total
                this.sliders = response.data.data
            }, (response) => {
                // error callback
            });
        },
        onFileChange: function(e) {
          var files = e.target.files || e.dataTransfer.files;
          if (!files.length)
            return;
            //this.slider_link = files[0]
            var slider = new FormData();
            slider.append('slider_link', files[0]);
            this.segUrl = '/slider/upload' 
            this.$http.post(this.url+ this.segUrl, slider).then((response) => {
                this.slider.slider_link = response.data.slider
            }, (response) => {
                // error callback
            });
        },
        btnslider: function(id) {
          var slider = this.slider
           
          this.slider = this.f5slider  
          this.slider_link = ''
          if(id == 0){
            this.segUrl = '/slider' 
            this.$http.post(this.url+ this.segUrl, slider).then((response) => {
                this.fetchslider()
            }, (response) => {
                this.message = true
            });
          } else {
            this.segUrl = '/slider/'+id 
            this.$http.patch(this.url+ this.segUrl, slider).then((response) => {
                this.fetchslider()
            }, (response) => {
                this.message = true
            }); 
          }    
          $("#slider_name").focus();
          this.total = this.total + 1;
        },
        btnEditslider: function(id){  
            this.sliderDetail = true,  
            this.submit = false
            this.edit = true      
            this.slider = this.sliders[id];
        },
        btnDeleteslider: function(id){
            this.sliderDetail = false,
            this.segUrl = '/slider/'+id
            this.$http.delete(this.url+this.segUrl).then((response) => {
                this.fetchslider()
            }, (response) => {

            });
        },
        showModal: function(data){
            this.modal = data
        },
        loadMore: function(filter){
            if(filter == 'slider'){
                if(this.segUrl.search('slider')> 0){
                  this.getPerPage()
                  this.fetchslider()
                } else {
                  this.perPage = 20
                  this.fetchslider()
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
    },
    mounted() {
      this.fetchslider()
    }
}

</script>
