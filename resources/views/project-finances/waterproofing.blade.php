@section('content')
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">

            <div class="flex-grow-1 align-items-center" id="table-actions">

                <x-forms.link-primary :link="route('projectfinances.waterproofing')" class="openRightModal mb-lg-0 mb-md-0 float-left mb-2 mr-3"
                    icon="plus">
                    @lang('modules.projects.addRecord')
                </x-forms.link-primary>

                <x-forms.link-secondary :link="route('clients.import')"
                    class="mb-lg-0 mb-md-0 d-sm-bloc d-none d-lg-block float-left mb-2 mr-3" icon="file-upload">
                    @lang('app.importExcel')
                </x-forms.link-secondary>

            </div>

            <x-datatable.actions>
                <div class="select-status mr-3">
                    <select class="form-control select-picker" disabled id="quick-action-type" name="action_type">
                        <option value="">@lang('app.selectAction')</option>
                        <option value="change-status">@lang('modules.tasks.changeStatus')</option>
                        <option value="delete">@lang('app.delete')</option>
                    </select>
                </div>
                <div class="select-status d-none quick-action-field mr-3" id="change-status-action">
                    <select class="form-control select-picker" name="status">
                        <option value="deactive">@lang('app.inactive')</option>
                        <option value="active">@lang('app.active')</option>
                    </select>
                </div>
            </x-datatable.actions>

            <div class="btn-group mt-lg-0 mt-md-0 ml-lg-3 ml-md-3 ml-0 mt-2" role="group">
                <a class="btn btn-secondary f-14 btn-active show-clients" data-original-title="@lang('app.menu.clients')"
                    data-toggle="tooltip" href="{{ route('clients.index') }}"><i class="side-icon bi bi-list-ul"></i></a>

                <a class="btn btn-secondary f-14 show-unverified" data-original-title="@lang('modules.dashboard.verificationPending')"
                    data-toggle="tooltip" href="javascript:;"><i class="side-icon bi bi-person-x"></i></a>
            </div>

        </div>
        <!-- Add Task Export Buttons End -->

        <!-- Task Box Start -->
        <div class="d-flex flex-column w-tables table-responsive mt-3 rounded bg-white">

            {{-- {!! $dataTable->table(['class' => 'table table-hover border-0 w-100']) !!} --}}

        </div>
        <!-- Task Box End -->
    </div>
    <!-- CONTENT WRAPPER END -->
@endsection
