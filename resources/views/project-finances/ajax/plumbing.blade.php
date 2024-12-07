<div class="row">
    <div class="col-sm-12">
        <x-form id="save-plumbing-data-form">

            <div class="add-resource rounded bg-white">
                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.projects.titles.suppliers')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <input name="form_type" type="hidden" value="plumbing">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.labour')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.labour') }}"
                                    fieldName="{{ __('modules.projects.formFields.labour') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.materials')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.materials') }}"
                                    fieldName="{{ __('modules.projects.formFields.materials') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.hydropneumaticSystem')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.hydropneumaticSystem') }}"
                                    fieldName="{{ __('modules.projects.formFields.hydropneumaticSystem') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.sprinklerIrrigationSystem')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.sprinklerIrrigationSystem') }}"
                                    fieldName="{{ __('modules.projects.formFields.sprinklerIrrigationSystem') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.tank')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.tank') }}"
                                    fieldName="{{ __('modules.projects.formFields.tank') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.basicMaterial')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.basicMaterial') }}"
                                    fieldName="{{ __('modules.projects.formFields.basicMaterial') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.heater')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.heater') }}"
                                    fieldName="{{ __('modules.projects.formFields.heater') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.bathroom')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.bathroom') }}"
                                    fieldName="{{ __('modules.projects.formFields.bathroom') }}">
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
                    <x-forms.button-primary class="mr-3" icon="check" id="save-plumbing-form">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-cancel :link="route('projectfinances.index') . '?tab=plumbing'" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#save-plumbing-form').click(function() {
            const url = "{{ route('projectfinances.storePlumbing') }}";
            var data = $('#save-plumbing-data-form').serialize();

            saveClient(data, url, "#save-plumbing-form");

        });

        function saveClient(data, url, buttonSelector) {
            $.easyAjax({
                url: url,
                container: '#save-plumbing-data-form',
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
