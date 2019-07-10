<div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> {{ trans('dash.useroffer') }} </h5>
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
                <label class="col-lg-3 control-label">{{ trans('dash.offer-from-user') }}</label>
                <div class="col-lg-9">
                    <select name="from_user" class="select-search">
                        <option value="" selected> {{ trans('dash.choose-user')}}</option>
                        @foreach ($users as $user)
                         <option value="{{ $user->id}}" @isset($useroffer) @if($useroffer->from_user == $user->id)  selected  @endif @endisset>{{ $user->full_name }}</option>
                        @endforeach
                     <select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">{{ trans('dash.offer') }}</label>
                <div class="col-lg-9">
                    <select name="offer_id" class="select-search">
                        <option value="" selected> {{ trans('dash.offer')}}</option>
                        @foreach ($offers as $offer)
                         <option value="{{ $offer->id}}" @isset($useroffer) @if($useroffer->offer_id == $offer->id)  selected  @endif @endisset>{{ $offer->id}}</option>
                        @endforeach
                     <select>
                </div>
            </div>

            <div class="form-group">
                    <label class="col-lg-3 control-label">{{ trans('dash.offer-to-user') }}</label>
                    <div class="col-lg-9">
                        <select name="to_user" class="select-search">
                            <option value="" selected> {{ trans('dash.choose-user')}}</option>
                            @foreach ($users as $user)
                             <option value="{{$user->id}}" @isset($useroffer) @if($useroffer->to_user == $user->id)  selected  @endif @endisset>{{$user->full_name}}</option>
                            @endforeach
                         <select>
                    </div>
            </div>

            <div class="form-group">
                    <label class="col-lg-3 control-label">{{ trans('dash.price') }}</label>
                    <div class="col-lg-9">
                        <input type="text" name="price"  class="form-control" placeholder="{{ trans('dash.price') }}" @isset($useroffer) value='{{$useroffer->price}}' @endisset >
                    </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">{{ trans('dash.details') }}</label>
                <div class="col-lg-9">
                    <textarea name="details" id="" cols="5"rows="5" class="form-control" placeholder="{{ trans('dash.details') }}">@isset($useroffer) {{$useroffer->details}} @endisset </textarea>
                </div>
            </div>

            <div class="form-group">
                    <label class="col-lg-3 control-label">{{ trans('dash.status') }}</label>
                    <div class="col-lg-9">
                        <label class="radio-inline">
                            <input type="radio" name="status" value="pending" class="styled" @isset($useroffer) @if($useroffer->status == 'pending') checked="true" @endif @endisset>
                            {{trans('dash.pending')}}
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="status" value="confirmed" class="styled" @isset($useroffer) @if($useroffer->status == 'confirmed') checked="true" @endif @endisset >
                            {{trans('dash.confirmed')}}
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="status" value="cancelled" class="styled" @isset($useroffer) @if($useroffer->status == 'cancelled') checked="true" @endif @endisset >
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
