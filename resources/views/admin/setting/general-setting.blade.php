<div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
<div class="card border">
    <div class="card-body">
        <form action="{{route('admin.general-setting-update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Site Name</label>
                <input type="text" name="site_name" value="{{@$generalSettings->site_name}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Layout</label>
                <select name="layout" id="" class="form-control">
                    <option {{@$generalSettings->layout == 'LTR' ? 'selected' : ''}} value="LTR">LTR</option>
                    <option {{@$generalSettings->layout == 'RTL' ? 'selected' : ''}} value="RTL">RTL</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Contact Email</label>
                <input type="text" name="contact_email" value="{{@$generalSettings->contact_email}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Default Currency Name</label>
                <select name="currency_name" id="" class="form-control select2">
                    <option value="">Select</option>
                    @foreach (config('setting.currency_list') as $currency)

                    <option {{@$generalSettings->currency_name == $currency ? 'selected' : ''}} value="{{$currency}}">{{$currency}}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="">Currency Icon</label>
                <input type="text" name="currency_icon" value="{{@$generalSettings->currency_icon}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="">Time Zone</label>

                <select name="time_zone" id="" class="form-control select2">
                    <option value="">Select</option>
                    @foreach (config('setting.time_zone') as $key => $time_zone)
                    <option {{@$generalSettings->time_zone == $key ? 'selected' : ''}}  value="{{$key}}">{{$key}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Update</button>
        </form>
    </div>
</div>
</div>
