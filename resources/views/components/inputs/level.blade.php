<select {{ $attributes->merge(['id' => 'level_id', 'name' => 'level_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Level']) }}>
    {{ $slot }}
</select>
<input id="{{ $attributes->get('id') }}-hidden" name="{{ $attributes->get('name') ?: 'level_id' }}_text" type="hidden">

@push('script')
<script>
    $(function() {
        'use strict';

        var id = '{{ $attributes->get('id') }}';
        var placeholder = '{{ $attributes->get('data-placeholder') ?? 'Choose level' }}';
        var related = '{{ $attributes->get('related') }}';

        var model = '{{ $attributes->get('data-model') }}';
        var dropdownParent;

        if(model == 1){
            dropdownParent = $("#modal-signup");
        }
        else{
            dropdownParent = null;
        }

        var $el = $('#'+ id);

        $el.select2({
            placeholder: placeholder,
            dropdownParent: dropdownParent,
            ajax: {
                url: '{{ env('API_URL').'/levels' }}',
                beforeSend: function(request) {
                    request.setRequestHeader('X-Api-Key', '{{ env('API_KEY') }}');
                },
                data: function (params) {
                    if(related) {
                        var name = $(related).attr('name');
                        params[name] = $(related).val();
                    }

                    params.search = params.term;
                    return params;
                },
                dataType: 'json',
                delay: 250,
                cache: true,
                processResults: function (response) {
                    return {
                        results: $.map(response.data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        var onChange = function () {
            $('#'+ id + '-hidden').val($el.find('option:selected').text());
        };

        $el.change(onChange);

        $(document).on('change', related, function () {
            $el.val(null);
            $el .trigger('change');
        });

        onChange();
    });
</script>
@endpush
