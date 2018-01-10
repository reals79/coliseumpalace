<fieldset style="margin-bottom: 20px;">
    <legend>{{ $label }}</legend>
    <div id="inputs_{{ $name }}">
        <div class="new-input hidden form-group">
            <div class="input-group">
                <div data-number class="input-group-addon"></div>
                <input type="text" name="input" value="{{ $value }}" class="form-control">
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-success btn-xs" title="Добавить" onclick="add_input('{{ $name }}')"><i class="fa fa-plus" aria-hidden="true"></i></button>

    <script>
        if (typeof add_input !== 'function') {
            var input_json = [];
            var add_input = function(name, value) {
                var container = $('#inputs_' + name);
                var length = $('.form-group', container).length;
                var $new_input = $('.new-input', container).clone().appendTo(container);
                $new_input.removeClass('new-input hidden');
                $('[data-number]', $new_input).text(length + '.');
                $name_input = $('[name="input"]', $new_input).attr('name', name + '[' + length + ']');

                length++;

                if (value)
                    $name_input.val(value);

                return $new_input;
            }
        }
        input_json.push('{"{{ $name }}": {!! json_encode($model->{$name}) !!}}');

        window.onload = function () {
            _.forEach(input_json, function(value, key) {
                if (value != '') {
                    let value_obj = JSON.parse(value);
                    _.forEach(value_obj, function(value, key) {
                        let input_name = key;
                        _.forEach(value, function(value, key) {
                            add_input(input_name, value);
                        });
                    });
                }
                
            });
        };

    </script>
</fieldset>