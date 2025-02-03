<select {{ $attributes->merge(['id' => 'chapter_id', 'name' => 'chapter_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Chapter']) }}>
    {{ $slot }}
</select>
<input id="{{ $attributes->get('id') }}-hidden" name="{{ $attributes->get('name') ?: 'chapter_id' }}_text" type="hidden">

@push('script')
<script>
    $(function() {
        'use strict';

        var id = '{{ $attributes->get('id') }}';
        var placeholder = '{{ $attributes->get('data-placeholder') ?? 'Choose chapter' }}';
        var related = '{{ $attributes->get('related') }}';

        var $el = $('#'+ id);

        $el.select2({
            placeholder: placeholder,
            ajax: {
                url: '{{ env('API_URL').'/chapters' }}',
                beforeSend: function(request) {
                    request.setRequestHeader('X-Api-Key', '{{ env('API_KEY') }}');
                },
                data: function (params) {
                    if(related) {
                        var name = $(related).attr('name');
                        params[name + '_id'] = $(related).val();
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
