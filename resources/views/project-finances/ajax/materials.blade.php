<div class="row">
    <div class="col-sm-12">
        <x-form id="save-materials-data-form">

            <div class="add-resource rounded bg-white">
                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <input name="form_type" type="hidden" value="materials">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.rodWireAndArmex')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->rod_wire_armex ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.rodWireAndArmex') }}"
                                    fieldName="{{ __('modules.projects.formFields.rodWireAndArmex') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.prefabricatedSystems')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->prefabricated_systems ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.prefabricatedSystems') }}"
                                    fieldName="{{ __('modules.projects.formFields.prefabricatedSystems') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.premixedConcrete')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->premixed_concrete ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.premixedConcrete') }}"
                                    fieldName="{{ __('modules.projects.formFields.premixedConcrete') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.cementAndMortar')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->cement_mortar ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.cementAndMortar') }}"
                                    fieldName="{{ __('modules.projects.formFields.cementAndMortar') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.blockAndBrick')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->block_and_brick ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.blockAndBrick') }}"
                                    fieldName="{{ __('modules.projects.formFields.blockAndBrick') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.basicMaterials')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->basic_material ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.basicMaterials') }}"
                                    fieldName="{{ __('modules.projects.formFields.basicMaterials') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.sandAndMaterialFreight')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->sand_and_material_freight ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.sandAndMaterialFreight') }}"
                                    fieldName="{{ __('modules.projects.formFields.sandAndMaterialFreight') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.waterproofing')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->waterproofing ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.waterproofing') }}"
                                    fieldName="{{ __('modules.projects.formFields.waterproofing') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.miscNotesAndHardware')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->miscellaneous ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.miscNotesAndHardware') }}"
                                    fieldName="{{ __('modules.projects.formFields.miscNotesAndHardware') }}">
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
                        <x-forms.button-primary class="mr-3" icon="edit" id="update-materials-form">
                            @lang('app.update')
                        </x-forms.button-primary>
                    @else
                        <x-forms.button-primary class="mr-3" icon="check" id="save-materials-form">
                            @lang('app.save')
                        </x-forms.button-primary>
                    @endif
                    <x-forms.button-cancel :link="route('projectfinances.index') . '?tab=materials'" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#save-materials-form').click(function() {
            const url = "{!! route('projectfinances.store') . '?tab=materials&model=Materials' !!}";
            var data = $('#save-materials-data-form').serialize();

            saveClient(data, url, "#save-materials-form");

        });

        $('#update-materials-form').click(function() {
            // Get the current URL
            const currentUrl = window.location.href;

            // Extract all query parameters
            const urlParams = new URLSearchParams(currentUrl);

            // Extract the desired parameters
            const id = urlParams.get('id');

            const url = "{!! route('projectfinances.update') . '?tab=materials&id=' !!}" + id + "{!! '&model=Materials' !!}";
            var data = $('#save-materials-data-form').serialize();

            console.log(url);
            console.log(data);

            saveClient(data, url, "#update-materials-form");

        });

        function saveClient(data, url, buttonSelector) {
            $.easyAjax({
                url: url,
                container: '#save-materials-data-form',
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
