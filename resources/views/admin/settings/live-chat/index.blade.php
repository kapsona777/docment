@extends('layouts.admin.layout')
@section('title','Settings')
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tawk Live Chat Settings</h6>
                </div>
                <div class="card-body">
                   
                    <form action="{{ route('admin.update.livechat.setting') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="">Tawk Live Chat</label>
                            <select name="live_chat" id="" class="form-control">
                                <option {{ $setting->live_chat==1 ? 'selected':'' }} value="1">Active</option>
                                <option {{ $setting->live_chat==0 ? 'selected':'' }} value="0">In-active</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="livechat_script">Tawk Live Direct Chat Link</label>
							<input type="text" class="form-control" name="livechat_script" id="livechat_script" value="{{ $setting->livechat_script }}">
                        </div>
                        <button type="submit" class="btn btn-success">Save Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
