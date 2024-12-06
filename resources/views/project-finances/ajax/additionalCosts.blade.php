<div class="row">
    <div class="col-sm-12">
        <x-form id="save-licenses-data-form">

            <div class="add-resource rounded bg-white">
                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.projects.titles.management')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <input name="form_type" type="hidden" value="licenses">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.who')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.who') }}"
                                    fieldName="{{ __('modules.projects.formFields.who') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.cfe')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.cfe') }}"
                                    fieldName="{{ __('modules.projects.formFields.cfe') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.condominiumRegime')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.condominiumRegime') }}"
                                    fieldName="{{ __('modules.projects.formFields.condominiumRegime') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.licenseAndAlignment')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.licenseAndAlignment') }}"
                                    fieldName="{{ __('modules.projects.formFields.licenseAndAlignment') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.rooms')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.rooms') }}"
                                    fieldName="{{ __('modules.projects.formFields.rooms') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.mobility')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.mobility') }}"
                                    fieldName="{{ __('modules.projects.formFields.mobility') }}">
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
                    <x-forms.button-primary class="mr-3" icon="check" id="save-licenses-form">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-cancel :link="route('projectfinances.index') . '?tab=licenses'" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#save-licenses-form').click(function() {
            const url = "{{ route('projectfinances.storeLicenses') }}";
            var data = $('#save-licenses-data-form').serialize();

            saveClient(data, url, "#save-licenses-form");

        });

        function saveClient(data, url, buttonSelector) {
            $.easyAjax({
                url: url,
                container: '#save-licenses-data-form',
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
