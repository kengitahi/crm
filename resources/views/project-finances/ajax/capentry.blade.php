<div class="row">
    <div class="col-sm-12">
        <x-form id="save-capentry-data-form">

            <div class="add-resource rounded bg-white">
                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.projects.titles.management')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <input name="form_type" type="hidden" value="capentry">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.closetBathroomsStairs')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.closetBathroomsStairs') }}"
                                    fieldName="{{ __('modules.projects.formFields.closetBathroomsStairs') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.suppliers')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="capentry_{{ __('modules.projects.formFields.suppliers') }}"
                                    fieldName="capentry_{{ __('modules.projects.formFields.suppliers') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.lockFittings')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$lead->client_name ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.lockFittings') }}"
                                    fieldName="{{ __('modules.projects.formFields.lockFittings') }}">
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
                    <x-forms.button-primary class="mr-3" icon="check" id="save-capentry-form">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-cancel :link="route('projectfinances.index') . '?tab=capentry'" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#save-capentry-form').click(function() {
            const url = "{{ route('projectfinances.storeCapentry') }}";
            var data = $('#save-capentry-data-form').serialize();

            saveClient(data, url, "#save-capentry-form");

        });

        function saveClient(data, url, buttonSelector) {
            $.easyAjax({
                url: url,
                container: '#save-capentry-data-form',
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
