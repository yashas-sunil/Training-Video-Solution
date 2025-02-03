<select {{ $attributes->merge(['data-model' => 'data-model', 'id' => 'course_id', 'name' => 'course_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Course']) }}>
    {{ $slot }}
</select>
<input id="{{ $attributes->get('id') }}-hidden" name="{{ $attributes->get('name') ?: 'course_id' }}_text" type="hidden">

@push('script')
<script>
    $(function() {
        'use strict';

        var id = '{{ $attributes->get('id') }}';
        var model = '{{ $attributes->get('data-model') }}';

        var dropdownParent;

        if(model == 1){
            dropdownParent = $("#modal-signup");
        }
        else{
            dropdownParent = null;
        }

        var placeholder = '{{ $attributes->get('data-placeholder') ?? 'Choose course' }}';

        var $el = $('#'+ id);

        $el.select2({
            placeholder: placeholder,
            dropdownParent: dropdownParent,
            tags: true,
            ajax: {
                url: '{{ env('API_URL').'/courses' }}',
                beforeSend: function(request) {
                    request.setRequestHeader('X-Api-Key', '{{ env('API_KEY') }}');
                },
                dataType: 'json',
                delay: 250,
                cache: true,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
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

        onChange();
    });
</script>
@endpush
