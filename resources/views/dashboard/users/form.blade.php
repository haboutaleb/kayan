<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> {{ trans('dash.user') }} </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">


        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.email') }}</label>
            <div class="col-lg-9">
                <input type="email" name="email"  class="form-control" placeholder="{{ trans('dash.email') }}" @isset($user) value='{{$user->email}}' @endisset >
            </div>
        </div>

        <div class="form-group">
                <label class="col-lg-3 control-label">{{ trans('dash.mobile') }}</label>
                <div class="col-lg-9">
                    <input type="text" name="mobile"  class="form-control" placeholder="{{ trans('dash.mobile') }}" @isset($user) value='{{$user->mobile}}' @endisset >
                </div>
        </div>

        <div class="form-group">
                <label class="col-lg-3 control-label">{{ trans('dash.price') }}</label>
                <div class="col-lg-9">
                    <label class="radio-inline">
                        <input type="radio" name="type" value="organization" class="styled" @isset($user) @if($user->type == 'organization') checked="true" @endif @endisset>
                        {{trans('dash.organization')}}
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="type" value="user" class="styled" @isset($user) @if($user->type == 'user') checked="true" @endif @endisset >
                        {{trans('dash.user')}}
                    </label>

                </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.identitity_number') }}</label>
            <div class="col-lg-9">
                <input type="text" name="identitity_number" class="form-control" placeholder="{{ trans('dash.identitity_number') }}" @isset($user) value="{{$user->identitity_number}}" @endisset> 
            </div>
        </div>

        
        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.full_name') }}</label>
            <div class="col-lg-9">
                <input type="text" name="full_name" class="form-control" placeholder="{{ trans('dash.full_name') }}" @isset($user) value="{{$user->full_name}}" @endisset> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.password') }}</label>
            <div class="col-lg-9">
                <input type="password" name="password" class="form-control" placeholder="{{ trans('dash.password') }}" @isset($user) value="{{$user->password}}" @endisset> 
            </div>
        </div>


        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.gender') }}</label>
            <div class="col-lg-9">
                <label class="radio-inline">
                    <input type="radio" name="gender" value="male" class="styled" @isset($user) @if($user->status == 'male') checked="true" @endif @endisset>
                    {{trans('dash.male')}}
                </label>

                <label class="radio-inline">
                    <input type="radio" name="gender" value="female" class="styled" @isset($user) @if($user->status == 'female') checked="true" @endif @endisset >
                    {{trans('dash.female')}}
                </label>

            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-3 control-label"> {{ trans('dash.image') }}</label>
            <div class="col-lg-9">
                <input type="file" class="file-styled" name="image">
                <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.latitude') }}</label>
            <div class="col-lg-9">
                <input type="text" name="latitude" class="form-control" placeholder="{{ trans('dash.latitude') }}" @isset($user) value="{{$user->latitude}}" @endisset> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.longitude') }}</label>
            <div class="col-lg-9">
                <input type="text" name="longitude" class="form-control" placeholder="{{ trans('dash.longitude') }}" @isset($user) value="{{$user->longitude}}" @endisset> 
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.active') }}</label>
            <div class="col-lg-9">
                <label class="radio-inline">
                    <input type="radio" name="active" value="wait_admin_confirm" class="styled" @isset($user) @if($user->active == 'wait_admin_confirm') checked="true" @endif @endisset>
                    {{trans('dash.wait_admin_confirm')}}
                </label>

                <label class="radio-inline">
                    <input type="radio" name="active" value="deactive" class="styled" @isset($user) @if($user->active == 'deactive') checked="true" @endif @endisset >
                    {{trans('dash.deactive')}}
                </label>

                <label class="radio-inline">
                    <input type="radio" name="active" value="active" class="styled" @isset($user) @if($user->active == 'active') checked="true" @endif @endisset >
                    {{trans('dash.active')}}
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.code') }}</label>
            <div class="col-lg-9">
                <input type="text" name="code" class="form-control" placeholder="{{ trans('dash.code') }}" @isset($user) value="{{$user->code}}" @endisset> 
            </div>
        </div>

        <div class="form-group">
                <label class="col-lg-3 control-label">{{ trans('dash.status') }}</label>
                <div class="col-lg-9">
                    <label class="radio-inline">
                        <input type="radio" name="status" value="pending" class="styled" @isset($user) @if($user->status == 'pending') checked="true" @endif @endisset>
                        {{trans('dash.pending')}}
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="status" value="confirmed" class="styled" @isset($user) @if($user->status == 'confirmed') checked="true" @endif @endisset >
                        {{trans('dash.confirmed')}}
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="status" value="cancelled" class="styled" @isset($user) @if($user->status == 'cancelled') checked="true" @endif @endisset >
                        {{trans('dash.cancelled')}}
                    </label>
                </div>
            </div>

        <div class="text-right">
            <input type="submit" class="btn btn-primary" name="forward" value=" {{ trans('dash.save_forword_2_places') }} " />
            <input type="submit" class="btn btn-success" name="back" value=" {{ trans('dash.save_and_come_back') }} " />
        </div>
    </div>
</div>
