//Table skeleton
@section('content')
<!-- CONTENT WRAPPER START -->
<div class="content-wrapper">
    <!-- Add Task Export Buttons Start -->
    <div class="d-grid d-lg-flex d-md-flex action-bar">

        <div class="flex-grow-1 align-items-center" id="table-actions">

            <x-forms.link-primary :link="route('projectfinances.licenses')"
                class="openRightModal mb-lg-0 mb-md-0 float-left mb-2 mr-3" icon="plus">
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

            <a class="btn btn-secondary f-14 show-unverified"
                data-original-title="@lang('modules.dashboard.verificationPending')" data-toggle="tooltip"
                href="javascript:;"><i class="side-icon bi bi-person-x"></i></a>
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


//Ajax skeleton
<div class="row">
    <div class="col-sm-12">
        <x-form id="save-licenses-and-permits-form">

            <div class="add-resource rounded bg-white">
                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.employees.accountDetails')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-4">
                                <x-forms.text :fieldLabel="__('modules.client.clientName')"
                                    :fieldPlaceholder="__('placeholders.name')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="name" fieldName="name" fieldRequired="true"></x-forms.text>
                            </div>
                            <div class="col-md-4">
                                <x-forms.email :fieldLabel="__('app.email')"
                                    :fieldPlaceholder="__('placeholders.email')" :fieldValue="$lead->client_email ?? ''"
                                    :popover="__('modules.client.emailNote')" fieldId="email" fieldName="email">
                                </x-forms.email>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="f-21 font-weight-normal border-top-grey mb-0 p-20">
                    @lang('modules.client.companyDetails')
                </h4>
                <div class="row p-20">
                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('modules.client.companyName')"
                            :fieldPlaceholder="__('placeholders.company')" :fieldValue="$lead->company_name ?? ''"
                            class="mt-lg-0 mt-md-0 mb-3 mt-3" fieldId="company_name" fieldName="company_name">
                        </x-forms.text>
                    </div>
                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('modules.client.website')"
                            :fieldPlaceholder="__('placeholders.website')" :fieldValue="$lead->website ?? ''"
                            class="mt-lg-0 mt-md-0 mb-3 mt-3" fieldId="website" fieldName="website">
                        </x-forms.text>
                    </div>
                </div>
                <x-forms.custom-field :fields="$fields"></x-forms.custom-field>

                <x-form-actions>
                    <x-forms.button-primary class="mr-3" icon="check"
                        id="save-licenses-and-permits-form">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-cancel :link="route('projectfinances.index') . '?tab=licenses'"
                        class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>
    </div>
</div>