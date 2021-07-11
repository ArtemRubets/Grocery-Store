@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <div class="container">

            <h3 class="dashboard-titles" style="margin: 20px 0">Payments Settings</h3>

            <div class="row">
                <div class="col-md-12">


                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                       aria-expanded="true" aria-controls="collapseOne">
                                        General
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <form method="POST" action="{{ route('dashboard.payments.setPaymentsSettings') }}">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="defaultCurrency">Set default currency</label>
                                                <select class="form-control" id="defaultCurrency"
                                                        name="default-currency" required>
                                                    @foreach($currenciesList as $currency)
                                                        <option @if($currency->status == 1)selected @endif>
                                                            {{ $currency->code }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <hr class="mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Apply settings
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Add Currencies
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    <form method="POST" action="{{ route('dashboard.payments.addCurrency') }}">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="addCurrency">Add new currency</label>
                                                <select class="form-control" id="addCurrency" name="add-currency"
                                                        required>
                                                    @foreach($availableCurrencies as $item)
                                                        <option value="{{ $item->cc }}">
                                                           {{ $item->cc }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="addSymbol">Currency symbol</label>
                                                <input type="text" name="symbol" class="form-control" id="addSymbol" placeholder="Currency symbol" required>
                                            </div>
                                        </div>

                                        <hr class="mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Add Currency
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

@endsection


