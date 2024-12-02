<div class="row">
    <div class="col-sm-12">
        <x-form id="save-client-data-form">
            <div class="add-client rounded bg-white">
                <h4 class="f-21 font-weight-normal border-bottom-grey mb-0 p-20">
                    @lang('app.contactDetails')</h4>

                <input name="user_id" type="hidden" value="{{ $clientId }}">
                <input id="contactId" name="contact_id" type="hidden">

                <div class="row p-20">
                    <div class="col-md-4">
                        <x-forms.text :fieldLabel="__('app.title')" :fieldPlaceholder="__('placeholders.title')" fieldId="title" fieldName="title">
                        </x-forms.text>
                    </div>
                    <div class="col-md-4">
                        <x-forms.text :fieldLabel="__('modules.contacts.contactName')" :fieldPlaceholder="__('placeholders.name')" fieldId="contact_name"
                            fieldName="contact_name" fieldRequired="true">
                        </x-forms.text>
                    </div>
                    <div class="col-md-4">
                        <x-forms.email :fieldLabel="__('app.email')" :fieldPlaceholder="__('placeholders.email')" fieldId="email" fieldName="email"
                            fieldRequired="true"></x-forms.email>
                    </div>
                    <div class="col-md-4">
                        <x-forms.text :fieldLabel="__('app.phone')" :fieldPlaceholder="__('placeholders.mobile')" fieldId="phone" fieldName="phone">
                        </x-forms.text>
                    </div>
                </div>

                <x-form-actions>
                    <x-forms.button-primary class="mr-3" icon="check" id="save-client-form">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-cancel :link="route('clients.show', $clientId) . '?tab=contacts'" class="border-0">
                        @lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>
            </div>
        </x-form>

    </div>
</div>

<script>
    var elementId = crypto.randomUUID();
    var contactIdElement = document.getElementById('contactId');
    if (contactIdElement) {
        contactIdElement.setAttribute('value', elementId);
    }

    $(document).ready(function() {

        $('#save-client-form').click(function() {
            const url = "{{ route('client-contacts.store') }}";

            $.easyAjax({
                url: url,
                container: '#save-client-data-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                buttonSelector: "#save-client-form",
                data: $('#save-client-data-form').serialize(),
                success: function(response) {

                    if (response.status === 'success') {
                        window.location.href = response.redirectUrl;
                    }
                }
            })
        });

        init(RIGHT_MODAL);
    });
</script>
