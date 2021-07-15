@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <div class="container">

            <h3 class="dashboard-titles" style="margin: 20px 0">Payments Settings</h3>

            <div class="row">
                <div class="col-md-12">

                    @include('dashboard.includes.flash-alerts')

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-info">
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

                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam assumenda
                                    consequatur culpa deserunt dolorem exercitationem magni molestias nam nostrum
                                    reprehenderit? Aspernatur assumenda commodi dicta impedit ipsam iusto laboriosam
                                    molestiae pariatur!

                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Manage Currencies
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="headingTwo">
                                <div class="panel-body">

                                    <ul id="myTabs" class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#set-default"
                                                                                  id="set-default-tab" role="tab"
                                                                                  data-toggle="tab"
                                                                                  aria-controls="set-default"
                                                                                  aria-expanded="true">Set default
                                                currency</a></li>
                                        <li role="presentation" class=""><a href="#add-currency" role="tab"
                                                                            id="add-currency-tab" data-toggle="tab"
                                                                            aria-controls="add-currency"
                                                                            aria-expanded="false">Add new currency</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#delete-currencies" role="tab"
                                                                            id="delete-currencies-tab" data-toggle="tab"
                                                                            aria-controls="delete-currencies"
                                                                            aria-expanded="false">Delete currency</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#show-rates" role="tab"
                                                                            id="show-rates-tab" data-toggle="tab"
                                                                            aria-controls="show-rates"
                                                                            aria-expanded="false">Show rates</a>
                                        </li>
                                    </ul>

                                    <div id="myTabContent" class="tab-content">

                                        <div role="tabpanel" class="tab-pane fade active in" id="set-default"
                                             aria-labelledby="set-default-tab">

                                            <form method="POST"
                                                  action="{{ route('dashboard.payments.setPaymentsSettings') }}">
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

                                                <div class="row">
                                                    <div class="col-md-3 col-md-offset-9">
                                                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                                                            Apply settings
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="add-currency"
                                             aria-labelledby="add-currency-tab">

                                            <form method="POST"
                                                  action="{{ route('dashboard.payments.currency.store') }}">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="addCurrency">Add new currency</label>
                                                        <select class="form-control" id="addCurrency"
                                                                name="add-currency"
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
                                                        <input type="text" name="symbol" class="form-control"
                                                               id="addSymbol" placeholder="Currency symbol" required>
                                                    </div>
                                                </div>

                                                <hr class="mb-4">

                                                <div class="row">
                                                    <div class="col-md-3 col-md-offset-9">
                                                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                                                            Add currency
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="delete-currencies"
                                             aria-labelledby="delete-currencies-tab">

                                            <form method="POST"
                                                  action="{{ route('dashboard.payments.currency.destroyMany') }}">
                                                @csrf
                                                @method('delete')

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="addCurrency">Delete currencies</label>

                                                        @foreach($currenciesList as $currency)
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox"
                                                                           name="currency_{{ $currency->code }}"
                                                                    value="{{ $currency->id }}"> {{ $currency->code }}
                                                                </label>
                                                            </div>

                                                        @endforeach


                                                    </div>

                                                </div>


                                                <hr class="mb-4">

                                                <div class="row">
                                                    <div class="col-md-3 col-md-offset-9">
                                                        <button class="btn btn-danger btn-lg btn-block" type="submit">
                                                            Delete currencies
                                                        </button>
                                                    </div>
                                                </div>

                                            </form>


                                        </div>

                                        <div role="tabpanel" class="tab-pane fade" id="show-rates"
                                             aria-labelledby="show-rates-tab">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Show rates</label>


                                                        <table class="table table-hover">
                                                            <thead>
                                                            <tr class="active">
                                                                <th>№</th>
                                                                <th>Code</th>
                                                                <th>Rate</th>
                                                                <th>Exchange rate for</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @foreach($currenciesList as $currency)

                                                                @if($currency->status == 0)
                                                                    <tr>
                                                                        <th scope="row">{{ $loop->iteration - 1 }}</th>
                                                                        <td>{{ $currency->code }}</td>
                                                                        <td>{{ $currency->rate }}{{ $mainCurrency->symbol }} ({{ $mainCurrency->code }})</td>
                                                                        <td>{{ $currency->updated_at }}</td>
                                                                    </tr>
                                                                @endif

                                                            @endforeach


                                                            </tbody>
                                                        </table>


                                                    </div>

                                                </div>

                                        </div>

                                    </div>


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


