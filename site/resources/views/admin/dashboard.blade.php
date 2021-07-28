@extends('admin.index')
@section('content')




<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $WinFridge?$WinFridge:'0'}}</h3>
              <p>Win Fridge</p>
            </div>
            <div class="icon">
              <i class="fa fa-apple"></i>
            </div>
            <a href="{{ url('admin/winfridge/') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        @if(Auth::user()->type == 'admin')
        <div class="col-lg-3">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $ConfirmWin?$ConfirmWin:'0'}}</h3>
              <p>Confirm Win</p>
            </div>
            <div class="icon">
              <i class="fa fa-trophy"></i>
            </div>
            <a href="{{ url('admin/confirmwin/') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $totalUser?$totalUser:'0'}}</h3>
              
              <p>User</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people-outline"></i>
            </div>
            <a href="{{ url('admin/users/') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $setting->count_prize }}</h3>
              
              <p>Count - Confirm Win</p>
            </div>
            <div class="icon">
              <i class="fa fa-sort"></i>
            </div>
            <a href="#" class="small-box-footer" style="cursor: none">&nbsp;</a>
          </div>
        </div>
        <!-- ./col -->
        @endif
        <!-- ./col -->
      </div>
      <!-- /.row (main row) -->

      <!-- form start -->
      @if(session()->has('message'))
        <div class="callout callout-info">
          <p><i class="icon fa fa-check"></i> {{ session()->get('message') }}</p>
        </div>
      @endif
      <form class="form-horizontal" method="POST" action="{{ url('admin/setting/') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Age Gate</a></li>
              <li><a href="#tab_2" data-toggle="tab" aria-expanded="false">QuenchYourCuriosity</a></li>
              <li><a href="#winfridge" data-toggle="tab" aria-expanded="false">Win a fridge</a></li>
              <li><a href="#confirmwin" data-toggle="tab" aria-expanded="false">Confirm win</a></li>
              <li><a href="#freebag" data-toggle="tab" aria-expanded="false">Bag giveaway</a></li>
              <li><a href="#tab_3" data-toggle="tab" aria-expanded="false">{{$setting->terms_name?$setting->terms_name:'Terms'}}</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">

                <div class="form-group {{ $errors->has('agegate_title') ? ' has-error' : '' }}">
                  <label for="agegate_title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="agegate_title" name="agegate_title" laceholder="Title" value="{{ $setting->agegate_title }}">
                    @if ($errors->has('agegate_title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('agegate_title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('agegate_note') ? ' has-error' : '' }}">
                  <label for="agegate_note" class="col-sm-2 control-label">Note</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="agegate_note" name="agegate_note" placeholder="Note">{{ $setting->agegate_note }}</textarea>
                    @if ($errors->has('agegate_note'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('agegate_note') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('agegate_footer') ? ' has-error' : '' }}">
                  <label for="agegate_footer" class="col-sm-2 control-label">Footer</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="agegate_footer" name="agegate_footer" placeholder="Footer">{{ $setting->agegate_footer }}</textarea>
                    @if ($errors->has('agegate_footer'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('agegate_footer') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('terms_name') ? ' has-error' : '' }}">
                  <label for="terms_name" class="col-sm-2 control-label">Terms name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="terms_name" name="terms_name" laceholder="Title" value="{{$setting->terms_name}}">
                    @if ($errors->has('terms_name'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('terms_name') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('terms_link') ? ' has-error' : '' }}">
                  <label for="terms_link" class="col-sm-2 control-label">Terms link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="terms_link" name="terms_link" laceholder="Title" value="{{$setting->terms_link}}">
                    @if ($errors->has('terms_link'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('terms_link') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="alert alert-info alert-dismissible">
                  <h4 style="margin-bottom: 0;">Section 1</h4>
                </div>
                <div class="form-group {{ $errors->has('section1_preview') ? ' has-error' : '' }}">
                  <label for="section1_preview" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="section1_preview" name="section1_preview" placeholder="Preview">{{ $setting->section1_preview }}</textarea>
                    @if ($errors->has('section1_preview'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section1_preview') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                {{-- SECTION 2 --}}
                <div class="alert alert-info alert-dismissible">
                  <h4 style="margin-bottom: 0;">Section 2</h4>
                </div>
                <div class="form-group {{ $errors->has('section2_title') ? ' has-error' : '' }}">
                  <label for="section2_title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="section2_title" name="section2_title" laceholder="Title" value="{{ $setting->section2_title }}">
                    @if ($errors->has('section2_title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section2_title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('section2_preview') ? ' has-error' : '' }}">
                  <label for="section2_preview" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="section2_preview" name="section2_preview" placeholder="Preview">{{ $setting->section2_preview }}</textarea>
                    @if ($errors->has('section2_preview'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section2_preview') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('section2_note') ? ' has-error' : '' }}">
                  <label for="section2_note" class="col-sm-2 control-label">Note</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="section2_note" name="section2_note" placeholder="Preview">{{ $setting->section2_note }}</textarea>
                    @if ($errors->has('section2_note'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section2_note') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                {{-- END SECTION 2 --}}
                {{-- SECTION 3 --}}
                <div class="alert alert-info alert-dismissible">
                  <h4 style="margin-bottom: 0;">Section 3</h4>
                </div>
                <div class="form-group {{ $errors->has('section3_title') ? ' has-error' : '' }}">
                  <label for="section3_title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="section3_title" name="section3_title" laceholder="Title" value="{{ $setting->section3_title }}">
                    @if ($errors->has('section3_title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section3_title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('section3_preview') ? ' has-error' : '' }}">
                  <label for="section3_preview" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="section3_preview" name="section3_preview" placeholder="Preview">{{ $setting->section3_preview }}</textarea>
                    @if ($errors->has('section3_preview'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section3_preview') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('section3_note') ? ' has-error' : '' }}">
                  <label for="section3_note" class="col-sm-2 control-label">Note</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="section3_note" name="section3_note" placeholder="Preview">{{ $setting->section3_note }}</textarea>
                    @if ($errors->has('section3_note'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section3_note') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                {{-- END SECTION 3 --}}
                {{-- SECTION 4 --}}
                <div class="alert alert-info alert-dismissible">
                  <h4 style="margin-bottom: 0;">Section 4</h4>
                </div>
                <div class="form-group {{ $errors->has('section4_title') ? ' has-error' : '' }}">
                  <label for="section4_title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="section4_title" name="section4_title" laceholder="Title" value="{{ $setting->section4_title }}">
                    @if ($errors->has('section4_title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section4_title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('section4_preview') ? ' has-error' : '' }}">
                  <label for="section4_preview" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="section4_preview" name="section4_preview" placeholder="Preview">{{ $setting->section4_preview }}</textarea>
                    @if ($errors->has('section4_preview'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section4_preview') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('section4_note') ? ' has-error' : '' }}">
                  <label for="section4_note" class="col-sm-2 control-label">Note</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="section4_note" name="section4_note" placeholder="Preview">{{ $setting->section4_note }}</textarea>
                    @if ($errors->has('section4_note'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section4_note') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                {{-- END SECTION 4 --}}
                {{-- SECTION 5 --}}
                <div class="alert alert-info alert-dismissible">
                  <h4 style="margin-bottom: 0;">Section 5</h4>
                </div>
                <div class="form-group {{ $errors->has('section5_title') ? ' has-error' : '' }}">
                  <label for="section5_title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="section5_title" name="section5_title" laceholder="Title" value="{{ $setting->section5_title }}">
                    @if ($errors->has('section5_title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section5_title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('section5_preview') ? ' has-error' : '' }}">
                  <label for="section5_preview" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="section5_preview" name="section5_preview" placeholder="Preview">{{ $setting->section5_preview }}</textarea>
                    @if ($errors->has('section5_preview'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section5_preview') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('section5_note') ? ' has-error' : '' }}">
                  <label for="section5_note" class="col-sm-2 control-label">Note</label>
                  <div class="col-sm-10">
                    <textarea rows="3" style="width: 100%;" id="section5_note" name="section5_note" placeholder="Preview">{{ $setting->section5_note }}</textarea>
                    @if ($errors->has('section5_note'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section5_note') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('section5_link') ? ' has-error' : '' }}">
                  <label for="section5_link" class="col-sm-2 control-label">Link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="section5_link" name="section5_link" laceholder="Link" value="{{ $setting->section5_link }}">
                    @if ($errors->has('section5_link'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section5_link') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('section5_link_open_date') ? ' has-error' : '' }}">
                  <label for="section5_link_open_date" class="col-sm-2 control-label">Link open day</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="section5_link_open_date" name="section5_link_open_date" laceholder="Link open day" value="{{ $setting->section5_link_open_date }}" autocomplete="off">
                    @if ($errors->has('section5_link_open_date'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('section5_link_open_date') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                {{-- END SECTION 5 --}}

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="winfridge">

                <div class="alert alert-info alert-dismissible">
                  <h4 style="margin-bottom: 0;">Winfridge</h4>
                </div>
                <div class="form-group {{ $errors->has('winfridge_title') ? ' has-error' : '' }}">
                  <label for="winfridge_title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="winfridge_title" name="winfridge_title" laceholder="Title" value="{{$setting->winfridge_title}}">
                    @if ($errors->has('winfridge_title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('winfridge_title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('winfridge_preview') ? ' has-error' : '' }}">
                  <label for="winfridge_preview" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;" id="winfridge_preview" name="winfridge_preview">{{ $setting->winfridge_preview }}</textarea>
                    @if ($errors->has('winfridge_preview'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('winfridge_preview') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="alert alert-info alert-dismissible">
                  <h4 style="margin-bottom: 0;">Winfridge detail</h4>
                </div>
                <div class="form-group {{ $errors->has('winfridge_detail_title') ? ' has-error' : '' }}">
                  <label for="winfridge_detail_title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="winfridge_detail_title" name="winfridge_detail_title" laceholder="Title" value="{{$setting->winfridge_detail_title}}">
                    @if ($errors->has('winfridge_detail_title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('winfridge_detail_title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('winfridge_detail_preview') ? ' has-error' : '' }}">
                  <label for="winfridge_detail_preview" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;" id="winfridge_detail_preview" name="winfridge_detail_preview">{{ $setting->winfridge_detail_preview }}</textarea>
                    @if ($errors->has('winfridge_detail_preview'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('winfridge_detail_preview') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('winfridge_detail_note') ? ' has-error' : '' }}">
                  <label for="winfridge_detail_note" class="col-sm-2 control-label">Note</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;" id="winfridge_detail_note" name="winfridge_detail_note">{{ $setting->winfridge_detail_note }}</textarea>
                    @if ($errors->has('winfridge_detail_note'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('winfridge_detail_note') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
              <div class="tab-pane" id="confirmwin">
                <div class="alert alert-info alert-dismissible">
                  <h4 style="margin-bottom: 0;">Confirmwin</h4>
                </div>
                <div class="form-group {{ $errors->has('confirmwin_board_preview') ? ' has-error' : '' }}">
                  <label for="confirmwin_board_preview" class="col-sm-2 control-label">Board description</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;" id="confirmwin_board_preview" name="confirmwin_board_preview">{{ $setting->confirmwin_board_preview }}</textarea>
                    @if ($errors->has('confirmwin_board_preview'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('confirmwin_board_preview') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('confirmwin_board_note') ? ' has-error' : '' }}">
                  <label for="confirmwin_board_note" class="col-sm-2 control-label">Board note</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;" id="confirmwin_board_note" name="confirmwin_board_note">{{ $setting->confirmwin_board_note }}</textarea>
                    @if ($errors->has('confirmwin_board_note'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('confirmwin_board_note') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('confirmwin_title') ? ' has-error' : '' }}">
                  <label for="confirmwin_title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="confirmwin_title" name="confirmwin_title" laceholder="Title" value="{{$setting->confirmwin_title}}">
                    @if ($errors->has('confirmwin_title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('confirmwin_title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('confirmwin_preview') ? ' has-error' : '' }}">
                  <label for="confirmwin_preview" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;" id="confirmwin_preview" name="confirmwin_preview">{{ $setting->confirmwin_preview }}</textarea>
                    @if ($errors->has('confirmwin_preview'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('confirmwin_preview') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('confirmwin_note') ? ' has-error' : '' }}">
                  <label for="confirmwin_note" class="col-sm-2 control-label">Note</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;" id="confirmwin_note" name="confirmwin_note">{{ $setting->confirmwin_note }}</textarea>
                    @if ($errors->has('confirmwin_note'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('confirmwin_note') }}</span>
                      </span>
                    @endif
                  </div>
                </div>

                <div class="alert alert-info alert-dismissible">
                  <h4 style="margin-bottom: 0;">Result</h4>
                </div>
                <div class="form-group {{ $errors->has('winfridge_result_note') ? ' has-error' : '' }}">
                  <label for="winfridge_result_note" class="col-sm-2 control-label">Note</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;" id="winfridge_result_note" name="winfridge_result_note">{{ $setting->winfridge_result_note }}</textarea>
                    @if ($errors->has('winfridge_result_note'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('winfridge_result_note') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                
              </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
              <div class="tab-pane" id="freebag">
                <div class="form-group {{ $errors->has('baggiveaway_title') ? ' has-error' : '' }}">
                  <label for="baggiveaway_title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="baggiveaway_title" name="baggiveaway_title" laceholder="Title" value="{{$setting->baggiveaway_title}}">
                    @if ($errors->has('baggiveaway_title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('baggiveaway_title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('baggiveaway_preview') ? ' has-error' : '' }}">
                  <label for="baggiveaway_preview" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;" rows="10" id="baggiveaway_preview" name="baggiveaway_preview">{{ $setting->baggiveaway_preview }}</textarea>
                    @if ($errors->has('baggiveaway_preview'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('baggiveaway_preview') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                {{-- 'winfridge_title','winfridge_preview','winfridge_detail_title','winfridge_detail_preview','winfridge_detail_note','confirmwin_board_preview','confirmwin_board_note','confirmwin_title','confirmwin_preview','confirmwin_note','winfridge_result_note','baggiveaway_title','baggiveaway_preview' --}}
              </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <div class="form-group {{ $errors->has('terms_of_use_title') ? ' has-error' : '' }}">
                  <label for="terms_of_use_title" class="col-sm-2 control-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="terms_of_use_title" name="terms_of_use_title" laceholder="Title" value="{{$setting->terms_of_use_title}}">
                    @if ($errors->has('terms_of_use_title'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('terms_of_use_title') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('terms_of_use_content') ? ' has-error' : '' }}">
                  <label for="terms_of_use_content" class="col-sm-2 control-label">Content</label>
                  <div class="col-sm-10">
                    <textarea class="textarea" style="width: 100%;" id="terms_of_use_content" name="terms_of_use_content">{{ $setting->terms_of_use_content }}</textarea>
                    @if ($errors->has('terms_of_use_content'))
                      <span class="help-block">
                        <span class="help-block">{{ $errors->first('terms_of_use_content') }}</span>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>



          <div class="row">
            <div class="col-lg-12 col-xs-12">
              <div class="box">
                <div class="box-body">

                  <div class="text-center">
                    <button type="submit" class="btn btn-info">Update</button>
                  </div>

                </div>
              </div>
            </div>
          </div>
      </form>
      
</section>


@endsection

@section('script')
{{-- <link rel="stylesheet" href="{{ asset('/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<script src="{{ asset('/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script> --}}

<script src="{{ asset('/admin/plugins/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#section5_link_open_date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
    setTimeout(function(){
        $('.callout').fadeOut( "slow" );
      }, 3000);
    // $('.textarea').wysihtml5({
    //   toolbar: {
    //     "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
    //     "emphasis": true, //Italics, bold, etc. Default true
    //     "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
    //     "html": true, //Button which allows you to edit the generated HTML. Default false
    //     "link": true, //Button to insert a link. Default true
    //     "image": true, //Button to insert an image. Default true,
    //     "color": true, //Button to change color of font  
    //     "blockquote": true, //Blockquote
    //   },
    //   cleanUp: false
    // });

    CKEDITOR.replace( 'terms_of_use_content',{
     height: 500,
     allowedContent: true,
     toolbar: [
      { name: 'document', items: [ 'Source', 'Cut', 'Copy', 'Paste', 'PasteText', 
        'PasteFromWord', 'Undo', 'Redo',  'Bold', 'Italic', 'Underline' ,'NumberedList', 
        'BulletedList', 'Outdent', 'Indent',  'JustifyLeft', 'JustifyCenter', 'JustifyRight', 
        'JustifyBlock', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor', 
        'Link', 'Unlink', 'Blockquote', 'CreateDiv']},
      ]
    });
  })
</script>
@endsection