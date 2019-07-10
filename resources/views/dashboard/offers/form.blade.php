<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> {{ trans('dash.offer') }} </h5>
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
            <label class="col-lg-3 control-label">{{ trans('dash.offer-from') }}</label>
            <div class="col-lg-9">
                <input type="text" class="form-control datepicker" name="from" @isset($offer) value='{{ $offer->from }}' @endisset placeholder="{{ trans('dash.offer-from') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.offer-to') }}</label>
            <div class="col-lg-9">
                <input type="text" name="to" class="form-control datepicker" @isset($offer) value='{{ $offer->to }}' @endisset placeholder="{{ trans('dash.offer-to') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"> {{ trans('dash.offer-type') }}</label>
            <div class="col-lg-9">
                <select name="type" class="select-search">
                    <option value="" selected> {{ trans('dash.choose-type')}}</option>
                    <option @isset($offer) @if($offer->type == 'once')  selected   @endif @endisset value="once"> {{trans('dash.one')}} </option>
                    <option @isset($offer) @if($offer->type == 'hours')  selected  @endif @endisset value="hours"> {{ trans('dash.hours') }} </option>
                    <option @isset($offer) @if($offer->type == 'contract')  selected  @endif @endisset value="contract"> {{trans('dash.contract')}} </option>
                </select>

            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.gender') }}</label>
            <div class="col-lg-9">
                <label class="radio-inline">
                    <input type="radio" name="gender" value="male" class="styled" @isset($offer) @if($offer->gender == 'male') checked @endif @endisset>
                    {{trans('dash.male')}}
                </label>

                <label class="radio-inline">
                    <input type="radio" name="gender" value="female" class="styled" @isset($offer) @if($offer->gender == 'female') checked @endif @endisset >
                    {{trans('dash.female')}}
                </label>

            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.note') }}</label>
            <div class="col-lg-9">
                <textarea name="note" id="" cols="5"rows="5" class="form-control" placeholder="{{ trans('dash.note') }}">@isset($offer) {{$offer->note}} @endisset </textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.user') }}</label>
            <div class="col-lg-9">
                <select name="user_id" class="select-search">
                    <option value="" selected> {{ trans('dash.choose-user')}}</option>
                    @foreach ($users as $user)
                     <option value="{{$user->id}}" @isset($offer) @if($offer->user_id == $user->id)  selected  @endif @endisset>{{$user->full_name}}</option>
                    @endforeach
                 <select>
            </div>
        </div>

        <div class="form-group">
                <label class="col-lg-3 control-label">{{ trans('dash.category') }}</label>
                <div class="col-lg-9">
                    <select name="category_id" class="select-search">
                        <option value="" selected> {{ trans('dash.choose-category')}} </option>
                        @foreach ($categories as $category)
                         <option value="{{$category->id}}" @isset($offer) @if($offer->category_id == $category->id)  selected  @endif @endisset> {{ $category->name_en }} </option>
                        @endforeach
                     <select>
                </div>
        </div>


        <div class="text-right">
            <input type="submit" class="btn btn-primary" name="forward" value=" {{ trans('dash.save_forword_2_places') }} " />
            <input type="submit" class="btn btn-success" name="back" value=" {{ trans('dash.save_and_come_back') }} " />
        </div>
    </div>
</div>
