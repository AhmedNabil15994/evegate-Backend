
<script>

    //toast function
   window.$alert =  function (message, type ="info", label="",  onclick=null) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "preventDuplicates": true,
            "onclick": onclick,
            "showDuration": "100",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "show",
            "hideMethod": "hide" ,
            "positionClass": "toast-bottom-left",
        };
        toastr[type](message, label);
    };

    window.$authError = function(){
        var loginRoute = "#"
        $alert(`<p>@lang('apps::frontend.home.must_auth')</p> <a style="color:#343a40;text-decoration: underline;" href="${loginRoute}">@lang('apps::frontend.home.login')</a> `, "error")
    }




    $(function(){
        counterFavorit = $(".container_favourit")

        $("body").on("click", ".make-favourit",  function(){
            var _elm = $(this);
            // $(this).toggleClass('fas');
            // $(this).toggleClass('isFavourit');
            _elm.prop('disabled', true);
            if(_elm.data("auth_check")){
                var url  = "{{route('frontend.user.toggle_favorites', [':id'])}}"
                url = url.replace(':id', _elm.data("id"));

                
                $.ajax(
                    {url: url, 
                    error:function(error){
                        console.log(error)
                        $alert(error.statusText, "error")
                        _elm.prop('disabled', false);
                    },    
                    success: function(result){
                        if(result.is_add){
                            counterFavorit.html( Number(counterFavorit.html()) +1 )
                            if(_elm.data("have_favorite"))  _elm.addClass("isFavourit")
                            _elm.addClass("fas")
                        }else{
                            var num  = Number(counterFavorit.html()) -1;
                            counterFavorit.html(num > 0 ? num : 0  )
                            if(_elm.data("have_favorite"))  _elm.removeClass("isFavourit")
                            _elm.removeClass("fas")
                        }

                        $alert("success", "success")

                        if(window.callbackFavourit) window.callbackFavourit(_elm, result.is_add)
                        _elm.prop('disabled', false);

                    }}
                   
                )
                // if(_elm.hasClass("fas")){


                    
                //     counterFavorit.html( Number(counterFavorit.html()) +1 )
                    
                //     // _elm.addClass("isFavourit")
                // }else{
                //     counterFavorit.html( Number(counterFavorit.html()) -1 )
                //     // _elm.removeClass("isFavourit")
                //     if(window.callbackFavourit) window.callbackFavourit(_elm, false)
                // }
            }else{
                $authError()
            }

            
        })

        function drawCities(){
            var url   = "{{route('api.areas.cities')}}"
            $.ajax(
                {
                    headers: {
                        "lang" : "{{locale()}}" ,
                        'Content-Type':'application/json'
                    },
                    url,
                   success:function(data){
                        var options = `<option value="">@lang("qsale::frontend.index.city")</option>`
                        for (const city of data.data) {
                            options += `<option value="${city.id}" data-states='${JSON.stringify(city.states)}'>${city.title}</option>`
                        }
                       
                        $(".city-select").html(options);
                        $(".city-select").map(function(){
                            var _elm = $(this)
                            if(_elm && _elm.data("selected")){
                                var value  = _elm.data("selected");
                                _elm.val(value).change()
// =                               _elm.find('option[value="'+value+'"]').prop("selected", true);
                            }
                        })
                   },
                   error:(error)=>console.log(error)
                }
            );
        }

        drawCities()

        $("body").on("change", ".city-select", function(){
            var _elm = $(this)
            var option = _elm.find("option:selected")
            var options = `<option value="">@lang("qsale::frontend.index.state")</option>`
            var states = option.data("states");
            if(states){
                var _target = $(_elm.data("target"))
                
                
                for (const state of states) {
                            options += `<option value="${state.id}" ${ _target.data('selected') == state.id  ? "selected"  : "" }>${state.title}</option>`
                        } 
                       
                _target.html(options);

            }
            
        })

    })


</script>



