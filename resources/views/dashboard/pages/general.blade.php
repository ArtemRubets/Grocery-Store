@extends('dashboard.layouts.master')
@section('content')
    <div class="w3l_banner_nav_right">
        <div class="container">

            <h3 class="dashboard-titles" style="margin: 20px 0">General Settings</h3>

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
                                Social Networks
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingTwo">
                        <div class="panel-body">

                            ghghjghjghj
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>

@endsection
