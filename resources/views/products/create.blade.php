

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel"> {{trans('lang.add')}} {{trans('lang.products')}}</h4>
</div>
<div id="result"></div>

<div class="modal-body no-padding">
    
    <form action="products" id="add-product-form" method="post" class="smart-form">
        <fieldset>
            
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.title') }}</label>
                    <label class="input"> <i class="icon-append fa fa-font"></i>
                        <input type="text" name="title" placeholder="{{ trans('lang.title') }}">
                    </label>
                </section>
                
                
                <section class="col col-6">
                    <label class="label">{{ trans('lang.price') }}</label>
                    <label class="input"> <i class="icon-append fa fa-hashtag fa-fw"></i>
                        <input type="text" name="price" placeholder="{{ trans('lang.price') }}">
                    </label>
                </section>
            </div>
            
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.amount') }}</label>
                    <label class="input"> 
                        <input type="number"  max="15" min="1" value="1" name="amount" />
                    </label>
                </section>
                <section class="col col-md-6">
                    <label class="label">{{ trans('lang.stock') }}</label>
                    <span >
                        <input type="hidden" name="stock" value=0>
                        <input  class="switch" type="checkbox" name="stock" checked value=1>
                    </span>
                </section>
                
                
                
            </div>
            <div class="row">
                <section class="col col-md-12">
                    <label class="label">{{ trans('lang.select_clients') }}</label>
                    <label class="input">
                        <select class="form-control SlectBox"  name="clients[]" multiple="multiple">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->first_name }} {{ $client->last_name }}</option>
                            @endforeach
                          
                        </select>
                    </label>
                </section>
                
            </div>
            
            
        </fieldset>
        
        
        
        <footer>
            <button type="submit" class="btn btn-primary" id="valid">
                {{trans('lang.add')}} {{trans('lang.products')}}
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                {{ trans('lang.cancel') }}
            </button>
        </footer>
    </form>
    
</div>


<!-- PAGE RELATED PLUGIN(S) -->
<script src="js/plugin/jquery_form/jquery.form.js"></script>

<script>
    
    
    $(".SlectBox").SumoSelect({
                placeholder: 'Select Clients' 
            });
    $(".switch").bootstrapSwitch();
    
    var errorClass = 'invalid';
    var errorElement = 'em';
    
    var $registerForm = $("#add-product-form").validate({
        errorClass: errorClass,
        errorElement: errorElement,
        highlight: function (element) {
            $(element).parent().removeClass('state-success').addClass("state-error");
            $(element).removeClass('valid');
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("state-error").addClass('state-success');
            $(element).addClass('valid');
        },
        // Rules for form validation
        rules: {
            title: {
                required: true,
              
            },
            price: {
                required: true,
                number: true
             
            },
            amount: {
                required: true,
            }
            
        },
        // Messages for form validation
        messages: {
       
        },
        // Do not change code below
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent());
        },
        submitHandler: function (form) {
            submit_form('#add-product-form', '#result')
        }
    });
    
    
    
</script>