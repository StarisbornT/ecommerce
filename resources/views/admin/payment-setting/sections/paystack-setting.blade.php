<div class="tab-pane fade show" id="list-paystack" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.paystack-setting.update', 1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Paystack Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{$paystackSetting->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                        <option {{$paystackSetting->status == 0 ? 'selected' : '' }} value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Paystack Account Mode</label>
                    <select name="account_mode" id="" class="form-control">
                        <option {{$paystackSetting->mode == 0 ? 'selected' : ''}} value="0">Sandbox</option>
                        <option {{$paystackSetting->mode == 1 ? 'selected' : ''}} value="1">Live</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Country Name</label>
                    <select name="country_name" id="" class="form-control select2" style="width: 100%">
                        <option value="">Select</option>
                       @foreach (config('setting.country_list') as $country)
                        <option {{$country == $paystackSetting->country_name ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>

                       @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Currency Name</label>
                    <select name="currency_name" id="" class="form-control select2" style="width: 100%">
                        <option value="">Select</option>
                       @foreach (config('setting.currency_list') as $key => $currency)
                        <option {{$currency == $paystackSetting->currency_name ? 'selected' : ''}} value="{{$currency}}">{{$key}}</option>

                       @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Currency rate (Per {{$setting->currency_name}})</label>
                   <input type="text" class="form-control" name="currency_rate" value="{{$paystackSetting->currency_rate}}">
                </div>

                <div class="form-group">
                    <label for="">Paystack Client Id</label>
                   <input type="text" class="form-control" name="client_id" value="{{$paystackSetting->client_id}}">
                </div>

                <div class="form-group">
                    <label for="">Paystack Secret Key</label>
                   <input type="text" class="form-control" name="secret_key" value="{{$paystackSetting->secret_key}}">
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Update</button>
            </form>
        </div>
    </div>
    </div>
