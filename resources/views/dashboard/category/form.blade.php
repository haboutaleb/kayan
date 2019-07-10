
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"> {{ trans('dash.category') }} </h5>
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
                            <label class="col-lg-3 control-label">{{ trans('dash.name_ar') }}</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="name_ar" @isset($category) value='{{$category->name_ar}}' @endisset placeholder="{{ trans('dash.name_ar') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('dash.name_en') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="name_en" class="form-control" @isset($category) value='{{$category->name_en}}' @endisset placeholder="{{ trans('dash.name_en') }}" required>
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
                            <label class="col-lg-3 control-label">{{ trans('dash.description_ar') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="description_ar" class="form-control" @isset($category) value='{{$category->description_ar}}' @endisset  placeholder="{{ trans('dash.description_ar') }}" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">{{ trans('dash.description_en') }}</label>
                            <div class="col-lg-9">
                                <input type="text" name="description_en" class="form-control"  @isset($category) value='{{$category->description_en}}' @endisset placeholder="{{ trans('dash.description_en') }}" >
                            </div>
                        </div>

                        <div class="text-right">
                            <input type="submit" class="btn btn-primary" name="forward" value=" {{ trans('dash.save_forword_2_places') }} " />
                            <input type="submit" class="btn btn-success" name="back" value=" {{ trans('dash.save_and_come_back') }} " />
                        </div>
                    </div>
                </div>
