<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> {{ trans('dash.comment') }} </h5>
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
            <label class="col-lg-3 control-label">{{ trans('dash.from-user') }}</label>
            <div class="col-lg-9">
                <select name="from_id" class="select-search">
                    <option value="" selected> {{ trans('dash.choose-user')}}</option>
                    @foreach ($users as $user)
                     <option value="{{$user->id}}" @isset($comment) @if($comment->from_user == $user->id)  selected  @endif @endisset>{{$user->full_name}}</option>
                    @endforeach
                 <select>
            </div>
        </div>

        <div class="form-group">
                <label class="col-lg-3 control-label">{{ trans('dash.to-user') }}</label>
                <div class="col-lg-9">
                    <select name="to_id" class="select-search">
                        <option value="" selected> {{ trans('dash.choose-user')}}</option>
                        @foreach ($users as $user)
                    <option value="{{$user->id}}" @isset($comment) @if($comment->to_user == $user->id)  selected  @endif @endisset>{{$user->full_name}}</option>
                        @endforeach
                     <select>
                </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">{{ trans('dash.comment') }}</label>
            <div class="col-lg-9">
                <textarea name="comment" id="" cols="5"rows="5" class="form-control" placeholder="{{ trans('dash.comment') }}">@isset($comment) value='{{$comment->comment}}' @endisset </textarea>
            </div>
        </div>

  

        <div class="text-right">
            <input type="submit" class="btn btn-primary" name="forward" value=" {{ trans('dash.save_forword_2_places') }} " />
            <input type="submit" class="btn btn-success" name="back" value=" {{ trans('dash.save_and_come_back') }} " />
        </div>
    </div>
</div>
