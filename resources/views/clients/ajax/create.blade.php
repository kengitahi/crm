@php
    $addClientCategoryPermission = user()->permission('manage_client_category');
    $addClientSubCategoryPermission = user()->permission('manage_client_subcategory');
    $addClientNotePermission = user()->permission('add_client_note');
    $addPermission = user()->permission('add_clients');
@endphp

<link href="{{ asset('vendor/css/dropzone.min.css') }}" rel="stylesheet">

<div class="row">
    <div class="col-sm-12">
        <x-form id="save-client-data-form">

            <div class="add-client rounded bg-white">
                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('modules.employees.accountDetails')</h4>

                @if (isset($lead->id))
                    <input name="lead" type="hidden" value="{{ $lead->id }}">
                @endif

                <div class="row p-20">
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-4">
                                <x-forms.select :fieldLabel="__('modules.client.salutation')" fieldId="salutation" fieldName="salutation">
                                    <option value="">--</option>
                                    @foreach ($salutations as $salutation)
                                        <option @selected(isset($lead) && $salutation == $lead->salutation) value="{{ $salutation->value }}">
                                            {{ $salutation->label() }}</option>
                                    @endforeach
                                </x-forms.select>
                            </div>
                            <div class="col-md-4">
                                <x-forms.text :fieldLabel="__('modules.client.clientName')" :fieldPlaceholder="__('placeholders.name')" :fieldValue="$lead->client_name ?? ''" fieldId="name"
                                    fieldName="name" fieldRequired="true"></x-forms.text>
                            </div>
                            <div class="col-md-4">
                                <x-forms.email :fieldLabel="__('app.email')" :fieldPlaceholder="__('placeholders.email')" :fieldValue="$lead->client_email ?? ''" :popover="__('modules.client.emailNote')"
                                    fieldId="email" fieldName="email">
                                </x-forms.email>
                            </div>
                            <div class="col-md-4">
                                <x-forms.label :fieldLabel="__('app.password')" :popover="__('messages.requiredForLogin')" class="mt-3" fieldId="password">
                                </x-forms.label>
                                <x-forms.input-group>
                                    <input class="form-control height-35 f-14" id="password" name="password"
                                        type="password">
                                    <x-slot name="preappend">
                                        <button class="btn btn-outline-secondary border-grey height-35 toggle-password"
                                            data-original-title="@lang('app.viewPassword')" data-toggle="tooltip"
                                            type="button"><i class="fa fa-eye"></i></button>
                                    </x-slot>
                                    <x-slot name="append">
                                        <button class="btn btn-outline-secondary border-grey height-35"
                                            data-original-title="@lang('modules.client.generateRandomPassword')" data-toggle="tooltip"
                                            id="random_password" type="button"><i class="fa fa-random"></i></button>
                                    </x-slot>
                                </x-forms.input-group>
                                <small class="form-text text-muted">@lang('placeholders.password')</small>
                            </div>
                            <div class="col-md-4">
                                <x-forms.select :fieldLabel="__('app.country')" fieldId="country" fieldName="country" search="true">
                                    @foreach ($countries as $item)
                                        <option @selected(isset($lead) && $item->nicename == $lead->country)
                                            data-content="<span class='flag-icon flag-icon-{{ strtolower($item->iso) }} flag-icon-squared'></span> {{ $item->nicename }}"
                                            data-iso="{{ $item->iso }}" data-phonecode = "{{ $item->phonecode }}"
                                            data-tokens="{{ $item->iso3 }}" value="{{ $item->id }}">
                                            {{ $item->nicename }}</option>
                                    @endforeach
                                </x-forms.select>
                            </div>
                            <div class="col-md-4">
                                <x-forms.label :fieldLabel="__('app.mobile')" class="my-3" fieldId="mobile"></x-forms.label>
                                <x-forms.input-group style="margin-top:-4px">

                                    <x-forms.select fieldId="country_phonecode" fieldName="country_phonecode"
                                        search="true">

                                        @foreach ($countries as $item)
                                            <option @selected(isset($lead) && $item->nicename == $lead->country)
                                                data-content="{{ $item->flagSpanCountryCode() }}"
                                                data-country-iso="{{ $item->iso }}"
                                                data-tokens="{{ $item->name }}" value="{{ $item->phonecode }}">
                                                {{ $item->phonecode }}
                                            </option>
                                        @endforeach
                                    </x-forms.select>
                                    <input class="form-control height-35 f-14" id="mobile" name="mobile"
                                        placeholder="@lang('placeholders.mobile')" type="tel"
                                        value="{{ $lead->mobile ?? '' }}">
                                </x-forms.input-group>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <x-forms.file :fieldLabel="__('modules.profile.profilePicture')" :popover="__('messages.fileFormat.ImageFile')" allowedFileExtensions="png jpg jpeg svg bmp"
                            class="mr-lg-2 mr-md-2 cropper mr-0" fieldHeight="119" fieldId="image" fieldName="image" />
                    </div>

                    <div class="col-md-3">
                        <x-forms.select :fieldLabel="__('modules.employees.gender')" fieldId="gender" fieldName="gender">
                            <option value="male">@lang('app.male')</option>
                            <option value="female">@lang('app.female')</option>
                            <option value="others">@lang('app.others')</option>
                        </x-forms.select>
                    </div>

                    <div class="col-md-3">
                        <x-forms.select :fieldLabel="__('modules.accountSettings.changeLanguage')" fieldId="locale" fieldName="locale" search="true">
                            @foreach ($languages as $language)
                                <option {{ user()->locale == $language->language_code ? 'selected' : '' }}
                                    data-content="<span class='flag-icon flag-icon-{{ $language->flag_code == 'en' ? 'gb' : $language->flag_code }} flag-icon-squared'></span> {{ $language->language_name }}"
                                    value="{{ $language->language_code }}">{{ $language->language_name }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>

                    <div class="col-md-3">
                        <x-forms.label :fieldLabel="__('modules.client.clientCategory')" class="mt-3" fieldId="category">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" data-live-search="true" id="category_id"
                                name="category_id">
                                <option value="">--</option>
                                @foreach ($categories as $category)
                                    <option @selected(isset($lead) && $lead->category_id == $category->id) value="{{ $category->id }}">
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>

                            @if ($addClientCategoryPermission == 'all')
                                <x-slot name="append">
                                    <button class="btn btn-outline-secondary border-grey"
                                        data-original-title="{{ __('app.add') . ' ' . __('modules.client.clientCategory') }}"
                                        data-toggle="tooltip" id="addClientCategory" type="button">
                                        @lang('app.add')</button>
                                </x-slot>
                            @endif
                        </x-forms.input-group>
                    </div>

                    <div class="col-md-3">
                        <x-forms.label :fieldLabel="__('modules.client.clientSubCategory')" class="mt-3" fieldId="sub_category_id"></x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" data-live-search="true" id="sub_category_id"
                                name="sub_category_id">
                                <option value="">--</option>
                            </select>

                            @if ($addClientSubCategoryPermission == 'all')
                                <x-slot name="append">
                                    <button class="btn btn-outline-secondary border-grey"
                                        data-original-title="{{ __('app.add') . ' ' . __('modules.client.clientSubCategory') }}"
                                        data-toggle="tooltip" id="addClientSubCategory"
                                        type="button">@lang('app.add')</button>
                                </x-slot>
                            @endif
                        </x-forms.input-group>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group my-3">
                            <label class="f-14 text-dark-grey w-100 mb-12 mt-3"
                                for="usr">@lang('modules.client.clientCanLogin')</label>
                            <div class="d-flex">
                                <x-forms.radio :fieldLabel="__('app.yes')" fieldId="login-yes" fieldName="login"
                                    fieldValue="enable">
                                </x-forms.radio>
                                <x-forms.radio :fieldLabel="__('app.no')" checked="true" fieldId="login-no" fieldName="login"
                                    fieldValue="disable"></x-forms.radio>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group my-3">
                            <label class="f-14 text-dark-grey w-100 mb-12 mt-3"
                                for="usr">@lang('modules.emailSettings.emailNotifications')</label>
                            <div class="d-flex">
                                <x-forms.radio :fieldLabel="__('app.yes')" checked="true" fieldId="notification-yes"
                                    fieldName="sendMail" fieldValue="yes">
                                </x-forms.radio>
                                <x-forms.radio :fieldLabel="__('app.no')" fieldId="notification-no" fieldName="sendMail"
                                    fieldValue="no">
                                </x-forms.radio>
                            </div>
                        </div>
                    </div>

                </div>

                <h4 class="f-21 font-weight-normal border-top-grey mb-0 p-20">
                    @lang('modules.client.companyDetails')
                </h4>
                <div class="row p-20">
                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('modules.client.companyName')" :fieldPlaceholder="__('placeholders.company')" :fieldValue="$lead->company_name ?? ''"
                            class="mt-lg-0 mt-md-0 mb-3 mt-3" fieldId="company_name" fieldName="company_name">
                        </x-forms.text>
                    </div>
                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('modules.client.website')" :fieldPlaceholder="__('placeholders.website')" :fieldValue="$lead->website ?? ''"
                            class="mt-lg-0 mt-md-0 mb-3 mt-3" fieldId="website" fieldName="website">
                        </x-forms.text>
                    </div>
                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('app.taxName')" :fieldPlaceholder="__('placeholders.gst/vat')" class="mt-lg-0 mt-md-0 mb-3 mt-3"
                            fieldId="tax_name" fieldName="tax_name">
                        </x-forms.text>
                    </div>
                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('app.gstNumber')" :fieldPlaceholder="__('placeholders.gstNumber')" class="mt-lg-0 mt-md-0 mb-3 mt-3"
                            fieldId="gst_number" fieldName="gst_number">
                        </x-forms.text>
                    </div>

                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('modules.client.officePhoneNumber')" :fieldPlaceholder="__('placeholders.mobileWithPlus')" :fieldValue="$lead->office ?? ''" fieldId="office"
                            fieldName="office">
                        </x-forms.text>
                    </div>
                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('modules.stripeCustomerAddress.city')" :fieldPlaceholder="__('placeholders.city')" :fieldValue="$lead->city ?? ''" fieldId="city"
                            fieldName="city">
                        </x-forms.text>
                    </div>
                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('modules.stripeCustomerAddress.state')" :fieldPlaceholder="__('placeholders.state')" :fieldValue="$lead->state ?? ''" fieldId="state"
                            fieldName="state">
                        </x-forms.text>
                    </div>
                    <div class="col-md-3">
                        <x-forms.text :fieldLabel="__('modules.stripeCustomerAddress.postalCode')" :fieldPlaceholder="__('placeholders.postalCode')" :fieldValue="$lead->postal_code ?? ''" fieldId="postalCode"
                            fieldName="postal_code">
                        </x-forms.text>
                    </div>

                    @if ($addPermission == 'all')
                        <div class="col-lg-6 col-md-6">
                            <x-forms.select :fieldLabel="__('app.added') . ' ' . __('app.by')" fieldId="added_by" fieldName="added_by">
                                <option value="">--</option>
                                @foreach ($employees as $item)
                                    <x-user-option :selected="user()->id == $item->id" :user="$item" />
                                @endforeach
                            </x-forms.select>
                        </div>
                    @endif
                    <div class="col-md-12">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group my-3">
                            <x-forms.textarea :fieldLabel="__('modules.accountSettings.companyAddress')" :fieldPlaceholder="__('placeholders.address')" :fieldValue="$lead->address ?? ''"
                                class="mr-lg-2 mr-md-2 mr-0" fieldId="address" fieldName="address">
                            </x-forms.textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group my-3">
                            <x-forms.textarea :fieldLabel="__('app.shippingAddress')" :fieldPlaceholder="__('placeholders.address')" :fieldValue="$lead->address ?? ''"
                                class="mr-lg-2 mr-md-2 mr-0" fieldId="shipping_address" fieldName="shipping_address">
                            </x-forms.textarea>
                        </div>
                    </div>

                    @if (function_exists('sms_setting') && sms_setting()->telegram_status)
                        <div class="col-md-6">
                            <x-forms.number :popover="__('sms::modules.userIdInfo')" fieldId="telegram_user_id"
                                fieldLabel="<i class='fab fa-telegram'></i> {{ __('sms::modules.telegramUserId') }}"
                                fieldName="telegram_user_id" />
                            <p class="text-bold text-danger">
                                @lang('sms::modules.telegramBotNameInfo')
                            </p>
                            <p class="text-bold"><span
                                    id="telegram-link-text">https://t.me/{{ sms_setting()->telegram_bot_name }}</span>
                                <a class="btn-copy btn-secondary f-12 ml-1 rounded p-1 py-2"
                                    data-clipboard-target="#telegram-link-text" href="javascript:;">
                                    <i class="fa fa-copy mx-1"></i>@lang('app.copy')</a>
                                <a class="btn-secondary f-12 ml-1 rounded p-1 py-2"
                                    href="https://t.me/{{ sms_setting()->telegram_bot_name }}" target="_blank">
                                    <i class="fa fa-copy mx-1"></i>@lang('app.openInNewTab')</a>
                            </p>
                        </div>
                    @endif

                    @if ($addClientNotePermission == 'all' || $addClientNotePermission == 'added' || $addClientNotePermission == 'both')
                        <div class="col-md-12">
                            <div class="form-group my-3">
                                <x-forms.label :fieldLabel="__('app.note')" class="my-3" fieldId="note">
                                </x-forms.label>
                                <div id="note"></div>
                                <textarea class="d-none" id="note-text" name="note"></textarea>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-12">
                        <x-forms.file :fieldLabel="__('modules.contracts.companyLogo')" :fieldValue="company()->logo_url" :popover="__('messages.fileFormat.ImageFile')"
                            allowedFileExtensions="png jpg jpeg svg bmp" class="mr-lg-2 mr-md-2 mr-0"
                            fieldId="company_logo" fieldName="company_logo" />
                    </div>

                    @includeIf('einvoice::form.client-create')
                    <input id="add_more" name="add_more" type ="hidden" value="false" />

                </div>

                <div id="clientContacts">
                    <h4 class="f-21 font-weight-normal border-top-grey mb-0 p-20">
                        @lang('modules.client.contacts')
                    </h4>
                    {{-- Append contact fields here --}}
                </div>

                <div class="mb-3 px-4">
                    <x-forms.button-primary class="mr-3" icon="plus" id="add-contact-fields">
                        @lang('app.addAnotherContact')
                    </x-forms.button-primary>
                </div>

                <x-forms.custom-field :fields="$fields"></x-forms.custom-field>

                <x-form-actions>
                    <x-forms.button-primary class="mr-3" icon="check" id="save-client-form">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-secondary class="mr-3" icon="check-double"
                        id="save-more-client-form">@lang('app.saveAddMore')
                    </x-forms.button-secondary>
                    <x-forms.button-cancel :link="route('clients.index')" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>
    </div>
</div>

@if (function_exists('sms_setting') && sms_setting()->telegram_status)
    <script src="{{ asset('vendor/jquery/clipboard.min.js') }}"></script>
@endif

<script>
    var add_client_note_permission = "{{ $addClientNotePermission }}";
    let clientContacts = document.getElementById('clientContacts');
    let contactCount = 0;

    function clearContactFields(id) {
        const fieldToClear = document.getElementById(id);

        if (fieldToClear) {
            const nameInput = fieldToClear.querySelector('input[name^="contacts["][name$="[contactName]"]');
            const emailInput = fieldToClear.querySelector('input[name^="contacts["][name$="[contactEmail]"]');;

            if (nameInput) {
                nameInput.value = '';
            }
            if (emailInput) {
                emailInput.value = '';
            }
        }
    }

    function deleteContactField(id) {
        console.log(id);
        const fieldToDelete = document.getElementById(id);
        if (fieldToDelete) {
            //use parentNode to support older browsers
            fieldToDelete.parentNode.removeChild(fieldToDelete);
        }
    }

    $(document).ready(function() {
        // Create a unique id for the first client contact field
        // Then create that field and append it to the clientContacts div
        // I did it this way so that the first element would always have a unique id onload
        // and a clear instead of delete function so we always have at least one contact field when the page loads
        // As in we cannot delete this first field, we can only clear it
        // Also, using randomUUID() instead of Math.random() is more secure and avoids database conflicts
        // when we eventually save contacts data to the database
        let elementId = crypto.randomUUID();

        let newContactHtml = `
            <div class="row mb-3 px-4 flex align-items-end" id="contactId-${elementId}">
                <input hidden name="contacts[${contactCount}][contactId]" value="${elementId}">
                <div class="row col-md-9 flex">
                    <div class="col-md-6">
                        <x-forms.text :fieldLabel="__('modules.client.contactName')" :fieldPlaceholder="__('placeholders.name')" fieldId="contacts[${contactCount}][contactName]" fieldName="contacts[${contactCount}][contactName]" fieldRequired="true"></x-forms.text>
                    </div>
                    <div class="col-md-6">
                        <x-forms.email :fieldLabel="__('modules.client.contactEmail')" :fieldPlaceholder="__('placeholders.email')" :popover="__('modules.client.contactEmailNote')" fieldId="contacts[${contactCount}][contactEmail]" fieldName="contacts[${contactCount}][contactEmail]">
                        </x-forms.email>
                    </div>
                </div>
                <div class="col-md-3">
                    <x-forms.button-secondary class="mr-3 my-3 d-block" icon="trash" onClick="clearContactFields('contactId-${elementId}')">
                        @lang('app.deleteContactFields')
                    </x-forms.button-secondary>
                </div>                
            </div>
        `;
        clientContacts.insertAdjacentHTML('beforeend', newContactHtml);
        contactCount++;
        //end creating the first contact field

        $('#add-contact-fields').click(function() {
            let elementId = crypto.randomUUID();

            let newContactHtml = `
                <div class="row mb-3 px-4 flex align-items-end" id="contactId-${elementId}">
                    <input hidden name="contacts[${contactCount}][contactId]" value="${elementId}">
                    <div class="row col-md-9 flex">
                        <div class="col-md-6">
                            <x-forms.text :fieldLabel="__('modules.client.contactName')" :fieldPlaceholder="__('placeholders.name')" fieldId="contacts[${contactCount}][contactName]" fieldName="contacts[${contactCount}][contactName]" fieldRequired="true"></x-forms.text>
                        </div>
                        <div class="col-md-6">
                            <x-forms.email :fieldLabel="__('modules.client.contactEmail')" :fieldPlaceholder="__('placeholders.email')" :popover="__('modules.client.contactEmailNote')" fieldId="contacts[${contactCount}][contactEmail]" fieldName="contacts[${contactCount}][contactEmail]" fieldRequired="true">
                            </x-forms.email>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <x-forms.button-secondary class="mr-3 my-3 d-block" icon="trash" onClick="deleteContactField('contactId-${elementId}')">
                            @lang('app.deleteContactFields')
                        </x-forms.button-secondary>
                    </div>                
                </div>
            `;

            clientContacts.insertAdjacentHTML('beforeend', newContactHtml);
            contactCount++;
        });


        $('.custom-date-picker').each(function(ind, el) {
            datepicker(el, {
                position: 'bl',
                ...datepickerConfig
            });
        });


        $('#country').change(function() {
            var phonecode = $(this).find(':selected').data('phonecode');
            var iso = $(this).find(':selected').data('iso');

            $('#country_phonecode').find('option').each(function() {
                if ($(this).data('country-iso') === iso) {
                    $(this).val(phonecode);
                    $(this).prop('selected', true); // Set the option as selected
                }
            });
            $('.select-picker').selectpicker('refresh');
        });

        if (add_client_note_permission == 'all' || add_client_note_permission == 'added' ||
            add_client_note_permission == 'both') {
            quillImageLoad('#note');
        }

        $('#category_id').change(function(e) {

            let categoryId = $(this).val();

            if (categoryId === '') {
                $('#sub_category_id').html('<option value="">--</option>');
                $('#sub_category_id').selectpicker('refresh');
                return; // Stop further execution when no category is selected
            }

            var url = "{{ route('get_client_sub_categories', ':id') }}";
            url = url.replace(':id', categoryId);

            $.easyAjax({
                url: url,
                type: "GET",
                success: function(response) {
                    if (response.status == 'success') {
                        var options = [];
                        var rData = [];
                        rData = response.data;
                        $.each(rData, function(index, value) {
                            var selectData = '';
                            selectData = '<option value="' + value.id + '">' + value
                                .category_name + '</option>';
                            options.push(selectData);
                        });

                        $('#sub_category_id').html('<option value="">--</option>' +
                            options);
                        $('#sub_category_id').selectpicker('refresh');
                    }
                }
            })

        });

        $('#save-more-client-form').click(function() {

            $('#add_more').val(true);

            if (add_client_note_permission == 'all' || add_client_note_permission == 'added' ||
                add_client_note_permission == 'both') {
                var note = document.getElementById('note').children[0].innerHTML;
                document.getElementById('note-text').value = note;
            }

            const url = "{{ route('clients.store') }}?add_more=true";
            // var data = $('#save-client-data-form').serialize() + '&add_more=true';
            var data = $('#save-client-data-form').serialize();

            // console.log(data);
            saveClient(data, url, "#save-more-client-form");

        });

        $('#save-client-form').click(function() {
            if (add_client_note_permission == 'all' || add_client_note_permission == 'added' ||
                add_client_note_permission == 'both') {
                var note = document.getElementById('note').children[0].innerHTML;
                document.getElementById('note-text').value = note;
            }

            const url = "{{ route('clients.store') }}";
            var data = $('#save-client-data-form').serialize();

            saveClient(data, url, "#save-client-form");

        });

        function saveClient(data, url, buttonSelector) {
            $.easyAjax({
                url: url,
                container: '#save-client-data-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                buttonSelector: buttonSelector,
                file: true,
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

        $('#random_password').click(function() {
            const randPassword = Math.random().toString(36).substr(2, 8);

            $('#password').val(randPassword);
        });

        $('#addClientCategory').click(function() {
            const url = "{{ route('clientCategory.create') }}";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        })
        $('#addClientSubCategory').click(function() {
            const url = "{{ route('clientSubCategory.create') }}";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        init(RIGHT_MODAL);
    });

    @if (function_exists('sms_setting') && sms_setting()->telegram_status)
        var clipboard = new ClipboardJS('.btn-copy');

        clipboard.on('success', function(e) {
            Swal.fire({
                icon: 'success',
                text: '@lang('app.urlCopied')',
                toast: true,
                position: 'top-end',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
                customClass: {
                    confirmButton: 'btn btn-primary',
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
            })
        });
    @endif
</script>
