<div class="attribute-form attribute-creation-form form-inline">



    <fieldset>
        <div class="attribute-group">
            <div class="attribute-group-main">

                    <select class="form-control attribute-type">
                        @foreach($types as $type)
                            <option
                                    data-input_type="{{ json_decode($type->html_attributes)->{'input-type'}  }}"
                                    data-element_type="{{ json_decode($type->html_attributes)->{'element-type'}  }}"
                                    value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>

                    <input type="text" class="form-control attribute-value">

            </div>
            <div class="attribute-group-side">
                <button type="button" class="remove-attribute-block btn btn-xs pull-right btn-warning"><i class="material-icons block">delete</i></button>
            </div>
        </div>

    </fieldset>

</div>