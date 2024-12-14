<div class="row">
    <div class="col-sm-12">
        <x-form id="save-masonry-data-form">

            <div class="add-resource rounded bg-white">
                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <input name="form_type" type="hidden" value="masonry">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.labour')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->masonry_labour ?? ''"
                                    fieldId="masonry_{{ __('modules.projects.formFields.labour') }}"
                                    fieldName="masonry_{{ __('modules.projects.formFields.labour') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.suppliers')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->masonry_suppliers ?? ''"
                                    fieldId="masonry_{{ __('modules.projects.formFields.suppliers') }}"
                                    fieldName="masonry_{{ __('modules.projects.formFields.suppliers') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.supervision')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->supervision ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.supervision') }}"
                                    fieldName="{{ __('modules.projects.formFields.supervision') }}">
                                </x-forms.number>
                            </div>
                        </div>

                        <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                            @lang('modules.projects.titles.equipmentRental')
                        </h4>

                        <div class="row">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.several')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->several ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.several') }}"
                                    fieldName="{{ __('modules.projects.formFields.several') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.scaffolding')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->scaffolding ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.scaffolding') }}"
                                    fieldName="{{ __('modules.projects.formFields.scaffolding') }}">
                                </x-forms.number>
                            </div>
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.mixerAndEquipment')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->mixer_and_equipment ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.mixerAndEquipment') }}"
                                    fieldName="{{ __('modules.projects.formFields.mixerAndEquipment') }}">
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
                        <x-forms.button-primary class="mr-3" icon="edit" id="update-masonry-form">
                            @lang('app.update')
                        </x-forms.button-primary>
                    @else
                        <x-forms.button-primary class="mr-3" icon="check" id="save-masonry-form">
                            @lang('app.save')
                        </x-forms.button-primary>
                    @endif
                    <x-forms.button-cancel :link="route('projectfinances.index') . '?tab=masonry'" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#save-masonry-form').click(function() {
            const url = "{!! route('projectfinances.store') . '?tab=masonry&model=GrayMasonryWork' !!}";
            var data = $('#save-masonry-data-form').serialize();

            saveClient(data, url, "#save-masonry-form");

        });

        $('#update-masonry-form').click(function() {
            // Get the current URL
            const currentUrl = window.location.href;

            // Extract all query parameters
            const urlParams = new URLSearchParams(currentUrl);

            // Extract the desired parameters
            const id = urlParams.get('id');

            const url = "{!! route('projectfinances.update') . '?tab=masonry&id=' !!}" + id + "{!! '&model=GrayMasonryWork' !!}";
            var data = $('#save-masonry-data-form').serialize();

            console.log(url);
            console.log(data);

            saveClient(data, url, "#update-masonry-form");

        });


        function saveClient(data, url, buttonSelector) {
            $.easyAjax({
                url: url,
                container: '#save-masonry-data-form',
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
