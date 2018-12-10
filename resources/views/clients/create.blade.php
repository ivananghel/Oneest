<style>
	.btn-group .btn-sm {
		padding: 6px 77px 5px;
	}
	.btn.dropdown-toggle{
		padding:5px
	}
    
</style>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h4 class="modal-title" id="myModalLabel">{{ trans('lang.add_client') }}</h4>
</div>
<div id="result"></div>

<div class="modal-body no-padding">
    
    <form action="clients" id="add-client-form" method="post" class="smart-form">
        <fieldset>
            
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.first_name') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="first_name" placeholder="{{ trans('lang.first_name') }}">
                    </label>
                </section>
                
                
                <section class="col col-6">
                    <label class="label">{{ trans('lang.last_name') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="last_name" placeholder="{{ trans('lang.last_name') }}">
                    </label>
                </section>
            </div>
            
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.email') }}</label>
                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                        <input type="email" name="email" placeholder="{{ trans('lang.email') }}" autocomplete="off">
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.address') }}</label>
                    <label class="input"> <i class="icon-append fa fa-file-text-o"></i>
                        <input type="text" name="address" placeholder="{{ trans('lang.address') }}" autocomplete="off">
                    </label>
                </section>
                
            </div>
            <div class="row">
                <section class="col col-lg-12">
                    <label class="input"> 
                        <div class="btn-group" data-toggle="buttons" >
                            <label class="btn btn-default btn-sm  btn-success active" data-color="success">
                                <input type="radio" name="status" value="1" checked class="hidden"/>
                                Active
                            </label>
                            <label class="btn btn-default btn-sm " data-color="danger">
                                <input type="radio" name="status" value="0" class="hidden" />
                                Out
                            </label>
                            <label class="btn btn-default btn-sm " data-color="info">
                                <input type="radio" name="status" value="2" class="hidden"/>
                                Stand By
                            </label>
                        </div>
                    </label>
                </section>
                
            </div>
  
        </fieldset>
        
        <fieldset>
            <div class="row">
                <section class="col col-lg-12">
                    <label class="label">{{ trans('lang.Bank Card number') }}</label>
                    <label class="input"> <i class="icon-append fa fa-credit-card-alt"></i>
                        <input type="text" name="card_number" id="card_number" placeholder="{{ trans('lang.first_name') }}" data-mask="9999999999999999">
                    </label>
                </section>
                
            </div>
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.CVC') }}</label>
                    <label class="input"> <i class="icon-append fa fa-credit-card-alt"></i>
                        <input type="text" name="card_cvc" id="card_cvc" placeholder="{{ trans('lang.CVC') }}"   data-mask="999">
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.Valid to') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <input type="text" id="card_valid"  name="card_valid"  data-mask="99/99"   >
                        </label>
                        
                    </label>
                </section>
            </div>
            
        </fieldset>
        
        <footer>
            <button type="submit" class="btn btn-primary" id="valid">
                {{ trans('lang.add') }} {{ trans('lang.client') }}
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
 $('[data-mask]').each(function() {
	
    var $this = $(this),
        mask = $this.attr('data-mask') || 'error...', mask_placeholder = $this.attr('data-mask-placeholder') || 'X';

    $this.mask(mask, {
        placeholder : mask_placeholder
    });
    
    //clear memory reference
    $this = null;
});
   
    $('#date').datepicker({
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
		
    });
    
    
    $(document).on('click', '.btn-group', function (event) {
        var label = $(this).find('.active'); 
        var color = label.data('color'); 
        label.addClass('btn-'+color); 
        
        $(this).find('.btn').each(function(){
            
            if($(this).hasClass('active')){
                return true;
            }
            var color = $(this).data('color'); 
            $(this).removeClass('btn-'+color); 
        }); 
    });
    
    
    $(document).ready(function () {
        $(document).on('click', '#valid', function () {
            
            if($('[name=card_number]').val()){
                
                $('[name=card_number]').rules("add", {
                    required: true,
                    minlength: 16,
                    maxlength: 16
                    
                });
                
                $('[name=card_cvc]').rules("add", {
                    required: true,
                    minlength: 3,
                    maxlength: 3
                    
                });
                $('[name=card_valid]').rules("add", {
                    required: true,
                    
                    
                });
            }else{
                $('[name=card_number]').rules("remove");
                $('[name=card_cvc]').rules("remove");
                $('[name=card_valid]').rules("remove");
                
                $('[name=card_number]').parent().removeClass("state-error").addClass('state-success');
                $('[name=card_number]').addClass('valid');
                $('[name=card_cvc]').parent().removeClass("state-error").addClass('state-success');
                $('[name=card_cvc]').addClass('valid');
                $('[name=card_valid]').parent().removeClass("state-error").addClass('state-success');
                $('[name=card_valid]').addClass('valid');
            }
        });
        
        
    });
    var errorClass = 'invalid';
    var errorElement = 'em';
    
    
    
    
    var $registerForm = $("#add-client-form").validate({
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
            first_name: {
                required: true,
                minlength: 3,
                maxlength: 25
            },
            last_name: {
                required: true,
                minlength: 3,
                maxlength: 25
            },
            
            email: {
                required: true,
                email: true
            },
            
        },
        // Messages for form validation
        messages: {
            first_name: {
                required: "{{trans('lang.first_name_required')}}"
            },
            last_name: {
                required: "{{trans('lang.last_name_required')}}"
            },
            role: {
                required: "{{trans('lang.role')}}"
            },
            email: {
                required: "{{trans('lang.email_required')}}",
                email: "{{trans('lang.email_invalid')}}"
            },
          
        },
        // Do not change code below
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent());
        },
        submitHandler: function (form) {
            submit_form('#add-client-form', '#result')
        }
    });
    
    
    
</script>