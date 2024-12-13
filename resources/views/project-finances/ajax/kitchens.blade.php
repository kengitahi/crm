<div class="row">
    <div class="col-sm-12">
        <x-form id="save-kitchens-data-form">

            <div class="add-resource rounded bg-white">
                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.projects.titles.suppliers')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <input name="form_type" type="hidden" value="kitchens">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.suppliers')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->suppliers ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.suppliers') }}"
                                    fieldName="{{ __('modules.projects.formFields.suppliers') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.furniture')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->furniture ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.furniture') }}"
                                    fieldName="{{ __('modules.projects.formFields.furniture') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.quartzCover')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->quartz_cover ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.quartzCover') }}"
                                    fieldName="{{ __('modules.projects.formFields.quartzCover') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.team')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->team ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.team') }}"
                                    fieldName="{{ __('modules.projects.formFields.team') }}">
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
                        <x-forms.button-primary class="mr-3" icon="pencil" id="update-kitchens-form">
                            @lang('app.save')
                        </x-forms.button-primary>
                    @else
                        <x-forms.button-primary class="mr-3" icon="check" id="save-kitchens-form">
                            @lang('app.save')
                        </x-forms.button-primary>
                    @endif
                    <x-forms.button-cancel :link="route('projectfinances.index') . '?tab=kitchens'" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#save-kitchens-form').click(function() {
            const url = "{{ route('projectfinances.storeKitchens') }}";
            var data = $('#save-kitchens-data-form').serialize();

            saveClient(data, url, "#save-kitchens-form");

        });

        $('#update-kitchens-form').click(function() {
            // Get the current URL
            const currentUrl = window.location.href;

            // Extract all query parameters
            const urlParams = new URLSearchParams(currentUrl);

            // Extract the desired parameters
            const id = urlParams.get('id');

            const url = "{!! route('projectfinances.update') . '?tab=kitchens&id=' !!}" + id + "{!! '&model=Kitchens' !!}";
            var data = $('#save-kitchens-data-form').serialize();

            console.log(url);
            console.log(data);

            saveClient(data, url, "#update-kitchens-form");

        });

        function saveClient(data, url, buttonSelector) {
            $.easyAjax({
                url: url,
                container: '#save-kitchens-data-form',
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
