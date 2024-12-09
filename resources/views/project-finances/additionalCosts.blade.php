@section('content')
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">

            <div class="flex-grow-1 align-items-center" id="table-actions">

                <x-forms.link-primary :link="route('projectfinances.additionalCosts')" class="openRightModal mb-lg-0 mb-md-0 float-left mb-2 mr-3"
                    icon="plus">
                    @lang('modules.projects.addRecord')
                </x-forms.link-primary>

                <x-forms.link-secondary :link="route('clients.import')"
                    class="mb-lg-0 mb-md-0 d-sm-bloc d-none d-lg-block float-left mb-2 mr-3" icon="file-upload">
                    @lang('app.importExcel')
                </x-forms.link-secondary>

            </div>

        </div>
        <!-- Add Task Export Buttons End -->

        <!-- Task Box Start -->
        <div class="d-flex flex-column w-tables table-responsive mt-3 rounded bg-white">

            {!! $dataTable->table(['class' => 'table table-hover border-0 w-100']) !!}

        </div>
        <!-- Task Box End -->
    </div>
    <!-- CONTENT WRAPPER END -->
@endsection

@push('scripts')
    @include('sections.datatable_js')
@endpush
