<div class="form-group">
   
    <label class="col-md-2">
        <div>{{__('post::dashboard.posts.form.images')}}</div>
        
    </label>
    <div class="col-md-9">
       <div class="text-center" style="margin-bottom: 15px">
             <button class="btn btn-info add-more-images" type="button "> {{__('apps::dashboard.buttons.add_more_image')}}</button>
       </div>
        <div class="images-add-container">
          <div class="image-add">
            <div class="row">
                <div class="col-md-11">
                    
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a data-input="image" data-preview="holder" class="btn btn-primary ">
                                        <i class="fa fa-picture-o"></i>
                                        {{__('apps::dashboard.buttons.upload')}}
                                    </a>
                                </span>
                                <input name="{{$name}}[]" class="form-control image image-upload" multiple type="file" data-name="images" >
                                
                            </div>
                            <div class="prieview">
                    
                            </div>
                            <div class="help-block"></div>
                        
                </div>
                <div class="col-md-1">
                    <button class="btn btn-danger tn-delete-uploded disabled" type="button">X</button>
                </div>
            </div>
          </div>
        </div>

        
    </div>
</div>


@push('componentJs')
<script>
    $(function(){
        var imagesUploadContainer = $(".images-add-container") ;
        var imageStub             = `
            <div class="image-add">
                <div class="row">
                    <div class="col-md-11">
                        
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a data-input="image" data-preview="holder" class="btn btn-primary ">
                                            <i class="fa fa-picture-o"></i>
                                            {{__('apps::dashboard.buttons.upload')}}
                                        </a>
                                    </span>
                                    <input name="{{$name}}[]" class="form-control image image-upload" multiple type="file" data-name="images" >
                                    
                                </div>
                                <div class="prieview">
                        
                                </div>
                                <div class="help-block"></div>
                            
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-danger btn-delete-uploded" type="button">X</button>
                    </div>
                </div>
            </div>
        `
        
        $("body").on("change",".image-upload" , function(){
            var _elm    = $(this);
            var preview =  _elm.parent().next(".prieview"); 
            if(this.files.length > 0){
                var imgsrc = window.URL.createObjectURL(this.files[0])
                var img  = `<img src="${imgsrc}" width="200" height="150" />`
                preview.html(img)
                console.log(preview, "dd")

            }else{
                preview.html("s")
            }
                 
        })

        $(".add-more-images").click(function(e){
            e.preventDefault();
           
         
           if(checkAllImagesUpladed() == false){
               alert("{{__('apps::dashboard.messages.must_upload_all')}}")
               return 0
           }
           imagesUploadContainer.append(imageStub)
        })

        $("body").on("click",".btn-delete-uploded" , function(e){
            e.preventDefault();
            $(this).parents(".image-add").remove()
        })

        function checkAllImagesUpladed(){
            var elments =  document.querySelectorAll(".image-upload") ;
            for (const elment of elments) {
                if(elment.files.length == 0 ) return false
            }
            return true;
        }
    })
</script>    
@endpush