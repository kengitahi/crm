<div class="row">
    <div class="col-sm-12">
        <x-form id="save-operation-data-form">

            <div class="add-resource rounded bg-white">
                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.projects.titles.administration')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <input name="form_type" type="hidden" value="operation">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.administration')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->administration ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.administration') }}"
                                    fieldName="{{ __('modules.projects.formFields.administration') }}">
                                </x-forms.number>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.projects.titles.murillo')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.accounting')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->accounting ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.accounting') }}"
                                    fieldName="{{ __('modules.projects.formFields.accounting') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.legal')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->legal ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.legal') }}"
                                    fieldName="{{ __('modules.projects.formFields.legal') }}">
                                </x-forms.number>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.projects.titles.sales')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.suppliers')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->sales_suppliers ?? ''"
                                    fieldId="sales_{{ __('modules.projects.formFields.suppliers') }}"
                                    fieldName="sales_{{ __('modules.projects.formFields.suppliers') }}">
                                </x-forms.number>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.projects.titles.advertising')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.suppliers')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->advertising_suppliers ?? ''"
                                    fieldId="advertising_{{ __('modules.projects.formFields.suppliers') }}"
                                    fieldName="advertising_{{ __('modules.projects.formFields.suppliers') }}">
                                </x-forms.number>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.projects.titles.otherCosts')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.taxRedial')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->tax_redial ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.taxRedial') }}"
                                    fieldName="{{ __('modules.projects.formFields.taxRedial') }}">
                                </x-forms.number>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="f-21 font-weight-normal border-top-grey mb-0 p-20">
                    Add button for adding more fields
                </h4>

                <x-forms.custom-field :fields="$fields"></x-forms.custom-field>

                <x-form-actions>
                    @if (request()->action == 'edit')
                        <x-forms.button-primary class="mr-3" icon="edit" id="update-operation-form">
                            @lang('app.update')
                        </x-forms.button-primary>
                    @else
                        <x-forms.button-primary class="mr-3" icon="check" id="save-operation-form">
                            @lang('app.save')
                        </x-forms.button-primary>
                    @endif
                    <x-forms.button-cancel :link="route('projectfinances.index') . '?tab=otherCosts'" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#save-operation-form').click(function() {
            const url = "{{ route('projectfinances.storeOperation') }}";
            var data = $('#save-operation-data-form').serialize();

            saveClient(data, url, "#save-operation-form");

        });
        
        $('#update-operation-form').click(function() {
            // Get the current URL
            const currentUrl = window.location.href;

            // Extract all query parameters
            const urlParams = new URLSearchParams(currentUrl);

            // Extract the desired parameters
            const id = urlParams.get('id');

            const url = "{!! route('projectfinances.update') . '?tab=operation&id=' !!}" + id + "{!! '&model=Operation' !!}";
            var data = $('#save-operation-data-form').serialize();

            console.log(url);
            console.log(data);

            saveClient(data, url, "#update-operation-form");

        });

        function saveClient(data, url, buttonSelector) {
            $.easyAjax({
                url: url,
                container: '#save-operation-data-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                buttonSelector: buttonSelector,
                data: data,
                success: function(response) {
                    if (response.status == 'success') {
                        if ($(MODAL_XL).hasClass('show')) {

                            $(MODAL_XL).modal('hide');
                            window.location.reload();
                        } else if (typeof response.redirectUrl !== 'undefined') {
                            window.location.href = response.redirectUrl;
                        } else if (response.add_more == true) {

                            var right_modal_content = $.trim($(RIGHT_MODAL_CONTENT).html());
                            if (right_modal_content.length) {

                                $(RIGHT_MODAL_CONTENT).html(response.html.html);
                                $('#add_more').val(false);
                            } else {

                                $('.content-wrapper').html(response.html.html);
                                init('.content-wrapper');
                                $('#add_more').val(false);
                            }
                        }

                        if (typeof showTable !== 'undefined' && typeof showTable === 'function') {
                            showTable();
                        }
                    }
                }
            });
        }

    })
</script>
