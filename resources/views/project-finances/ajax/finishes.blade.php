<div class="row">
    <div class="col-sm-12">
        <x-form id="save-finishes-data-form">

            <div class="add-resource rounded bg-white">
                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.projects.titles.suppliers')
                </h4>

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <input name="form_type" type="hidden" value="finishes">
                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.suppliers')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->finishes_suppliers ?? ''"
                                    fieldId="finishes_{{ __('modules.projects.formFields.suppliers') }}"
                                    fieldName="finishes_{{ __('modules.projects.formFields.suppliers') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.woodenStairs')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->wooden_stairs ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.woodenStairs') }}"
                                    fieldName="{{ __('modules.projects.formFields.woodenStairs') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.marbleAndGranites')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->marble_and_granites ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.marbleAndGranites') }}"
                                    fieldName="{{ __('modules.projects.formFields.marbleAndGranites') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.woodenStave')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->wooden_stave ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.woodenStave') }}"
                                    fieldName="{{ __('modules.projects.formFields.woodenStave') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.wallCovering')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->wall_covering ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.wallCovering') }}"
                                    fieldName="{{ __('modules.projects.formFields.wallCovering') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.kitchens')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->kitchens ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.kitchens') }}"
                                    fieldName="{{ __('modules.projects.formFields.kitchens') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.carpentry')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->carpentry ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.carpentry') }}"
                                    fieldName="{{ __('modules.projects.formFields.carpentry') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.bathroomFurniture')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->bathroom_furniture ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.bathroomFurniture') }}"
                                    fieldName="{{ __('modules.projects.formFields.bathroomFurniture') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.outdoorAreas')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->outdoor_areas ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.outdoorAreas') }}"
                                    fieldName="{{ __('modules.projects.formFields.outdoorAreas') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.marbleSlabs')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->marble_slabs ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.marbleSlabs') }}"
                                    fieldName="{{ __('modules.projects.formFields.marbleSlabs') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.floor')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->floors ?? ''"
                                    fieldId="{{ __('modules.projects.formFields.floor') }}"
                                    fieldName="{{ __('modules.projects.formFields.floor') }}">
                                </x-forms.number>
                            </div>

                            <div class="col-md-4">
                                <x-forms.number :fieldLabel="__('modules.projects.formLabels.labour')" :fieldPlaceholder="__('placeholders.projects.amount')" :fieldValue="$costToEdit->labour ?? ''"
                                    fieldId="finishes_{{ __('modules.projects.formFields.labour') }}"
                                    fieldName="finishes_{{ __('modules.projects.formFields.labour') }}">
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
                        <x-forms.button-primary class="mr-3" icon="edit" id="update-finishes-form">
                            @lang('app.update')
                        </x-forms.button-primary>
                    @else
                        <x-forms.button-primary class="mr-3" icon="check" id="save-finishes-form">
                            @lang('app.save')
                        </x-forms.button-primary>
                    @endif
                    <x-forms.button-cancel :link="route('projectfinances.index') . '?tab=finishes'" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#save-finishes-form').click(function() {
            const url = "{!! route('projectfinances.store') . '?tab=finishes&model=Finishes' !!}";
            var data = $('#save-finishes-data-form').serialize();

            saveClient(data, url, "#save-finishes-form");

        });

        $('#update-finishes-form').click(function() {
            // Get the current URL
            const currentUrl = window.location.href;

            // Extract all query parameters
            const urlParams = new URLSearchParams(currentUrl);

            // Extract the desired parameters
            const id = urlParams.get('id');

            const url = "{!! route('projectfinances.update') . '?tab=finishes&id=' !!}" + id + "{!! '&model=Finishes' !!}";
            var data = $('#save-finishes-data-form').serialize();

            console.log(url);
            console.log(data);

            saveClient(data, url, "#update-finishes-form");

        });

        function saveClient(data, url, buttonSelector) {
            $.easyAjax({
                url: url,
                container: '#save-finishes-data-form',
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
