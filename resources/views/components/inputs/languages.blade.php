<select {{ $attributes->merge(['id' => 'language_id', 'name' => 'language_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Language']) }}>
    {{ $slot }}
</select>
<input id="{{ $attributes->get('id') }}-hidden" name="{{ $attributes->get('name') ?: 'language_id' }}_text" type="hidden">

@push('script')
    <script>
        $(function() {
            'use strict';

            var id = '{{ $attributes->get('id') }}';
            var placeholder = '{{ $attributes->get('data-placeholder') ?? 'Choose Language' }}';

            var $el = $('#'+ id);

            $el.select2({
                placeholder: placeholder,
                ajax: {
                    url: '{{ env('API_URL').'/languages' }}',
                    beforeSend: function(request) {
                        request.setRequestHeader('X-Api-Key', '{{ env('API_KEY') }}');
                    },
                    dataType: 'json',
                    delay: 250,
                    cache: true,
                    processResults: function (response, params) {
                        params.page = params.page || 1;

                        return {
                            results: $.map(response.data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            }),
                            pagination: {
                                more: (params.page * response.data.per_page) == response.data.to
                            }
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
