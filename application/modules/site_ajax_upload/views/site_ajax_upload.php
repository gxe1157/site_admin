<!--site_ajax_upload image -->

          <style>
            .form-style-fake{position:absolute;top:0px;}
            .form-style-base{position:absolute;top:0px;z-index: 999;opacity: 0;}
            .fake-styled-btn{
                background: #006cad;
                padding: 10px;
                color: #fff; }
          </style>

          <input type="hidden" id="active_image" name="active_image" value="">
          <img src="http://via.placeholder.com/250x250";
               class="img-responsive img-thumbnail";
               style="width: 250px; height:250px;"
               alt="#"
               id="previewImg">

       <!-- upload file input  -->
          <div class="col-sm-12"
               id="pre_upload"
               style="display: block">

              <input type="file"
                     id="file"
                     name="file"
                     class="form-control form-input form-style-base">

              <h5 id="fake-btn" class="form-input fake-styled-btn text-center">
              <span class="margin">Choose File</span></h5>
          </div>
       <!-- upload file input  -->

          <div class="caption" id="confirm_upload" 
               style="display: none; margin-top: 8px; padding-bottom: 0px;">
                <a href="#" >
                    <button class="btn btn-md btn-primary btn-sm" id="upload-button"
                            type="button">Upload image</button>                            
                </a>
                <a href="#" >
                   <button type="button" id='cancelImg'
                           class="btn btn-default btn-sm">Cancel</button>
                </a>
          </div>        

          <div id="message"></div>

