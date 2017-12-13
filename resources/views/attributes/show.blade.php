<div class="attribute-creation-form col-sm-6">

    <fieldset>

        <div class="form-group">

            <label>{{ $attribute->type->name }}</label>
            <?php
            switch (json_decode($attribute->type->html_attributes)->{'element-type'}) {
            case "input":
            ?>
            <input type="{{ json_decode($attribute->type->html_attributes)->{'input-type'} }}"
                   class="form-control attribute-value" value="{{ $attribute->value }}">
            <?php
            break;
            case "textarea":
            ?>
            <textarea class="form-control attribute-value">{{ $attribute->value }}</textarea>
            <?php
            break;
            }

            ?>

        </div>

    </fieldset>

</div>