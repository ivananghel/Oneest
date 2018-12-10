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
    <h4 class="modal-title" id="myModalLabel">{{ trans('lang.edit') }} {{ trans('lang.client') }}</h4>
</div>
<div id="result"></div>

<div class="modal-body no-padding">
    
<form action="clients/{{$client->id}}" id="update-client-form" method="post" class="smart-form">
        <input name="_method" type="hidden" value="PUT">
        <fieldset>
            
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.first_name') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="first_name" placeholder="{{ trans('lang.first_name') }}" value="{{ $client->first_name }}">
                    </label>
                </section>
                
                
                <section class="col col-6">
                    <label class="label">{{ trans('lang.last_name') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <input type="text" name="last_name" placeholder="{{ trans('lang.last_name') }}" value="{{ $client->last_name }}">
                    </label>
                </section>
            </div>
            
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.email') }}</label>
                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                        <input type="email" name="email" placeholder="{{ trans('lang.email') }}" autocomplete="off" value="{{ $client->email }}">
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.address') }}</label>
                    <label class="input"> <i class="icon-append fa fa-file-text-o"></i>
                        <input type="text" name="address" placeholder="{{ trans('lang.address') }}" autocomplete="off" value="{{ $client->address }}">
                    </label>
                </section>
                
            </div>
            <div class="row">
                <section class="col col-lg-12">
                    <label class="input"> 
                        <div class="btn-group" data-toggle="buttons" >
                            <label class="btn btn-default btn-sm  {{ ($client->status == 1 ?' btn-success active':'')}}" data-color="success">
                                <input type="radio" name="status" value="1"  {{ ($client->status == 1 ?'checked="checked"':'')}}  class="hidden"/>
                                Active
                            </label>
                            <label class="btn btn-default btn-sm {{ ($client->status == 0 ?' btn-danger active':'')}}" data-color="danger">
                                <input type="radio" name="status" value="0" {{ ($client->status == 0 ?'checked="checked"':'')}} class="hidden" />
                                Out
                            </label>
                            <label class="btn btn-default btn-sm {{ ($client->status == 2 ?'btn-info active':'')}}" data-color="info">
                                <input type="radio" name="status" value="2" {{ ($client->status == 2 ?'checked="checked"':'')}} class="hidden"/>
                                Stand By
                            </label>
                        </div>
                    </label>
                </section>
                
            </div>

            <div class="row">
            <section class="col col-lg-12">
                    <label class="label">{{ trans('lang.client_price') }}</label>
                    <label class="input"> <i class="icon-append fa fa-eur"></i>
                        <input type="text"  disabled readonly  placeholder="{{ trans('lang.client_price') }}"value ="{{$price}}">
                    </label>
                </section>
            </div>
            
        </fieldset>
        
        <fieldset>
            <div class="row">
                <section class="col col-lg-12">
                    <label class="label">{{ trans('lang.Bank Card number') }}</label>
                    <label class="input"> <i class="icon-append fa fa-credit-card-alt"></i>
                        <input type="text" name="card_number" id="card_number" value="{{ $client->card_number }}" placeholder="{{ trans('lang.first_name') }}" data-mask="9999999999999999">
                    </label>
                </section>
                
            </div>
            <div class="row">
                <section class="col col-6">
                    <label class="label">{{ trans('lang.CVC') }}</label>
                    <label class="input"> <i class="icon-append fa-credit-card-alt"></i>
                        <input type="text" name="card_cvc" id="card_cvc"  value="{{ $client->card_cvc }}" placeholder="{{ trans('lang.CVC') }}"  data-mask="999">
                    </label>
                </section>
                <section class="col col-6">
                    <label class="label">{{ trans('lang.Valid to') }}</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                        <label class="input"> <i class="icon-append fa fa-calendar"></i>
                        <input type="text"  name="card_valid" placeholder="LL/AA" value="{{$client->card_valid}}"  data-mask="99/99">
                        </label>
                        
                    </label>
                </section>
            </div>
            
        </fieldset>
        
        <footer>
            <button type="submit" class="btn btn-primary" id="valid">
            {{ trans('lang.edit') }} {{ trans('lang.client') }}
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
    
    $('#date').datepicker({
        format: "mm/yy",
        
		
    });
    $('[data-mask]').each(function() {
	
    var $this = $(this),
        mask = $this.attr('data-mask') || 'error...', mask_placeholder = $this.attr('data-mask-placeholder') || 'X';

    $this.mask(mask, {
        placeholder : mask_placeholder
    });
    
    //clear memory reference
    $this = null;
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
    
    var $registerForm = $("#update-client-form").validate({
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
            password: {
                required: "{{trans('lang.password').' '.trans('lang.required')}}"
            },
            password_confirmation: {
                required: "{{trans('lang.confirm_password').' '.trans('lang.required')}}",
                equalTo: "{{trans('lang.the_same').' '.trans('lang.required')}}"
            }
        },
        // Do not change code below
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent());
        },
        submitHandler: function (form) {
            submit_form('#update-client-form', '#result')
        }
    });
    
    
    
</script>